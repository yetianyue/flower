<?php
namespace Home\Controller;
/**
 * Description of IndexController
 * 首页
 * @author 叶天跃
 * @datetime 2016-9-7 13:30:24
 */
class IndexController extends BaseController {
    public function __construct(){  
        parent::__construct();
    }
    public function index(){
       redirect(U('order/lists'));
    }
}