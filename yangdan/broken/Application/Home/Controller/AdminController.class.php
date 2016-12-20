<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller {
    public function login(){
    	if(IS_POST){
			$buserModel=M('buyertab');//数据库admin_users对应代码adminUsers
		    $condition = array(
		    	"busername"=>I("post.busername"),
		    	"bpassword"=>I("post.bpassword")
			);
			$result=$buserModel->where($condition)->count();//多少条数据
			if($result>0){ //如果数据条数>
				$condition['bid']=$buserModel->field('bid')->find();
				$condition['sex']=$buserModel->field('sex')->find();
				$_SESSION['user']=$condition;
				 //print_r($_SESSION['user']);exit;
				$this->success("登陆成功",U("Amusement/yl_movie"));
			}
			else{
				$this->error("登录不成功");
			}
    	}
    	else{
    		$this->display();

    	}
    }

}