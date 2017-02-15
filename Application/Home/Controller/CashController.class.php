<?php 

namespace Home\Controller;
/**
 * Description of CashController
 * 返现
 * @author 叶天跃
 * @datetime 2016-9-7 13:45:24
 */
class CashController extends BaseController {
    private $db;
    public function __construct(){  
        parent::__construct();
        $this->db = D('cash');
    }
    public function lists(){
        $where = array('flower_cash.status'=>1);
        $count= $this->db->where($where)->count();
        $Page= new \Think\Page($count,20);
        $list= $this->db->field('flower_memeber.tname as tname,flower_cash.*')->where($where)->join('flower_memeber on flower_cash.author = flower_memeber.id')->order('ctime DESC,id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->setConfig('header','<li><a>共 %TOTAL_ROW% 个返现单</a></li>');
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
        }
    }
    public function del(){
    	$id = I('GET.id',0);
        if(!$id)
            $this->error('非法请求');
        if($this->db->where(array('id'=>$id))->save(array('status'=>0))){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
    public function edit(){
    	if(IS_POST){
            if($this->db->create()){
                if($this->db->save()){
                    $this->success('编辑成功',U('cash/lists'));
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
}