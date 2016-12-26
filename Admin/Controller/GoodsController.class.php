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
			if(IS_POST)
			{
				$pcid=$_POST['myselect'];
				$susername=$_SESSION['susername'];
				$sellerModel=M("sellertab");
				$sellerdata=$sellerModel->query("select sid from sellertab where susername='$susername'");
				$sid=$sellerdata[0]['sid'];
				$goodsModel=M("productstab");
				if($pcid=='全部')
				{
						//关键字查询
						$keys=I("post.keywords");				
						$keyword = str_replace(' ', '+', I('post.keywords'));
						//将keyword统一替换为‘+’连接，方便统一拆分             
						$str = array('!', '@', '#', '$', '%', '(', ')', '-', '=', '.', '/', '?'); 
						//定义搜索词不能包含的特殊符号，不包含“+”             
						foreach($str as $k){ 
						// 循环过滤特殊符号
							$strs = stristr($keyword, $k);
		                    if($strs != NULL){
		                    	$this->error('请输入有效的关键字');
		                    }
		                }
		                $keywords = array_values(array_filter(explode('+', $keyword))); //得到最终搜索词
		                foreach($keywords as $key){
		                	$where['pcname']=array('like',"%{$key}%");
						    $where['pname']=array('like',"%{$key}%");
						    $where['price']=array('like',"%{$key}%");
						    $where['publishtime']=array('like',"%{$key}%");
						    $where['pnum']=array('like',"%{$key}%");
						    $where['_logic']='OR';
		                }
		                $Page=new\Think\Page($count,5);
						$Page->setConfig('prev','上一页');
						$Page->setConfig('next','下一页');
						$show=$Page->show();		
						$map['_complex'] = $where;
						$map['productstab.sid']=$sid;	
						$list=$goodsModel->join('product_category on productstab.pcid=product_category.pcid')->where($map)->select();
						if(!$list){
							$this->error("未查到结果！");
						}
						$this->assign('productstab',$list);
						$this->assign('pages',$show);

				}
				else
				{
					//分类筛选
					$count=$goodsModel->join('product_category on productstab.pcid=product_category.pcid')->where("productstab.sid=$sid and productstab.pcid=$pcid")->count();
					$Page=new\Think\Page($count,5);
					$Page->setConfig('prev','上一页');
					$Page->setConfig('next','下一页');
					$show=$Page->show();
					$list=$goodsModel->join('product_category on productstab.pcid=product_category.pcid')->where("productstab.sid=$sid and productstab.pcid=$pcid")->order("pid")->limit($Page->firstRow.','.$Page->listRows)->select();
					$this->assign('productstab',$list);
					$this->assign('pages',$show);
				}
				
				$categoryModel=M("product_category");
				$pcdata=$categoryModel->where("sid=$sid")->select();
				$this->assign('product_category',$pcdata);
				$this->display();

			}
			else
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
			$list=$goodsModel->join('product_category on productstab.pcid=product_category.pcid')->where("productstab.sid=$sid")->order("pid")->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('productstab',$list);
			$this->assign('pages',$show);
			//$data=$goodsModel->join('product_category on productstab.pcid=product_category.pcid')->where("productstab.sid=$sid")->order("pid")->select();
			//$this->assign('productstab',$data);

			$categoryModel=M("product_category");

			$pcdata=$categoryModel->where("sid=$sid")->select();
			$this->assign('product_category',$pcdata);
			$this->display();
			}
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
		public function select()
		{
			$pcid=$_POST['myselect'];
			
		}
		

	}
?>