<?php
	namespace Admin\Controller;
	use Think\Controller;

	class CategoryController extends Controller{
		public function __construct(){
			parent::__construct();
			if(!isLogin())
			{
				$this->error("请先登录",U("Admin/login"));
			}
		}
		public function allCategory()
		{
			$susername=$_SESSION['susername'];
			$sellerModel=M("sellertab");
			$sellerdata=$sellerModel->query("select sid from sellertab where susername='$susername'");
			$sid=$sellerdata[0]['sid'];
			$categoryModel=M("product_category");
			$count=$categoryModel->where("sid=$sid")->count();
			$Page=new\Think\Page($count,5);
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$show=$Page->show();
			$data=$categoryModel->where("sid=$sid")->page($_GET['p'].',5')->select();
			$this->assign('pages',$show);
			$this->assign("category",$data);


			$this->display();
		}
		public function category_edit()
		{
			$pcname=I("pcname");
			dump($pcname);
			/*$id=I("id");
			$categoryModel=M("product_category");
			$data=$categoryModel->find($id);
			$this->assign("category",$data);*/
		}
		public function delete()
		{
			$id=I('id');
			$categoryModel=M("product_category");
			if($categoryModel->where("pcid=$id")->delete())
			{
				$this->success("删除成功");
			}
			else
			{
				$this->error("删除失败");
			}
		}
		public function destoryBatch()
		{
			$categoryModel=M("product_category");
			$id=I("id");
			if(is_array($id))
			{
				$getid=implode(',', $id);
			}else
			{
				$getid=$id;
			}
			$conditon['pcid']=array('in',$getid);
			if($categoryModel->where($conditon)->delete())
			{
				$this->success("成功删除!",U("Admin/Category/allCategory/p/1"));
			}else
			{
				$this->error('删除失败!');
			}
		}
	}
?>