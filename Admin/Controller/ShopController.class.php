<?php
	namespace Admin\Controller;
	use Think\Controller;

	class ShopController extends Controller{
		public function __construct(){
			parent::__construct();
			if(!isLogin())
			{
				$url=U("Admin/Admin/login");
           		echo "<script> alert('请先登录！');parent.location.href='$url'; </script>";
			}
		}
		public function shop_news()
		{
			$shopname=$_SESSION['shopname'];
			$adminModel=M("sellertab");
			$condition['shopname']=$shopname;
			$data=$adminModel->where($condition)->find();
			$this->assign("shop",$data);
			$this->display();
		}
		public function shop_edit()
		{
			$upload = new \Think\Upload();
			$upload->maxSize=3145728 ;
			$upload->exts=array('jpg', 'gif', 'png', 'jpeg');
			$upload->rootPath="./Public/upload/";
			$upload->saveName = '';
			$upload->replace=true;
			$upload->autoSub=false;
			$info=$upload->upload();

			$shopModel=M("sellertab");
			$data=$shopModel->create();
			$susername=$_SESSION['susername'];
			if($info!=false)
			{
				$data['simage']=$info['simage']['savename'];
			}
			if($data['shopname']==null)
			{
				echo <<<STR
			                <script>
			                alert("店铺名不得为空");
			                window.history.go(-1);
			                </script>
STR;
			}
			else if($data['introduce']==null)
			{
				echo <<<STR
			                <script>
			                alert("店铺介绍不得为空");
			                window.history.go(-1);
			                </script>
STR;
			}
			else
			{
				if($shopModel->where("susername='$susername'")->save($data))
				{
					$url=U("shop_news");
	           		echo "<script> alert('修改成功！');parent.location.href='$url'; </script>";
				}
				else
				{
					echo <<<STR
			                <script>
			                alert("未修改！");
			                window.history.go(-1);
			                </script>
STR;
				}
			}
			
		}
	}
?>