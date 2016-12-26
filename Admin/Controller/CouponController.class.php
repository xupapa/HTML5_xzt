<?php
	namespace Admin\Controller;
	use Think\Controller;

	class CouponController extends Controller{
		public function __construct(){
			parent::__construct();
			if(!isLogin())
			{
				$this->error("请先登录",U("Admin/login"));
			}
		}
		public function allCoupon()
		{
			$couponModel=M("coupontab");
			$susername=$_SESSION['susername'];
			$count=$couponModel->where("susername='$susername'")->count();
			$Page=new\Think\Page($count,5);
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$show=$Page->show();
			$data=$couponModel->where("susername='$susername'")->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign("coupontab",$data);
			$this->assign('pages',$show);
			$this->display();
		}
		public function coupon_edit()
		{
			if(IS_POST)
			{
				$id=I("id");
				$couponModel=M("coupontab");
				if($couponModel->create())
				{
					if($couponModel->where("id='$id'")->save())
					{
						$this->success("修改成功！",U("allCoupon"));
					}
					else
					{
						$this->error("修改失败！");
					}
				}
			}
			else
			{
				$id=I("id");
				$couponModel=M("coupontab");
				$data=$couponModel->where("id='$id'")->find();
				$this->assign("coupon",$data);
				$this->display();
			}
			
		}
		public function addCoupon()
		{
			if(IS_POST)
			{
				$couponModel=M("coupontab");
				$susername=$_SESSION['susername'];
				$data=$couponModel->create();
				$data['susername']=$susername;
				if($couponModel->add($data))
				{
					$this->success("添加成功",U("allCoupon"));
				}
				else
				{
					$this->error("添加失败");
				}
			}
			else
			{
				$this->display();
			}
			
		}
		public function adoptCoupon()
		{
			$couponModel=M("coupontab");
			$susername=$_SESSION['susername'];
			$count=$couponModel->where("susername='$susername'and busername is not null")->count();
			$Page=new\Think\Page($count,5);
			$show=$Page->show();
			$data=$couponModel->where("susername='$susername'and busername is not null")->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign("coupon",$data);
			$this->assign('pages',$show);
			$this->display();
		}
		public function delete()
		{
			$id=I("id");
			$couponModel=M("coupontab");
			if($couponModel->where("id='$id'")->delete())
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
			$couponModel=M("coupontab");
			$id=I("id");
			if(is_array($id))
			{
				$getid=implode(',', $id);
			}else
			{
				$getid=$id;
			}
			$conditon['id']=array('in',$getid);
			if($couponModel->where($conditon)->delete())
			{
				$this->success("成功删除!",U("Admin/Coupon/allCoupon"));
			}else
			{
				$this->error('删除失败!');
			}
		}

	}
?>