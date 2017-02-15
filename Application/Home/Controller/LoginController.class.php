<?php
namespace Home\Controller;
use Think\Controller;
/**
 * Description of LoginController
 * @author 叶天跃
 * @datetime 2016-9-7 13:23:24
 */
class LoginController extends Controller{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        $this->display();
    }
    public function check(){
        if(IS_POST){
        	$memeber = D('memeber');
        	$uname = I('POST.uname',NULL);
        	$passwd = I('POST.passwd',NULL);
        	$info = $memeber->where(array('uname'=>$uname))->find();
        	if(empty($info))
        		$this->error('用户名不存在!');
            if($info['status'] != 1)
                $this->error('该业务员未入职!');
        	if($info['passwd'] != md5($passwd))
        		$this->error('用户名或者密码不正确!');
        	$ip = $_SERVER['REMOTE_ADDR'];
        	$ltime = time();
        	$data = array('lipaddress'=>$ip,'ltime'=>$ltime);
        	$memeber->where(array('id'=>$info['id']))->save($data);
        	unset($info['passwd']);
        	session('userinfo',$info);
        	redirect(U('order/lists'));
        }
    }
    public function register(){
        if(IS_POST){
            $post = I('POST.');
            $data = array(
                'uname'=>$post['unameregister'],
                'tname'=>$post['tnameregister'],
                'passwd'=>$post['passwdregister'],
                'repasswd'=>$post['repasswdregister']
                );
            $_validate=array(
                array('uname','require','用户名不能为空!'),
                array('uname','/^[A-Za-z]/i','用户名必须为字母',0,'regex'),
                array('tname','require','真实姓名不能为空!'),
                array('uname','','用户名已经存在!',0,'unique',1),
                array('passwd','require','密码不能为空!'),
                array('repasswd','passwd','两次密码不一致!',0,'confirm'),
            );
            $memeber = M('memeber');
            $data = $memeber->validate($_validate)->create($data);
            if($data){
                $data['passwd'] = md5($data['passwd']);
                $data['status'] = 0;
                if($memeber->add($data)){
                    $this->success('注册成功',U('login/index'));
                }else{
                    $this->error('注册失败');
                }
            }else{
                $this->error($memeber->getError());
            }
        }else{
            $this->display();
        }
    }
}
