<?php 
namespace Home\Model;
use Think\Model;
/**
 * Description of CashModel
 * 返现模型
 * @author 叶天跃
 * @datetime 2016-9-9 20:57:50
 */
class CashModel extends Model{
    //自动验证
    protected $_validate=array(
        array('alpaynumber,tbnumber','checkNumber','只能存在一个账号!',1,'callback',3),
        array('cashprice','require','金额不能为空!'),
        array('cashprice','/^([0-9]+|[0-9]{1,3}(,[0-9]{3})*)(.[0-9]{1,2})?$/','钱的格式不正确!',0,'regex'),
    );
    protected $_auto=array(
        array('ctime','time',1,'function'),
        array('author','getName',3,'callback')
    ); 
    public function checkNumber($filed){
        if($filed['alpaynumber'] == '' && $filed['tbnumber'] =='')
            return FALSE;
        if($filed['alpaynumber'] != '' && $filed['tbnumber'] !='')
            return FALSE;
        return TRUE;
    }
    public function getName(){
        $userinfo =  session('userinfo');
        if(empty($userinfo))
            $this->error('请重新登录',U('login/index'));
        return $userinfo['id'];
    }
}