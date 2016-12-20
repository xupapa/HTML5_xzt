<?php
	namespace Admin\Controller;
	use Think\Controller;

	class ShopController extends Controller{
		public function __construct(){
			parent::__construct();
			if(!isLogin())
			{
				$this->error("请先登录",U("Admin/login"));
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

			if($info!=false)
			{
				$data['simage']=$info['simage']['savename'];
			}
			$susername=$_SESSION['susername'];
			if($shopModel->where("susername='$susername'")->save($data))
			{
				$this->success("修改成功！",U("shop_news"));
			}
			else
			{
				$this->error("未修改！");
			}
		}
	}
?>