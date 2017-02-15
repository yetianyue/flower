<?php 
namespace Home\Controller;
/**
 * Description of OrderController
 * 订单
 * @author 叶天跃
 * @datetime 2016-9-7 13:30:24
 */
class OrderController extends BaseController {
    private $db;
    public function __construct(){  
        parent::__construct();
        $this->db = D('orders');
    }
    public function lists(){
        $sid = session_id();
        $times = F($sid);
        if(!$times){
            $times = 1;
            F($sid,$times);
        }else{
            $times += 1;
            F($sid,$times);
        }
        if($times >= 10){
            F($sid,NULL);
            $whereStr = $this->getSendListWhere();
            $sendCount = $this->db->field('oid')->where($whereStr)->count();
            
            if($sendCount > 0){
               $this->assign('sendC',$sendCount); 
            }
        }   
        $params = $this->getParamWhereAndPage($get);
        $where = $params['where'];
        $paramPage = $params['paramPage'];
        if(empty($where['flower_orders.status']))
            $where['flower_orders.status'] = array('GT',1);
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
        $mlists = M('memeber')->where(array('status'=>1))->select();
        $this->assign('mlists',$mlists);
        $this->display();
    }
    public function add(){
    	if(IS_POST){
             if($this->db->create()){
                if($this->db->add()){
                    $this->success('添加成功');
                }else{
                    $this->error('添加失败');
                }
            }else{
                $this->error($this->db->getError());
            }
        }else{
            $slists = M('source')->select();
            $this->assign('slists',$slists);
            $this->display();
        }
    }
    public function del(){
    	echo 'OrderController del';
    }
    public function edit(){
    	if(IS_POST){
            if($this->db->create()){
                if($this->db->save()){
                    $this->success('编辑成功',U('order/lists'));
                }else{
                    $this->error('编辑失败');
                }
            }else{
                $this->error($this->db->getError());
            }
        }else{
            $id = I('GET.id',0);
            if(!$id){
                $this->error('非法请求');
            }else{
                $info = $this->db->where(array('id'=>$id))->find();
                $this->assign('info',$info);
                $slists = M('source')->select();
                $this->assign('slists',$slists);
                $this->display();
            }
        }
    }
    public function cancel(){
        $params = $this->getParamWhereAndPage($get);
        $where = $params['where'];
        $paramPage = $params['paramPage'];
    	$where['flower_orders.status'] = array('EQ',1);
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
        $mlists = M('memeber')->where(array('status'=>1))->select();
        $this->assign('mlists',$mlists);
        $this->display();
    }
    public function templists(){
        $temp = D('tmporders');
        $where = array();
        $count= $temp->where($where)->count();
        $Page= new \Think\Page($count,20);
        $list= $temp->field('flower_memeber.tname as tname,flower_tmporders.*')->where($where)->join('flower_memeber on flower_tmporders.author = flower_memeber.id')->order('ctime DESC,id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->setConfig('header','<li><a>共 %TOTAL_ROW% 个交接单</a></li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show= $Page->show();
        $this->assign('page',$show);
        $this->assign('list',$list);
        $slists = M('source')->select();
        $this->assign('slists',$slists);
        $this->display();
    }
    public function tempadd(){
        if(IS_POST){
            $temp = D('tmporders');
            if($temp->create()){
                if($temp->add()){
                    $this->success('添加成功');
                }else{
                    $this->error('添加失败');
                }
            }else{
                $this->error($temp->getError());
            }
        }
    }
    public function tempdel(){
        $id = I('GET.id',0);
        $temp = D('tmporders');
        if(!$id)
            $this->error('非法请求');
        if($temp->where(array('id'=>$id))->delete()){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
    public function sendOrder(){
        if(IS_POST){
            $ids = I('POST.id',NULL);
            if(empty($ids) || $ids == NULL)
                $this->error('请选择所需配送的订单');
            $where['id'] = array('in',$ids);
            $res = $this->db->where($where)->save(array('issend'=>1));
            if($res)
                $this->success('配送成功',U('order/lists'));
            else
                $this->error('配送失败');
        }
    }
    public function getSendList(){
        if(IS_AJAX){
            $whereStr = $this->getSendListWhere();
            $list = $this->db->field('id,oid,receiver,rnumber')->where($whereStr)->select();
            if(empty($list))
                $this->ajaxReturn(array('status'=>0,'msg'=>'<center>暂无数据</center>'));
            $this->ajaxReturn(array('status'=>1,'list'=>$list));
        }
    }
    private function getSendListWhere(){
        $nowTime = time();
        $endTime = $nowTime +10800;
        $whereStr = "status > 1 AND issend = 0 AND stime > {$nowTime} "; //AND stime < {$endTime}
        return $whereStr;
    }
    private function getParamWhereAndPage(){
        $get = I('GET.');
        if(empty($get)){
            $get['sid'] = 0;
            $get['mid'] = 0;
            $get['status'] = 0;
        }
        $get['ctime'] = str_replace('+', '', $get['ctime']);
        $get['stime'] = str_replace('+', '', $get['stime']); 
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