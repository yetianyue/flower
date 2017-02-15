<?php
namespace Home\Model;
use Think\Model;
/**
 * Description of PaylogModel
 * 结算模型
 * @author 叶天跃
 * @datetime 2016-9-11 16:57:50
 */
class PaylogModel extends Model{
    //自动验证
    protected $_validate=array(
        array('uname','checkTname','非法请求',1,'callback',3),
        array('ocut','/^([0-9]+|[0-9]{1,3}(,[0-9]{3})*)(.[0-9]{1,2})?$/','需要结算订单的金额格式不正确!',0,'regex'),
        array('mmoney','/^([0-9]+|[0-9]{1,3}(,[0-9]{3})*)(.[0-9]{1,2})?$/','上次结算订单的余额格式不正确!',0,'regex'),
        array('pay','/^([0-9]+|[0-9]{1,3}(,[0-9]{3})*)(.[0-9]{1,2})?$/','实际结算金额格式不正确!',0,'regex'),
        array('sname','','来源名称已经存在!',0,'unique',1),
    );
    protected $_auto=array(
        array('ctime','time',1,'function'),
        array('ocuta','getOcuta',3,'callback'),
        array('opertor','getOpertor',3,'callback'),
    ); 
    public function checkTname($tname){
    	$info = D('memeber')->where(array('uname'=>$tname))->field('id')->find();
        if(empty($info))
            return FALSE;
        if($info['id'] != $_POST['author'])
            return FALSE;
    	return TRUE;
    }
    public function getOcuta(){
    	return round($_POST['ocut'] + $_POST['mmoney'],2);
    }
    public function getOpertor(){
    	$userinfo =  session('userinfo');
        if(empty($userinfo))
            $this->error('请重新登录',U('login/index'));
        return $userinfo['uname'];
    }
}
