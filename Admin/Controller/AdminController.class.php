<?php
namespace Admin\Controller;
use Think\Controller;

class AdminController extends Controller{
	public function login(){
		if(IS_POST){
			if(I("post.astype"))
			{
				$astype=I("post.astype");
				if($astype==1)
				{
					$condition=array(
						"susername"=>I("post.username"),
						"spassword"=>I("post.password")
					);
					$sellerModel=M("sellertab");
					$result=$sellerModel->where($condition)->count();
					if($result>0)
					{
						$shopModel=M("sellertab");
						$data=$shopModel->where($condition)->find();
						$shopname=$data['shopname'];
						session("shopname",$shopname);
						session("susername",I("post.username"));
						$this->success("登录成功！",U("Index/index"));
					}
					else
					{
						$this->error("用户名或密码不正确");
					}
				}
				else if($astype==2)
				{
					$condition=array(
						"aname"=>I("post.username"),
						"apassword"=>I("post.password")
					);
					$adminModel=M("admintab");
					$result=$adminModel->where($condition)->count();
					if($result>0)
					{
						session("aname",I("post.username"));
						$this->success("登录成功！",U("SuperIndex/superIndex"));
					}
					else
					{
						$this->error("用户名或密码不正确");
					}
				}
			}
			else
			{
				$this->error("用户类型未选择");
			}
			
		}
		else
		{
			$this->display();
		}
		
		
	}
	public function logout()
	{
		if(session_destroy())
		{
			$this->success("退出成功！",U("Admin/login"));
		}

	}
	public function password_edit()
	{
		if(IS_POST)
		{
			if(I("spassword")==I("repassword"))
			{
				//$shopname=$_SESSION['shopname'];
				$adminModel=M("sellertab");
				if($adminModel->create())
				{
					$sid=I("sid");
					if($adminModel->where("sid=$sid")->save())
					{
						$this->success("修改成功!",U("Admin/Index/index"));
					}
				}
			}
			else
			{
				$this->error("密码与确认密码不一致");
			}
		}
		else
		{
			$susername=$_SESSION['susername'];
			$adminModel=M("sellertab");
			$condition['susername']=$susername;
			$data=$adminModel->where($condition)->find();
			$this->assign("sellertab",$data);
			$this->display();
		}
		
	}
}
