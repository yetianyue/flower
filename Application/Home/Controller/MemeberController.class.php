<?php 
namespace Home\Controller;
/**
 * Description of CashController
 * 用户
 * @author 叶天跃
 * @datetime 2016-9-8 19:45:24
 */
class MemeberController extends BaseController {
	private $db;
    public function __construct(){  
        parent::__construct();
        $this->db = D('memeber');
    }
    public function lists(){
        $username = I('GET.username',NULL);
        $where = array();
        if($username != NULL){
            $where['uname'] = array('LIKE',"%{$username}%");
            $where['tname'] = array('LIKE',"%{$username}%");
            $where['_logic'] = 'OR';
        }
        $count= $this->db->where($where)->count();
        $Page= new \Think\Page($count,20);
        if(!empty($where)){
            $Page->parameter['username'] = $username;
        }
        $list= $this->db->where($where)->order('status DESC,id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->setConfig('header','<li><a>共 %TOTAL_ROW% 个用户</a></li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show= $Page->show();
        $this->assign('page',$show);
        $this->assign('list',$list);
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
            $this->display();
        }
    }
    public function del(){
    	$id = I('GET.id',0);
        if(!$id)
            $this->error('非法请求');
        
        if($id == $this->userinfo['id'])
        	$this->error('不能删除自己');
        if($this->db->where(array('id'=>$id))->delete()){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
      
    }
    public function edit(){
    	if(IS_POST){
            if($this->db->create()){
                if($this->db->save()){
                    $this->success('编辑成功',U('memeber/lists'));
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
                $this->display();
            }
        }
    }
    public function role(){
        $username = I('GET.username',NULL);
        $where = array();
        if($username != NULL){
            $where['uname'] = array('LIKE',"%{$username}%");
            $where['tname'] = array('LIKE',"%{$username}%");
            $where['_logic'] = 'OR';
        }
        $count= $this->db->where($where)->count();
        $Page= new \Think\Page($count,20);
        if(!empty($where)){
            $Page->parameter['username'] = $username;
        }
        $list= $this->db->where($where)->order('status DESC,id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->setConfig('header','<li><a>共 %TOTAL_ROW% 个用户</a></li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show= $Page->show();
        $this->assign('page',$show);
        $this->assign('list',$list);
        $this->display();
    }
    public function leave(){
        $id = I('GET.id',0);
        if(!$id)
            $this->error('非法请求');
        $where = array('id'=>$id);
        if($this->db->where($where)->save(array('status'=>0))){
            $this->success('离职成功');
        }else{
            $this->error('离职失败');
        }
    }
    public function back(){
        $id = I('GET.id',0);
        if(!$id)
            $this->error('非法请求');
        $where = array('id'=>$id);
        if($this->db->where($where)->save(array('status'=>1))){
            $this->success('复职成功');
        }else{
            $this->error('复职失败');
        }
    }
}