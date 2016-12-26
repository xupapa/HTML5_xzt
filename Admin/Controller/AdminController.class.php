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
						$url=U("Admin/Index/index");
		           		echo "<script> alert('登录成功！');parent.location.href='$url'; </script>";
					}
					else
					{
						echo <<<STR
				                <script>
				                alert("用户名或密码不正确！");
				                window.history.go(-1);
				                </script>
STR;
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
						$url=U("Admin/SuperIndex/superIndex");
		           		echo "<script> alert('登录成功！');parent.location.href='$url'; </script>";
					}
					else
					{
						echo <<<STR
				                <script>
				                alert("用户名或密码不正确！");
				                window.history.go(-1);
				                </script>
STR;
					}
				}
			}
			else
			{
				echo <<<STR
				                <script>
				                alert("用户类型未选择！");
				                window.history.go(-1);
				                </script>
STR;
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
			$url=U("Admin/Admin/login");
       		echo "<script> alert('退出成功！');parent.location.href='$url'; </script>";
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
						$url=U("Admin/Index/index");
       					echo "<script> alert('修改成功！');parent.location.href='$url'; </script>";
					}
				}
			}
			else
			{
				echo <<<STR
				                <script>
				                alert("密码与确认密码不一致！");
				                window.history.go(-1);
				                </script>
STR;
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
