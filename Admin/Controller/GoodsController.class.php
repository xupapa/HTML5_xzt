<?php
	namespace Admin\Controller;
	use Think\Controller;

	class GoodsController  extends Controller{
		public function __construct(){
			parent::__construct();
			if(!isLogin())
			{
				$this->error("请先登录",U("Admin/login"));
			}
		}
		public function allGoods()
		{
			$susername=$_SESSION['susername'];
			$sellerModel=M("sellertab");
			$sellerdata=$sellerModel->query("select sid from sellertab where susername='$susername'");
			$sid=$sellerdata[0]['sid'];

			$goodsModel=M("productstab");
			$count=$goodsModel->join('product_category on productstab.pcid=product_category.pcid')->where("productstab.sid=$sid")->count();
			$Page=new\Think\Page($count,5);
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$show=$Page->show();
			$list=$goodsModel->join('product_category on productstab.pcid=product_category.pcid')->where("productstab.sid=$sid")->order("pid")->page($_GET['p'].',5')->select();
			$this->assign('productstab',$list);
			$this->assign('pages',$show);
			//$data=$goodsModel->join('product_category on productstab.pcid=product_category.pcid')->where("productstab.sid=$sid")->order("pid")->select();
			//$this->assign('productstab',$data);

			$categoryModel=M("product_category");

			$pcdata=$categoryModel->where("sid=$sid")->select();
			$this->assign('product_category',$pcdata);
			$this->display();
		}
		public function goods_edit()
		{
			$susername=$_SESSION['susername'];
			$sellerModel=M("sellertab");
			$sellerdata=$sellerModel->query("select sid from sellertab where susername='$susername'");
			$sid=$sellerdata[0]['sid'];
			if(IS_POST)
			{
				$upload = new \Think\Upload();
				$upload->maxSize=3145728 ;
				$upload->exts=array('jpg', 'gif', 'png', 'jpeg');
				$upload->rootPath="./Public/upload/";
				$upload->saveName = '';
				$upload->replace=true;
				$upload->autoSub=false;
				$info=$upload->upload();
				$goodsModel=M("productstab");
				$data=$goodsModel->create();
				if($info!=false)
				{
					if($info['pimage']!=NULL)
					{
						$data['pimage']=$info['pimage']['savename'];
					}
					if($info['images']!=NULL)
					{
						$data['images']=$info['images']['savename'];
					}
					
				}
				
				
				$data['sid']=$sid;
				$data['publishtime']=date('Y-m-d h:i:s',time());
				$pid=I("pid");
				if($goodsModel->where("pid=$pid")->save($data))
				{
					
					$this->success("修改成功！",U("allGoods"));
				}
				else
				{
					$this->error('更新失败');
				}
			}
			else
			{
				$pid=I('id');
				$goodsModel=D("productstab");
				$data=$goodsModel->join('product_category on productstab.pcid=product_category.pcid')->find($pid);
				$this->assign('productstab',$data);

				$categoryModel=M("product_category");
				$pcdata=$categoryModel->where("sid=$sid")->select();
				$this->assign('product_category',$pcdata);
				$this->display();
			}
			
		}
		public function delete()
		{
			$pid=I('id');
			$goodsModel=D("productstab");
			if($goodsModel->where("pid=$pid")->delete())
			{
				$this->success("删除成功");
			}
			else
			{
				$this->error("删除失败");
			}

		}
		public function addGoods()
		{
			$susername=$_SESSION['susername'];
			$sellerModel=M("sellertab");
			$sellerdata=$sellerModel->query("select sid from sellertab where susername='$susername'");
			$sid=$sellerdata[0]['sid'];

			$categoryModel=M("product_category");
			$pcdata=$categoryModel->where("sid=$sid")->select();
			$this->assign('product_category',$pcdata);
			
			$this->display();

		}
		public function store()
		{
			$upload = new \Think\Upload();
			$upload->maxSize=3145728 ;
			$upload->exts=array('jpg', 'gif', 'png', 'jpeg');
			$upload->rootPath="./Public/upload/";
			$upload->saveName = '';
			$upload->replace=true;
			$upload->autoSub=false;
			$info=$upload->upload();
			if($info['pimage']==NULL)
			{
				$this->error("缩略图不得为空");
			}
			if($info['images']==NULL)
			{
				$this->error("高清图不得为空");
			}
			$susername=$_SESSION['susername'];
			$sellerModel=M("sellertab");
			$sellerdata=$sellerModel->query("select sid from sellertab where susername='$susername'");
			$sid=$sellerdata[0]['sid'];

			$goodsModel=M("productstab");
			$data=$goodsModel->create();
			$data['sid']=$sid;
			$data['publishtime']=date('Y-m-d h:i:s',time());
			$data['pimage']=$info['pimage']['savename'];
			$data['images']=$info['images']['savename'];
			if($goodsModel->add($data))
			{
				$this->success('数据添加成功',U("allGoods"));
			}
			else
			{
				$this->error('添加失败');
			}
			
		}
		public function destoryBatch()
		{
			$goodsModel=M("productstab");
			$pid=I("pid");
			if(is_array($pid))
			{
				$getpid=implode(',', $pid);
			}else
			{
				$getpid=$pid;
			}
			$conditon['pid']=array('in',$getpid);
			if($goodsModel->where($conditon)->delete())
			{
				$this->success("成功删除!",U("Admin/Goods/allGoods/p/1"));
			}else
			{
				$this->error('删除失败!');
			}
		}
		

	}
?>