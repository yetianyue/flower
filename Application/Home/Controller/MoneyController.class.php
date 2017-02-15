<?php 
namespace Home\Controller;
/**
 * Description of OrderController
 * 结算与流水
 * @author 叶天跃
 * @datetime 2016-9-11 8:48:24
 */
class MoneyController extends BaseController {
    private $db;
    public function __construct(){  
        parent::__construct();
        $this->db = D('orders');
    }
    public function lists(){
        $dayBegin = strtotime(date("Y-m-d 00:00:00"));
        $dayEnd = strtotime(date("Y-m-d 23:59:59"));
        $monthBegin = strtotime(date("Y-m-01 00:00:00"));
        $monthEnd = strtotime(date("Y-m-t 23:59:59")); 
        //当日（月）收入=当日订单总价的和
        //$present = C('ORDER_PRICE_PRESENT');
        //当日收入 1
        $sql = "(SELECT SUM(osprice) AS price FROM flower_orders WHERE ctime >= {$dayBegin} AND ctime < {$dayEnd} AND status > 1 LIMIT 1) UNION ALL";
        //当月收入 2
        $sql .= "(SELECT SUM(osprice) AS price FROM flower_orders WHERE ctime >= {$monthBegin} AND ctime < {$monthEnd} AND status > 1 LIMIT 1) UNION ALL";
        //当日利润 3
        $sql .= "(SELECT SUM(oprofit) AS price FROM flower_orders WHERE ctime >= {$dayBegin} AND ctime < {$dayEnd} AND status > 1 LIMIT 1) UNION ALL";
        //当月利润 4
        $sql .= "(SELECT SUM(oprofit) AS price FROM flower_orders WHERE ctime >= {$monthBegin} AND ctime < {$monthEnd} AND status > 1 LIMIT 1)";
        $countOrderInfo = M()->query($sql);
        foreach ($countOrderInfo as $key => $value) {
            if($value['price'] == NULL){
                $countOrderInfo[$key]['price'] = '0.00';
            }else{
                $countOrderInfo[$key]['price'] = round($value['price'],2);
            }
        }
        $this->assign('coinfo',$countOrderInfo);
        $params = $this->getParamWhereAndPage($get);
        $where = $params['where'];
        $paramPage = $params['paramPage'];
        if(empty($where['flower_orders.status']))
            $where['flower_orders.status'] = array('GT',1);
        if($this->userinfo['roleid'] != 1){
            $where['flower_orders.author'] = $this->userinfo['id'];
        }
        $count = $this->db->where($where)->count();
        $Page = new \Think\Page($count,20);
        if(!empty($paramPage)){
            foreach ($paramPage as $key => $value) {
                if(!empty($value)){
                    $Page->parameter[$key] = $value;
                }
            } 
        }
        M('source')->select();
        $list = $this->db->field('flower_memeber.tname as tname,flower_source.sname as sname,flower_orders.*')->where($where)->join('flower_memeber on flower_orders.author = flower_memeber.id')->join('flower_source on flower_orders.sid = flower_source.id')->order('ctime DESC,id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->setConfig('header','<li><a>共 %TOTAL_ROW% 个订单</a></li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show= $Page->show();
        $this->assign('page',$show);
        $this->assign('list',$list);
        $slists = M('source')->select();
        $this->assign('slists',$slists);
        $mlists = M('memeber')->select();
        $this->assign('mlists',$mlists);
        $this->display();
    }
    public function getMoneyData(){
        if(IS_AJAX){
            $type = trim(I('POST.type',NULL));
            $date = trim(I('POST.date',NULL));
            if ($type == NULL || !in_array($type,array('day','month'))) {
                $this->ajaxReturn(array('status'=>-1,'msg'=>'类型参数不正确'));
            }
            $begintime = strtotime($date);
            switch ($type) {
                case 'day':
                    $check = date('Y-m-d',$begintime);
                    if($check != $date)
                        $this->ajaxReturn(array('status'=>-1,'msg'=>'日期格式不正确')); 
                    $endTime = strtotime($date.' 23:59:59');
                    break;
                case 'month':
                    $check = date('Y-m',$begintime);
                    if($check != $date)
                        $this->ajaxReturn(array('status'=>-1,'msg'=>'日期格式不正确')); 
                    $endDate = date('Y-m-t',$begintime);
                    $endTime = strtotime($endDate.' 23:59:59');
                    break;
                default:
                    $this->ajaxReturn(array('status'=>-1,'msg'=>'类型参数不正确')); 
                    break;
            }
            //收入
            $sql = "(SELECT SUM(osprice) AS price FROM flower_orders WHERE ctime >= {$begintime} AND ctime < {$endTime} AND status > 1 LIMIT 1) UNION ALL";
            //利润
            $sql .= "(SELECT SUM(oprofit) AS price FROM flower_orders WHERE ctime >= {$begintime} AND ctime < {$endTime} AND status > 1 LIMIT 1)";
            $countOrderInfo = M()->query($sql);
            foreach ($countOrderInfo as $key => $value) {
                if($value['price'] == NULL){
                    $countOrderInfo[$key]['price'] = '0.00';
                }else{
                    $countOrderInfo[$key]['price'] = round($value['price'],2);
                }
            }
            $data['income'] = $countOrderInfo[0]['price'];
            $data['profit'] = $countOrderInfo[1]['price'];
            $this->ajaxReturn(array('status'=>1,'data'=>$data));
        }
    }
    public function account(){
        $count = M('memeber')->where(array('status'=>1))->count();
        $mPage = new \Think\Page($count,10);
        C('VAR_PAGE','mp');
        $mlist = M('memeber')->field('id,tname,mmoney')->where(array('status'=>1))->limit($mPage->firstRow.','.$mPage->listRows)->select();
        foreach ($mlist as $key => $value) {
            $where['isbalance'] = 0;
            $where['author'] = $value['id'];
            //2016-9-21 19:23:24 ,订单排除作废订单
            $where['status'] = array('gt',1);
            $info = $this->db->field('SUM(ocut) AS ocut')->where($where)->find();
            if($info['ocut'])
                $mlist[$key]['unocut'] = $info['ocut'];
            else
                $mlist[$key]['unocut'] = '0.00';
        }
        $mPage->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $mPage->setConfig('header','<li><a>共 %TOTAL_ROW% 条记录</a></li>');
        $mPage->setConfig('prev','上一页');
        $mPage->setConfig('next','下一页');
        $show= $mPage->show();
        $this->assign('mpage',$show);
        $this->assign('unocut',$mlist);
        $count = M('paylog')->count();
        C('VAR_PAGE','lp');
        $lPage = new \Think\Page($count,10);
        $loglist = M('paylog')->limit($lPage->firstRow.','.$lPage->listRows)->order('ctime DESC')->select();
        $this->assign('loglist',$loglist);
        $lPage->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $lPage->setConfig('header','<li><a>共 %TOTAL_ROW% 条记录</a></li>');
        $lPage->setConfig('prev','上一页');
        $lPage->setConfig('next','下一页');
        $lshow= $lPage->show();
        $this->assign('lPage',$lshow);
        $this->display();
    }
    public function accountjs(){
        if(IS_POST){
            $log = D('paylog');
            $cresult = $log->create();
            if($cresult){
                $where1['id'] = I('POST.author');
                $save1['mmoney'] = round($cresult['ocuta']-$cresult['pay'],2);

                if($save1['mmoney'] < 0 ){
                    $this->error('结算金额超过需要结算的总金额');
                }
                $res1 = M('memeber')->where($where1)->save($save1);
                
                $ocut = I('POST.ocut');
                if($ocut == '0.00' && !intval($ocut)){
                    $res2 = TRUE;
                }else{
                    $where2['isbalance'] = 0;
                    $save2['isbalance'] = 1;
                    $where2['author'] = I('POST.author');
                    $res2 = $this->db->where($where2)->save($save2);
                }
                $res3 = $log->add();
                if($res1 && $res2 && $res3)
                    $this->success('结算成功',U('money/account'));
                else
                    $this->error('结算失败');
            }else{
                $this->error($log->getError());
            }
           
            
        }else{
            $author = I('GET.author',0);
            if(!$author)
                $this->error('非法请求');
            $where['author'] = $author;
            $where['isbalance'] = 0;
            $ocutInfo = $this->db->field('SUM(ocut) as ocut,author')->where($where)->find();
            if($ocutInfo['ocut'] == NULL)
                $ocutInfo['ocut'] = '0.00';
            if($ocutInfo['author'] == NULL)
                $ocutInfo['author'] = $author;
            $mmoney = M('memeber')->field('mmoney,uname,tname')->where(array('id'=>$author))->find();
            $ocutInfo = array_merge($ocutInfo,$mmoney);
            $this->assign('ocutInfo',$ocutInfo);
            $this->display();
        }  
    }
    private function getParamWhereAndPage(){
        $get = I('GET.');
        if(empty($get)){
            $get['sid'] = 0;
            $get['mid'] = 0;
            $get['status'] = 0;
        }
        $this->assign('getParam',$get);
        $ctime = $get['ctime'];
        $where = array();
        $paramPage = array();
        if(!empty($ctime)){
            $ctimeBetween = explode('-', $ctime);
            if(count($ctimeBetween) == 2){
                $ctimeBegin = strtotime($ctimeBetween[0].' 00:00:00');
                $ctimeEnd = strtotime($ctimeBetween[1].' 23:59:59');
                $where['flower_orders.ctime'] = array('between',array($ctimeBegin,$ctimeEnd));
                $paramPage['ctime'] = $ctime;
            }
        }
        $stime = $get['stime'];
        if(!empty($stime)){
            $stimeBetween = explode('-', $stime);
            if(count($stimeBetween) == 2){
                $stimeBegin = strtotime($stimeBetween[0].' 00:00:00');
                $stimeEnd = strtotime($stimeBetween[1].' 23:59:59');
                $where['flower_orders.stime'] = array('between',array($stimeBegin,$stimeEnd));
                $paramPage['stime'] = $stime;
            }
        }
        $oid = $get['oid'];
        if(!empty($oid)){
            $where['flower_orders.oid'] = $oid;
            $paramPage['oid'] = $oid;
        }
        $flowerorder = $get['flowerorder'];
        if(!empty($flowerorder)){
            $where['flower_orders.flowerorder'] = $flowerorder;
            $paramPage['flowerorder'] = $flowerorder;
        }
        $mid = $get['mid'];
        if(!empty($mid)){
            $where['flower_orders.mid'] = $mid;
            $paramPage['mid'] = $mid;
        }
        $fshopname = $get['fshopname'];
        if(!empty($fshopname)){
            $where['flower_orders.fshopname'] = array('like',"%{$fshopname}%");
            $paramPage['fshopname'] = $fshopname;
        }
        $sid = $get['sid'];
        if(!empty($sid) && $sid != 0){
            $where['flower_orders.sid'] = $sid;
            $paramPage['sid'] = $sid;
        }
        $author = $get['author'];
        if(!empty($author) && $author != 0){
            $where['flower_orders.author'] = $author;
            $paramPage['author'] = $author;
        }
        $status = $get['status'];
        if(!empty($status) && $status != 0){
            $where['flower_orders.status'] = $status;
            $paramPage['status'] = $status;
        }
        $raddress = $get['raddress'];
        if(!empty($raddress)){
            $where['flower_orders.raddress'] = array('like',"%{$raddress}%");
            $paramPage['raddress'] = $raddress;
        }
        $name = $get['name'];
        if(!empty($name)){
            if(!empty($where['_string'])){
                $where['_string'] .= ' AND ';
            }
            $where['_string'] .= "(flower_orders.buyer = '$name') OR (flower_orders.receiver = '{$name}')";
            $paramPage['raddress'] = $raddress;
        }
        $phone = $get['phone'];
        if(!empty($phone)){
            if(!empty($where['_string'])){
                $where['_string'] .= ' AND ';
            }
            $where['_string'] .= "(flower_orders.rnumber = '$phone') OR (flower_orders.bnumber = '{$phone}')";
            $paramPage['raddress'] = $raddress;
        }
        return array('where'=>$where,'paramPage'=>$paramPage);
    }
}