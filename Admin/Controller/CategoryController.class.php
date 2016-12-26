<?php
	namespace Admin\Controller;
	use Think\Controller;

	class CategoryController extends Controller{
		public function __construct(){
			parent::__construct();
			if(!isLogin())
			{
				$url=U("Admin/Admin/login");
           		echo "<script> alert('请先登录！');parent.location.href='$url'; </script>";
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
			$data=$categoryModel->where("sid=$sid")->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('pages',$show);
			$this->assign("category",$data);


			$this->display();
		}
		public function category_edit()
		{
			$susername=$_SESSION['susername'];
			$sellerModel=M("sellertab");
			$sellerdata=$sellerModel->query("select sid from sellertab where susername='$susername'");
			$sid=$sellerdata[0]['sid'];
			$pcid=I("pcid");
			$categoryModel=M("product_category");
			$data=$categoryModel->create();
			$data['sid']=$sid;
			if($data['pcname']==NULL)
			{
				echo <<<STR
			                <script>
			                alert("请输入类型！");
			                window.history.go(-1);
			                </script>
STR;

			}
			else
			{
				if($categoryModel->where("pcid ='$pcid'")->save($data))
				{
					$url=U("Admin/Category/allCategory");
		           	echo "<script> alert('修改成功！');parent.location.href='$url'; </script>";
				}
				else
				{
					echo <<<STR
				                <script>
				                alert("修改失败！");
				                window.history.go(-1);
				                </script>
STR;
				}
			}
			
		}
		public function delete()
		{
			$id=I('id');
			$categoryModel=M("product_category");
			if($categoryModel->where("pcid=$id")->delete())
			{
				$url=U("Admin/Category/allCategory");
	           	echo "<script> alert('删除成功！');parent.location.href='$url'; </script>";
			}
			else
			{
				echo <<<STR
			                <script>
			                alert("删除失败！");
			                window.history.go(-1);
			                </script>
STR;
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
				$url=U("Admin/Category/allCategory");
	           	echo "<script> alert('删除成功！');parent.location.href='$url'; </script>";
			}else
			{
				echo <<<STR
			                <script>
			                alert("删除失败！");
			                window.history.go(-1);
			                </script>
STR;
			}
		}
		public function category_add()
		{
			$susername=$_SESSION['susername'];
			$sellerModel=M("sellertab");
			$sellerdata=$sellerModel->query("select sid from sellertab where susername='$susername'");
			$sid=$sellerdata[0]['sid'];
			$categoryModel=M("product_category");
			$data=$categoryModel->create();
			$data['sid']=$sid;
			if($data['pcname']==NULL)
			{
				echo <<<STR
			                <script>
			                alert("请输入类型！");
			                window.history.go(-1);
			                </script>
STR;

			}
			else
			{
				if($categoryModel->add($data))
				{
					$url=U("Admin/Category/allCategory");
	           		echo "<script> alert('数据添加成功！');parent.location.href='$url'; </script>";
				}
				else
				{
					echo <<<STR
			                <script>
			                alert("数据添加失败！");
			                window.history.go(-1);
			                </script>
STR;
				}
			}
			
		}
	}
?>