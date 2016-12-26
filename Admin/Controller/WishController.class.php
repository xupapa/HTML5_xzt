<?php
	namespace Admin\Controller;
	use Think\Controller;

	class WishController extends Controller{
		public function __construct(){
			parent::__construct();
			if(!isLogin())
			{
				$this->error("请先登录",U("Admin/login"));
			}
		}
		public function adopt()
		{
			$wid=I("id");
			$wishModel=M("wishtab");
			$susername=$_SESSION['susername'];
			$wdata=$wishModel->where("susername='$susername'and wid='$wid'")->find();
		
			if($wdata['wish_type']=='已采纳')
			{
				$this->success("已采纳",U("allWish"));
			}
			else
			{
				$busername=$wdata['busername'];
				$buserModel=M("buyertab");
				$data=$buserModel->where("busername='$busername'")->find();
				$buserModel->score=$data['score']+5;
				$wishModel->wish_type='已采纳';
				if($wishModel->where("susername='$susername'and wid='$wid'")->save()&&$buserModel->where("busername='$busername'")->save())
				{
					$this->success("成功采纳",U("allWish"));
				}
			}
		}
		public function allWish()
		{
			$wishModel=M("wishtab");
			$susername=$_SESSION['susername'];
			$count=$wishModel->where("susername='$susername'")->count();
			$Page=new\Think\Page($count,5);
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$show=$Page->show();

			$data=$wishModel->where("susername='$susername'")->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign("wishtab",$data);
			$this->assign('pages',$show);
			$this->display();
		
		}
		public function adoptWish()
		{
			$wishModel=M("wishtab");
			$susername=$_SESSION['susername'];
			$count=$wishModel->where("susername='$susername'and wish_type='已采纳'")->count();
			$Page=new\Think\Page($count,5);
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$show=$Page->show();
			$data=$wishModel->where("susername='$susername'and wish_type='已采纳'")->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign("adopt_wish",$data);
			$this->assign('pages',$show);
			$this->display();
		}
		public function wish_comment()
		{
			$susername=$_SESSION['susername'];
			$wishCommentModel=M("wishtab_comment");
			$count=$wishCommentModel->join("wishtab on wishtab.wid=wishtab_comment.wid")->where("susername='$susername'")->count();
			$Page=new\Think\Page($count,5);
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$show=$Page->show();
			$data=$wishCommentModel->join("wishtab on wishtab.wid=wishtab_comment.wid")->where("susername='$susername'")->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign("wish_comment",$data);
			$this->assign('pages',$show);
			$this->display();
		}
		public function wish_view()
		{
			$wid=I("id");
			$wishModel=M("wishtab");
			$data=$wishModel->where("wid='$wid'")->find();
			$this->assign("wish_view",$data);
			$this->display();
		}
		public function adopt_view()
		{
			$wid=I("id");
			$wishModel=M("wishtab");
			$data=$wishModel->where("wid='$wid'")->find();
			$this->assign("adopt_view",$data);
			$this->display();
		}
		public function comment_view()
		{
			$wcid=I("id");
			$wishCommentModel=M("wishtab_comment");
			$data=$wishCommentModel->join("wishtab on wishtab.wid=wishtab_comment.wid")->where("wcid='$wcid'")->find();
			$this->assign("comment_view",$data);
			$this->display();
		}
	}
?>