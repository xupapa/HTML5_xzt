<?php
	namespace Admin\Controller;
	use Think\Controller;

	class CouponController extends Controller{
		public function __construct(){
			parent::__construct();
			if(!isLogin())
			{
				$url=U("Admin/Admin/login");
           		echo "<script> alert('请先登录！');parent.location.href='$url'; </script>";
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
					$data=$couponModel->create();

					if($data['coupon_num']==null)
					{
						echo <<<STR
			                <script>
			                alert("请输入编号");
			                window.history.go(-1);
			                </script>
STR;
					}
					else if($data['price']==null)
					{
						echo <<<STR
			                <script>
			                alert("请输入使用条件");
			                window.history.go(-1);
			                </script>
STR;
					}
					else if($data['subtraction']==null)
					{
						echo <<<STR
			                <script>
			                alert("请输入减少金额");
			                window.history.go(-1);
			                </script>
STR;
					}
					else if($data['start_time']==null)
					{
						echo <<<STR
			                <script>
			                alert("请输入开始时间");
			                window.history.go(-1);
			                </script>
STR;
					}
					else if($data['end_time']==null)
					{
						echo <<<STR
			                <script>
			                alert("请输入终止时间");
			                window.history.go(-1);
			                </script>
STR;
					}
					else if($data['num']==null)
					{
						echo <<<STR
			                <script>
			                alert("请输入优惠券数量");
			                window.history.go(-1);
			                </script>
STR;
					}
					else{
						if($couponModel->where("id='$id'")->save())
						{
							$url=U("allCoupon");
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
				
				if($data['coupon_num']==null)
					{
						echo <<<STR
			                <script>
			                alert("请输入编号");
			                window.history.go(-1);
			                </script>
STR;
					}
					else if($data['price']==null)
					{
						echo <<<STR
			                <script>
			                alert("请输入使用条件");
			                window.history.go(-1);
			                </script>
STR;
					}
					else if($data['subtraction']==null)
					{
						echo <<<STR
			                <script>
			                alert("请输入减少金额");
			                window.history.go(-1);
			                </script>
STR;
					}
					else if($data['start_time']==null)
					{
						echo <<<STR
			                <script>
			                alert("请输入开始时间");
			                window.history.go(-1);
			                </script>
STR;
					}
					else if($data['end_time']==null)
					{
						echo <<<STR
			                <script>
			                alert("请输入终止时间");
			                window.history.go(-1);
			                </script>
STR;
					}
					else if($data['num']==null)
					{
						echo <<<STR
			                <script>
			                alert("请输入优惠券数量");
			                window.history.go(-1);
			                </script>
STR;
					}
				else
				{
					$data['susername']=$susername;
					if($couponModel->add($data))
					{
						$url=U("allCoupon");
	           			echo "<script> alert('添加成功！');parent.location.href='$url'; </script>";
						
					}
					else
					{
						echo <<<STR
			                <script>
			                alert("添加失败！");
			                window.history.go(-1);
			                </script>
STR;
					}
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
				$url=U("allCoupon");
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
				$url=U("allCoupon");
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

	}
?>