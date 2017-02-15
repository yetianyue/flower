<?php 
namespace Home\Model;
use Think\Model;
/**
 * Description of JorderModel
 * 交接单模型
 * @author 叶天跃
 * @datetime 2016-9-8 20:57:50
 */
class JorderModel extends Model{
    //自动验证
    protected $_validate=array(
        array('msg','require','交接单内容不能为空!'),
    );
    protected $_auto=array(
        array('ctime','time',1,'function'),
        array('author','getName',3,'callback')
    ); 
    public function getName(){
        $userinfo =  session('userinfo');
        if(empty($userinfo))
            $this->error('请重新登录',U('login/index'));
        return $userinfo['id'];
    }
}