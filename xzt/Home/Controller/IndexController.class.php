<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }
    public function comment_wish(){
    	$nameModel=M('sellertab');
    	$name=$nameModel->select();
    	$this->assign('name',$name);
    	$this->display();
    }
}