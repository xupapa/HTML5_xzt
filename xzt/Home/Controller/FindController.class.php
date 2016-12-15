<?php
namespace Home\Controller;
use Think\Controller;
class FindController extends Controller {
	// public function __construct()//每个控制器都需要验证
 //    {

 //    	parent::__construct();
 //    	if (!isLogin()) { 
 //    		$this->error("请登录",U("Home/Account/login"));
 //    	}
 //    }
    public function find_index(){
    	$newsModel=M("recommendtab_food");
    	$newModel=M("recommendtab_share");
    	$wishModel=M('wishtab');
    	$da=$newModel->limit(6)->select();
    	$data=$newsModel->limit(3)->select();
    	$wish=$wishModel->limit(3)->select();
    	$this->assign('recommendtab_food',$data);
    	$this->assign('recommendtab_share',$da);
    	$this->assign('wishtab',$wish);
        $this->display();
    }
    public function find_news(){
    	$shopModel=M('find_shoptab');
    	$shoppingModel=M('recommendtab_shop');
    	$data=$shopModel->limit(6)->select();
    	$da=$shoppingModel->select();
    	$this->assign('shopping',$data);
    	$this->assign('find_shop',$da);
    	$this->display();
    }
    public function fxcontent(){
    	//获取id
		$id=I('id');
		//获取数据
    	$recommendModel=M('recommendtab_food');
    	$data=$recommendModel->find($id);
    	//分配数据
    	$this->assign('recommendtab_food',$data);
    	$this->display();
    }
    public function fxcontent_life(){
    	//获取id
		$id=I('id');
		//获取数据
    	$recommendModel=M('recommendtab_share');
    	$data=$recommendModel->find($id);
    	//分配数据
    	$this->assign('recommendtab_share',$data);
    	$this->display();
    }
    public function fxcontent_shop(){
    	//获取id
		$id=I('id');
		//获取数据
    	$shopModel=M('find_shoptab');
    	$data=$shopModel->find($id);
    	//分配数据
    	$this->assign('find_shoptab',$data);
    	$this->display();
    }
    public function find_content(){
    	//获取id
		$id=I('id');
		//获取数据
		$wishCommentModel=M('wishtab_comment');
    	$wishModel=M('wishtab');
    	$data=$wishModel->find($id);
    	$comment=$wishCommentModel->where("wid='$id'")->select();
    	$data['busernames']=$_SESSION['user']['busername'];
    	//分配数据
        //print_r($data);exit;  
        $this->assign('session',$data);
    	$this->assign('wishtab',$data);
    	$this->assign('wishtab_comment',$comment);
    	$this->display();
    }
    public function fxlist(){
    
		//获取数据
    	$newsModel=M('recommendtab_food');
    	$data=$newsModel->select();
    	//分配数据
    	$this->assign('recommendtab_food',$data);	
    	$this->display();
    }
    public function fxlist_life(){
    	$lifeModel=M('recommendtab_share');
    	$data=$lifeModel->select();

    	$this->assign('recommendtab_share',$data);
    	$this->display();
    }
    public function find_list_wish(){
    	//获取数据
    	$wishModel=M('wishtab');
    	$data=$wishModel->select();
    	//分配数据
    	$this->assign('wishtab',$data);	
    	$this->display();
    }
    public function find_comment(){
    	$id=I('id');
    	$commentModel=M('recommendtab_food_comment');
    	// $data=$commentModel->find($id);

    	$data['rid']=$id;    	
    	// $data['time']=date("Y-m-d h:i:sa");
    	// print_r($data);exit;
    	// $commentModel->add($data);
    	$data=$commentModel->where("rid='$id'")->select();
    	$this->assign('recommendtab_food_comment',$data);
    	$this->display();
    }
    public function find_comment_life(){
    	$id=I('id');
    	$commentModel=M('recommendtab_share_comment');
    	// $data=$commentModel->find($id);

    	$data['rfid']=$id;    	
    	// $data['time']=date("Y-m-d h:i:sa");
    	// print_r($data);exit;
    	// $commentModel->add($data);
    	$data=$commentModel->where("rfid='$id'")->select();
    	$this->assign('recommendtab_share_comment',$data);
    	$this->display();
    }
    public function submit(){
    	// print_r($_SESSION['user']);exit;
    	if (!isLogin()) { 
    		$this->error("请登录",U("Home/Account/login"));
    	}
    //创建模型
    $commentModel=M('recommendtab_food_comment');
    //组织数据
    // $data=$commentModel->create();
   	// $data['rid']=I('id'); 
    $data['rid']=$_POST['id'];//隐藏域
    $data['busername']=$_SESSION['user']['busername'];
    // print_r($data['busername']);exit;
    $data['time']=date("Y-m-d h:i:sa");
	$data['content']=$_POST['content'];
	$id=$data['rid'];
    //$data['content']=I('post.content');  第二种方法
    //添加
		if ($commentModel->add($data)) {
			$this->success("添加成功",Home/Find/find_comment/id/$id );
		}
		else{
			$this->error("添加失败");
		}
    }
    public function submit_life(){
    //创建模型
    $commentModel=M('recommendtab_share_comment');
    //组织数据
    // $data=$commentModel->create();
   	// $data['rid']=I('id'); 
    $data['rid']=$_POST['id'];//隐藏域
    $data['busername']=$_SESSION['user']['busername'];
    // print_r($data['busername']);exit;
    $data['time']=date("Y-m-d h:i:sa");
	$data['content']=$_POST['content'];
	$id=$data['rid'];
    //$data['content']=I('post.content');  第二种方法
    //添加
		if ($commentModel->add($data)) {
			$this->success("添加成功",Home/Find/find_comment_life/id/$id );
		}
		else{
			$this->error("添加失败");
		}
    }
    public function wish(){
    	 //创建模型
    $wishCommentModel=M('wishtab_comment');
    //组织数据
    // $data=$commentModel->create();
   	// $data['rid']=I('id'); 
    $data['wid']=$_POST['id'];//隐藏域-1
    $data['wctime']=date("Y-m-d h:i:sa");
	$data['content']=$_POST['content'];
	$data['busernames']=$_POST['name'];//隐藏域-2
	$id=$data['rid'];
    //$data['content']=I('post.content');  第二种方法
    //添加
		if ($wishCommentModel->add($data)) {
			$this->success("添加成功",Home/Find/find_content/id/$id );
		}
		else{
			$this->error("添加失败");
		}
    }
    public function find_mycomment(){
    	// $Model=M('');
    	$this->display();
    }
    
}