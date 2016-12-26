<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
    	if (IS_POST) {
            $Model = M('buyertab');
            $condition1 = array(
                    "busername" => I("post.username"),
                    "bpassword" => I("post.password")
                );
            $result = $Model->where($condition)->find();
            if ($result > 0) {
                $condition['busername']=I("post.username");
                $condition['bpassword']=I("post.password");
                $condition['bid']=$Model->where($condition1)->field('bid')->find();
                $condition['score']=$Model->where($condition1)->field('score')->find();
                $condition['sex']=$Model->where($condition1)->field('sex')->find();
                $condition['blevel']=$Model->where($condition1)->field('blevel')->find();
                $_SESSION['user']=$condition;

                //session("username", I("post.username"));
                $this->success("登录成功！", U("Index/index"));
            }
            else {
                $this->error("用户名或密码不正确");
            }
        }
        else {
            $this->display();   
        }
    }
    // 注册用户$length = strlen();
    public function registered(){   
        if(IS_POST){
            $userModel=M("buyertab");
            $data['busername']=I("post.username");
            $data['bpassword']=I("post.password");
            $data['sex']=I("docInlineRadio");
            $name=array(
                "busername" => I("post.username")
            );
            $d=$_POST['rpassword'];
            $a=$_POST['password'];
            if (strlen(I("post.username"))<5||strlen(I("post.username"))>16) {
                $this->error("用户名长度不符");
            }
            if ($userModel->where($name)->find()) {
                $this->error("用户名已被注册");
            }
            if (strlen(I("post.password"))<6||strlen(I("post.password"))>20) {
                $this->error("密码长度6~20位");
            }
            if ($d!=$a) {
                $this->error("两次密码不一致");
            }
            if($userModel->add($data)){
                $this->success("注册成功",U('Index/index'));
            }
            else{
                $this->error("注册失败");
            }
        }
        else {
            $this->display();   
        }

    }
}