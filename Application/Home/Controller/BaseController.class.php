<?php
namespace Home\Controller;
use Think\Controller;
/**
 * Description of BaseController
 * 基类
 * @author 叶天跃
 * @datetime 2016-9-7 12:45:24
 */
class BaseController extends Controller{
    public $userinfo;
    public $requestInfo;
    public function __construct() {
        parent::__construct();
        $this->checkLogin();
        $this->getGlobalInfo();
        $this->checkRole();
    }
    private function getGlobalInfo(){
        $this->requestInfo = array('m'=>MODULE_NAME,'c'=>CONTROLLER_NAME,'a'=>ACTION_NAME);
        $this->assign('requestInfo',$this->requestInfo);
        $controllerInfo = array(
            'Memeber'=>'用户管理',
            'Source'=>'基础信息',
            'Cash'=>'返现',
            'Jorder'=>'交接单',
            'Order'=>'订单管理',
            'Money'=>'财务',
            'Index'=>'首页');
        $this->assign('cname',$controllerInfo[CONTROLLER_NAME]);
    }
    private function checkRole(){
        if($this->userinfo['roleid'] == 1){
            return TRUE;
        }
        $role = array(
            'order/lists','order/add','order/del','order/cancel','order/edit',
             'order/templists', 'order/tempadd','order/tempdel','order/getsendlist','order/sendorder',
            'cash/lists','cash/add','cash/del','cash/edit',                    
            'jorder/lists','jorder/add','jorder/del','jorder/edit',            
            'money/lists',                      
            'base/logout',
            );
        $reuestPath = strtolower($this->requestInfo['c'].'/'.$this->requestInfo['a']);
        if(!in_array($reuestPath, $role)){
            header("HTTP/1.0 404 Not Found");
            redirect(U('Public/404'));
        }
        return TRUE;
    }
    private function checkLogin(){
        $this->userinfo = session('userinfo');
        if(empty($this->userinfo))
            redirect(__ROOT__.'/login.html');
        $this->assign('userinfo',$this->userinfo);
    }
    final public function logout(){
        session('userinfo',0);
        $sid = session_id();
        F($sid,NULL);
        redirect(__ROOT__.'/login.html');
    }
}
