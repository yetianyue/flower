<?php 
namespace Home\Controller;
/**
 * Description of JorderController
 * 基础信息
 * @author 叶天跃
 * @datetime 2016-9-7 13:22:24
 */
class SourceController extends BaseController {
    private $db;
    public function __construct(){  
        parent::__construct();
        $this->db = D('source');
    }
    public function lists(){
        $osKey = C('ORDER_SCALE');
        $scale = M('config')->where(array('ckey'=>$osKey))->find();
        $this->assign('scale',$scale);
        $where = array();
        $count= $this->db->where($where)->count();
        $Page= new \Think\Page($count,15);
        $list= $this->db->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->setConfig('header','<li><a>共 %TOTAL_ROW% 个来源</a></li>');
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
        $count = D('orders')->where(array('sid'=>$id))->count();
        if($count > 0)
            $this->error('此来源存在订单内容');
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
                    $this->success('编辑成功',U('source/lists'));
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
    public function scaleChange(){
        if(IS_POST){
            $ckey = I('POST.ckey','');
            if($ckey != C('ORDER_SCALE'))
                $this->error('非法请求!');
            $cvalue = I('POST.cvalue',0,'int');
            if(!$cvalue)
                $this->error('非法参数!');
            if(M('config')->where(array('ckey'=>$ckey))->save(array('cvalue'=>$cvalue))){
                F(C('ORDER_SCALE'),$cvalue);
                $this->success('修改成功');
            }else{
                $this->error('修改失败!');
            }
        }
    }
}