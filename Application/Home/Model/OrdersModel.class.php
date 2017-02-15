<?php 
namespace Home\Model;
use Think\Model;
/**
 * Description of OrderModel
 * 订单模型
 * @author 叶天跃
 * @datetime 2016-9-10 14:57:50
 */
class OrdersModel extends Model{
    //自动验证
    protected $_validate=array(
        array('sid','checkSid','请选择正确的来源',1,'callback',3),
        array('oid','require','订单编号为空'),
        //array('oid','','订单编号已经存在!',0,'unique',1),
        array('mid','require','会员号为空'),
        array('receiver','require','收货人姓名为空'),
        array('rnumber','require','收货人电话为空'),
        array('raddress','require','收货地址为空'),
        array('stime','checkStime','收货时间格格式不正确',1,'callback',3),
        array('producelist','require','产品列表为空'),
        array('status',array(1,2,3,4),'请选择订单状态',1,'in'),
        array('osprice','/^([0-9]+|[0-9]{1,3}(,[0-9]{3})*)(.[0-9]{1,2})?$/','订单总价格式不正确',0,'regex'),
        array('oscost','/^([0-9]+|[0-9]{1,3}(,[0-9]{3})*)(.[0-9]{1,2})?$/','成本价格格式不正确',0,'regex'),
        array('flowerqq','/^\d+$/','QQ号码格式不正确',0,'regex'),
        array('fshopname','require','花店名称为空'),
        array('freight','/^([0-9]+|[0-9]{1,3}(,[0-9]{3})*)(.[0-9]{1,2})?$/','运费价格格式不正确',2,'regex'),
        array('flowerorder','require','花集订单为空'),
    );
    protected $_auto=array(
        array('stime','getStime',3,'callback'),
        array('ctime','time',1,'function'),
        array('author','getName',3,'callback'),
        array('oprofit','getProfit',3,'callback'),
        array('ocutpresent','getCutPresent',3,'callback'),
        array('ocut','getCut',3,'callback'),
        array('freight','getFreight',3,'callback'),
        array('isbalance',0),

    ); 
    public function checkNumber($filed){
        if($filed['alpaynumber'] == '' && $filed['tbnumber'] =='')
            return FALSE;
        if($filed['alpaynumber'] != '' && $filed['tbnumber'] !='')
            return FALSE;
        return TRUE;
    }
    function checkSid($sid){
       if($sid < 0)
            return FALSE;
       $count = M('source')->where(array('id'=>$sid))->count();
       if($count > 0)
            return TRUE;
        else 
            return FALSE;
    }
    public function checkStime($stime){
        $dateFormat = date('Y-m-d H:i',strtotime($stime));
        if($dateFormat == $stime)
            return TRUE;
        else
            return FALSE;
    }
    public function getStime(){
        return strtotime($_POST['stime']);   
    }
    public function getName(){
        $userinfo =  session('userinfo');
        if(empty($userinfo))
            $this->error('请重新登录',U('login/index'));
        return $userinfo['id'];
    }
    //获取利润
    public function getProfit(){
        return round($_POST['osprice']*C('ORDER_PRICE_PRESENT') - $_POST['oscost'],2);
    }
    //获取提成百分点
    public function getCutPresent(){
        $userid = $this->getName();
        $key = 'proportion_'.$userid;
        $present = F($key);
        if(empty($present)){
            $info = M('memeber')->field('proportion')->where(array('id'=>$userid))->find();
            F($key,$info['proportion']);
            $present = $info['proportion'];
        }
        return $present;
    }
    //获取业务员提成
    public function getCut(){
        $present = $this->getCutPresent();
        $userid = $this->getName();
        $key = 'proportion_'.$userid;
        F($key,NULL);
        $present = $present/100;
        $profit = $this->getProfit();
        return round($profit*$present,2);
    }
    public function getFreight(){
        if($_POST['freight'] == '')
            return '0.00';
        else
            return $_POST['freight'];
    }
}