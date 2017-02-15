<?php
namespace Home\Model;
use Think\Model;
/**
 * Description of TmpordersModel
 * 临时订单模型
 * @author 叶天跃
 * @datetime 2016-9-21 20:57:50
 */
class TmpordersModel extends Model{
    //自动验证
    protected $_validate=array(
        array('content','require','临时订单内容不能为空!'),
    );
    protected $_auto=array(
        array('ctime','time',1,'function'),
        array('author','getName',3,'callback'),
    ); 
    public function getName(){
        $userinfo =  session('userinfo');
        if(empty($userinfo))
            $this->error('请重新登录',U('login/index'));
        return $userinfo['id'];
    }
}
