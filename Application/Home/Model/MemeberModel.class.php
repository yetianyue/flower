<?php
namespace Home\Model;
use Think\Model;
/**
 * Description of MemeberModel
 * 来源模型
 * @author 叶天跃
 * @datetime 2016-9-8 20:57:50
 */
class MemeberModel extends Model{
    //自动验证
    protected $_validate=array(
        array('uname','require','用户名不能为空!'),
        array('uname','/^[A-Za-z]/i','用户名必须为字母',0,'regex'),
        array('tname','require','真实姓名不能为空!'),
        array('uname','','用户名已经存在!',0,'unique',1),
        array('passwd','require','密码不能为空!'),
        array('repasswd','passwd','两次密码不正确!',0,'confirm'),
        array('roleid',array(1,2),'非法权限ID',0,'in'),
        array('proportion','checkProportion','请输入正确的提成百分点',1,'callback',3)
    );
    protected $_auto=array(
        array('ctime','time',1,'function'),
        array('passwd','md5',3,'function')
    );
    public function checkProportion($proportion){
        $p = intval($proportion);
        if($p >= 0 && $p <= 100)
            return TRUE;
        else
            return FALSE;
    }
}
