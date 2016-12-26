<?php
	namespace Admin\Controller;
	use Think\Controller;

	class CommentController extends Controller{
		public function __construct(){
			parent::__construct();
			if(!isLogin())
			{
				$url=U("Admin/Admin/login");
           		echo "<script> alert('请先登录！');parent.location.href='$url'; </script>";
			}
		}
		public function shopComment()
		{
			$susername=$_SESSION['susername'];
			$sellerModel=M("sellertab");
			$data=$sellerModel->where("susername='$susername'")->find();
			$sid=$data['sid'];
			$commentModel=M("chips");
			$count=$commentModel->join("buyertab on chips.bid=buyertab.bid")->where("sid='$sid'")->count();
			$Page=new\Think\Page($count,8);
			$show=$Page->show();
			$list=$commentModel->join("buyertab on chips.bid=buyertab.bid")->where("sid='$sid'")->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign("commenttab",$list);
			$this->assign('pages',$show);
			$this->display();
		}
		public function goodsComment()
		{
			$susername=$_SESSION['susername'];
			$sellerModel=M("sellertab");
			$data=$sellerModel->where("susername='$susername'")->find();
			$sid=$data['sid'];
		    $commentModel=M("com_products");

		    $count=$commentModel->join("buyertab on com_products.bid=buyertab.bid")->where("sid='$sid'")->count();
			$Page=new\Think\Page($count,8);
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$show=$Page->show();
			$list=$commentModel->join("buyertab on com_products.bid=buyertab.bid")->where("sid='$sid'")->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('commenttab',$list);
			$this->assign('pages',$show);
			$this->display();
		}
		public function shopView()
		{
			$cid=I("id");
			$commentModel=M("commenttab");
			$shopdata=$commentModel->where("cid='$cid'")->find();
			$this->assign("commenttab",$shopdata);
			$this->display();
		}
		public function goodsView()
		{
			$cid=I("id");
		    $commentModel=M("com_products");
			$goodsdata=$commentModel->join("buyertab on com_products.bid=buyertab.bid")->where("cid='$cid'")->find();
			$this->assign("commenttab",$goodsdata);
			$this->display();
		}
	}
?>