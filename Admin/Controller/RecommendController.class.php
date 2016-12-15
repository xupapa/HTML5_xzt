<?php
	namespace Admin\Controller;
	use Think\Controller;

	class RecommendController extends Controller{
		public function __construct(){
			parent::__construct();
			if(!isLogin())
			{
				$this->error("请先登录",U("Admin/login"));
			}
		}
		public function allRecommend()
		{
			$susername=$_SESSION['susername'];
			$newsModel=M("recommendtab_food");
			$count=$newsModel->where("susername='$susername'")->count();
			$Page=new\Think\Page($count,5);
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$show=$Page->show();
			$list=$newsModel->where("susername='$susername'")->page($_GET['p'].',5')->select();
			$this->assign('recommendtab_food',$list);
			$this->assign('pages',$show);
			$this->display();

 		}
 		public function recommend_edit()
 		{
 			$susername=$_SESSION['susername'];
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
				$newsModel=M("recommendtab_food");
				$data=$newsModel->create();
				if($info!=false)
				{
					if($info['small']!=NULL)
					{
						$data['small']=$info['small']['savename'];
					}
					if($info['images']!=NULL)
					{
						$data['images']=$info['images']['savename'];
					}
					
				}
				$data['time']=date('Y-m-d h:i:s',time());
				$susername=$_SESSION['susername'];
				$data['susername']=$susername;
				$rid=I("rid");
				if($newsModel->where("rid='$rid'")->save($data))
				{
					$this->success("修改成功！",U("allRecommend"));
				}
				else
				{
					$this->error('更新失败');
				}

 			}
 			else
 			{
 				$rid=I("id");
				$newsModel=M("recommendtab_food");
				$data=$newsModel->where("rid='$rid'")->find();
				$this->assign("recommendtab_food",$data);
				$this->display();

 			}
 		}
		public function addRecommend()
		{
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
				if($info['small_img']==NULL)
				{
					$this->error("缩略图不得为空");
				}
				if($info['images']==NULL)
				{
					$this->error("高清图不得为空");
				}
				$newsModel=M("recommendtab_food");
				$data=$newsModel->create();
				$data['time']=date('Y-m-d h:i:s',time());
				$data['small_img']=$info['small']['savename'];
				$data['images']=$info['images']['savename'];

				$susername=$_SESSION['susername'];
				$data['susername']=$susername;
				if($newsModel->add($data))
				{
					$this->success('数据添加成功',U("allRecommend"));
				}
				else
				{
					$this->error('添加失败');
				}

			}	
			else
			{
				$this->display();
			}	
		}
		public function recomment_comment()
		{
			$newsCommentModel=M("recommendtab_food_comment");
			$susername=$_SESSION['susername'];
			$count=$newsCommentModel->join("recommendtab_food on recommendtab_food_comment.rid=recommendtab_food.rid")->where("recommendtab_food.susername='$susername'")->count();
			$Page=new\Think\Page($count,5);
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$show=$Page->show();
			$list=$newsCommentModel->join("recommendtab_food on recommendtab_food_comment.rid=recommendtab_food.rid")->where("recommendtab_food.susername='$susername'")->page($_GET['p'].',5')->select();
			$this->assign("news_comment",$list);
			$this->assign('pages',$show);
			$this->display();
			
		}
		public function delete()
		{
			$rid=I('id');
			$newsModel=M("recommendtab_food");
			if($newsModel->where("rid=$rid")->delete())
			{
				$this->success("删除成功");
			}
			else
			{
				$this->error("删除失败");
			}

		}
		public function view()
		{
			$rid=I("id");
			$newsModel=M("recommendtab_food");
			$data=$newsModel->where("rid='$rid'")->find();
			$this->assign("recommendtab_food",$data);
			$this->display();
		}
		public function comment_view()
		{
			$newsCommentModel=M("recommendtab_food_comment");
			$rfcid=I("id");
			$data=$newsCommentModel->join("recommendtab_food on recommendtab_food_comment.rid=recommendtab_food.rid")->where("rfcid='$rfcid'")->find();
			$this->assign("news_comment",$data);
			$this->display();
		}
		public function destoryBatch()
		{
			$newsModel=M("recommendtab_food");
			$rid=I("rid");
			if(is_array($rid))
			{
				$getrid=implode(',', $rid);
			}else
			{
				$getrid=$rid;
			}
			$conditon['rid']=array('in',$getrid);
			if($newsModel->where($conditon)->delete())
			{
				$this->success("成功删除!",U("Admin/Recommend/allRecommend/p/1"));
			}else
			{
				$this->error('删除失败!');
			}
		}
	}
	
?>