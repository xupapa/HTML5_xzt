<?php
	namespace Admin\Controller;
	use Think\Controller;

	class GoodsController  extends Controller{
		public function __construct(){
			parent::__construct();
			if(!isLogin())
			{
				$url=U("Admin/Admin/login");
           		echo "<script> alert('请先登录！');parent.location.href='$url'; </script>";
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
			if($data['pname']==NULL)
			{
				echo <<<STR
			                <script>
			                alert("商品名称不得为空");
			                window.history.go(-1);
			                </script>
STR;
			}
			else if($data['pcid']==NULL)
			{
				echo <<<STR
			                <script>
			                alert("请选择商品分类");
			                window.history.go(-1);
			                </script>
STR;
			}
			else if($data['price']==NULL)
			{
				echo <<<STR
			                <script>
			                alert("请输入价格");
			                window.history.go(-1);
			                </script>
STR;
			}
			else if($data['pnum']==NULL)
			{
				echo <<<STR
			                <script>
			                alert("请输入商品数量");
			                window.history.go(-1);
			                </script>
STR;
			}
			else if($data['pintroduce']==NULL)
			{
				echo <<<STR
			                <script>
			                alert("请输入商品简介");
			                window.history.go(-1);
			                </script>
STR;
			}
			else if($data['introduce']==NUll)
			{
				echo <<<STR
			                <script>
			                alert("请输入商品介绍");
			                window.history.go(-1);
			                </script>
STR;
			}
			else
			{
				$data['sid']=$sid;
				$data['publishtime']=date('Y-m-d h:i:s',time());
				$pid=I("pid");
				if($goodsModel->where("pid=$pid")->save($data))
				{
					
					$url=U("allGoods");
	           		echo "<script> alert('修改成功！');parent.location.href='$url'; </script>";
				}
				else
				{
					echo <<<STR
			                <script>
			                alert("更新失败！");
			                window.history.go(-1);
			                </script>
STR;
				}
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
				$url=U("allGoods");
	           	echo "<script> alert('删除成功！');parent.location.href='$url'; </script>";
				//$this->success("删除成功");
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
			$susername=$_SESSION['susername'];
			$sellerModel=M("sellertab");
			$sellerdata=$sellerModel->query("select sid from sellertab where susername='$susername'");
			$sid=$sellerdata[0]['sid'];
			$goodsModel=M("productstab");
			$data=$goodsModel->create();

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
				echo <<<STR
			                <script>
			                alert("缩略图不得为空");
			                window.history.go(-1);
			                </script>
STR;
			}
			else if($info['images']==NULL)
			{
				echo <<<STR
			                <script>
			                alert("高清图不得为空");
			                window.history.go(-1);
			                </script>
STR;
			}
			
			else if($data['pname']==NULL)
			{
				echo <<<STR
			                <script>
			                alert("商品名称不得为空");
			                window.history.go(-1);
			                </script>
STR;
			}
			else if($data['pcid']==NULL)
			{
				echo <<<STR
			                <script>
			                alert("请选择商品分类");
			                window.history.go(-1);
			                </script>
STR;
			}
			else if($data['price']==NULL)
			{
				echo <<<STR
			                <script>
			                alert("请输入价格");
			                window.history.go(-1);
			                </script>
STR;
			}
			else if($data['pnum']==NULL)
			{
				echo <<<STR
			                <script>
			                alert("请输入商品数量");
			                window.history.go(-1);
			                </script>
STR;
			}
			else if($data['pintroduce']==NULL)
			{
				echo <<<STR
			                <script>
			                alert("请输入商品简介");
			                window.history.go(-1);
			                </script>
STR;
			}
			else if($data['introduce']==NUll)
			{
				echo <<<STR
			                <script>
			                alert("请输入商品介绍");
			                window.history.go(-1);
			                </script>
STR;
			}

			else
			{
				$data['sid']=$sid;
				$data['publishtime']=date('Y-m-d h:i:s',time());
				$data['pimage']=$info['pimage']['savename'];
				$data['images']=$info['images']['savename'];
				if($goodsModel->add($data))
				{
					$url=U("allGoods");
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
				$url=U("allGoods");
	           	echo "<script> alert('删除成功！');parent.location.href='$url'; </script>";
			}else
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
?>