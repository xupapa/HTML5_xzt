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
        $id=$shopModel->field('type')->select();
        // print_r($id);exit;
    	$data=$shopModel->limit(6)->select();
    	$da=$shoppingModel->select();
        // print_r($da);exit;
          // print_r($data);exit;
        foreach ($da as $key => $value) {
            $condition=array(
                'type'=>$data[$key]['type']
                );
            $proresult=$shopModel->where($condition)->select();
            // print_r($proresult);
            $da[$key]['good'][$key]=$proresult;
            // print_r($da);
        }
        // print_r($da);
        //  exit;
    	// $this->assign('shopping',$data);
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
    	// $data['time']=date("Y-m-d h:i:s");
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
    	// $data['time']=date("Y-m-d h:i:s");
    	// print_r($data);exit;
    	// $commentModel->add($data);
    	$data=$commentModel->where("rfid='$id'")->select();
    	$this->assign('recommendtab_share_comment',$data);
    	$this->display();
    }
    public function submit(){
        // $buyUserModel = M('buyertab');
        //     $wishModel = M('wishtab');
        //     // $buyUser = $buyUserModel->select();
        //     // $this->assign('buyertab',$buyUser);

        //     $time=date("Y-m-d");
        //     $where['time']=array('like',"$time%");
        //     $where['pcomment_time']=array('like',"$time%");
        //     // print_r($where);exit;
        //     $where1['user_time']=array('like',"$time%");
        //     $where2['buser_time']=array('like',"$time%");
        //     //var_dump($time);
        //     $chipModel=M('chips');
        //     $productModel=M('com_products');
        //     $resellModel=M('recommendtab_food_comment');
        //     $rebuyModel=M('recommendtab_share_comment');            

        //     //$var=$_SESSION['control'];
        //     //if($var == 0){
        //         $num=$buyUserModel->count();
        //         for ($i=1; $i <= $num; $i++) { 
        //             $chips=$chipModel->where("chips.bid=$i")->where($where)->count();
        //             $products=$productModel->where("com_products.bid=$i")->where($where)->count();
        //             $reseller=$resellModel->join("buyertab on buyertab.busername=recommendtab_food_comment.busername")->where("bid=$i")->where($where1)->count();
        //             $rebuyer=$rebuyModel->join("buyertab on buyertab.busername=recommendtab_share_comment.busernames")->where("bid=$i")->where($where2)->count();
        //             $count=$chips+$products+$reseller+$rebuyer;
        //             //var_dump($count);
        //             if($count <= 5){
        //                 $score=$buyUserModel->where("buyertab.bid=$i")->find(); 
        //                 $score['score'] += 2*$count;
        //                 //var_dump($score['score']);
        //                 $buyUserModel->save($score);
        //             }  
        //             if($count > 5){
        //                 $score=$buyUserModel->where("buyertab.bid=$i")->find(); 
        //                 $score['score'] += 10;
        //                 //var_dump($score['score']);
        //                 $buyUserModel->save($score);
        //             }               
        //         }
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
    $data['user_time']=date("Y-m-d ");
	$data['user_content']=$_POST['content'];
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
    $data['rfid']=$_POST['id'];//隐藏域
    $data['busernames']=$_SESSION['user']['busername'];
    // print_r($data['busername']);exit;
    $data['buser_time']=date("Y-m-d h:i");
	$data['buser_content']=$_POST['content'];
	$id=$data['rfid'];
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
    $data['wctime']=date("Y-m-d h:i:s");
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
    	$goodModel=M('com_products');
    	$sellerModel=M('sellertab');
    	$findFoodModel=M('recommendtab_food_comment');
    	$findFoodPModel=M('recommendtab_food');
    	$findShareModel=M('recommendtab_share_comment');
    	$bid=$_SESSION['user']['bid'];
    	// print_r($bid['bid']);exit;
    	$bid=$bid['bid'];
    	$sid=$goodModel->where("bid='$bid'")->field('sid')->select();
    	// print_r($sid[0]);exit;
    	foreach ($sid as $key => $value) {
    		$sid[$key]=$sid[$key]['sid'];
    	}
    	// print_r($sid);exit;
    	$goodName=$goodModel->where("bid='$bid'")->field('pname')->select();
    	 // print_r($goodName);exit;
    	$goodTitle=$goodModel->where("bid='$bid'")->field('pcomment_title')->select();
    	$goodContent=$goodModel->where("bid='$bid'")->field('pcomment_content')->select();
    	$goodTime=$goodModel->where("bid='$bid'")->field('pcomment_time')->select();
    	// $goodSusername=$Model->where("sid='$sid'")->field('susername')->select();
    	// print_r($goodName[0]);exit;
    	 // print_r($goodContent);exit;
    	foreach ($goodName as $key => $value) {
    		$goodName[$key]['pcomment_title']=$goodTitle[$key]['pcomment_title'];
    		$goodName[$key]['pcomment_content']=$goodContent[$key]['pcomment_content'];
    		$goodName[$key]['pcomment_time']=$goodTime[$key]['pcomment_time'];
    		// $goodName[$key]['sid']=$sid[$key]['sid'];
    	}
    	foreach ($goodName as $key => $value) {
    		if ($sellerModel->where("'$sid[$key]'=sid")->field('susername')->select()) {
    			$susername[$key]=$sellerModel->where("'$sid[$key]'=sid")->field('susername')->select();
    			
    		}    		
    	}
    	foreach ($susername as $key => $value) {
    		// $goodName[$key]['susername']=$susername[$key][$key]['susername'];
    		$susername[$key]=$susername[$key][0];
    	}

    	foreach ($susername as $key => $value) {
    		$goodName[$key]['susername']=$susername[$key]['susername'];
    	}
    	 // print_r($susername);exit;
    	// print_r($goodName);exit;
    	// 获取动态部分
    	$busername=$_SESSION['user']['busername'];
    	$rid=$findFoodModel->where("'$busername'=busername")->field('rid')->select();
        // print_r($rid);exit;
    	foreach ($rid as $key => $value) {
    		// $findFoodRid=$findFoodPModel->where("rid='$rid[$key]'")->field('rid')->select();
    		$rid[$key]=$rid[$key]['rid'];
    	}
    	// print_r($rid);exit;
    	foreach ($rid as $key => $value) {
    		$findFoodRid[$key]=$findFoodPModel->where("rid='$rid[$key]'")->field('rid')->select();
    	}
    	// print_r($findFoodRid);exit;
    	foreach ($rid as $key => $value) {
    		$findFoodRid[$key]=$findFoodRid[$key][0];
    		
    	}
    // print_r($findFoodRid);exit;

    	foreach ($findFoodRid as $key => $value) {
    		$findFoodRid[$key]=$findFoodRid[$key]['rid'];
    	}
    	// print_r($findFoodRid);exit;
    	foreach ($findFoodRid as $key => $value) {
    		$findFoodPTitle[$key]=$findFoodPModel->where("'$findFoodRid[$key]'=rid")->field('title')->select();
    	}
    	// print_r($findFoodPTitle);exit;
    	foreach ($findFoodPTitle as $key => $value) {
    		$findFoodPTitle[$key]=$findFoodPTitle[$key][0];
    	}
    	// print_r($findFoodPTitle);exit;
    	foreach ($findFoodRid as $key => $value) {
    		$findFoodPContent[$key]=$findFoodPModel->where("'$findFoodRid[$key]'=rid")->field('content')->select();
    	}
    	foreach ($findFoodPContent as $key => $value) {
    		$findFoodPContent[$key]=$findFoodPContent[$key][0];
    	}
    	// print_r($findFoodPContent);exit;
    	foreach ($rid as $key => $value) {
    		$findFoodPTime=$findFoodModel->where("'$busername'=busername")->field('user_time')->select();
    	}
    	 // print_r($findFoodPTime);exit;
    	foreach ($findFoodPTitle as $key => $value) {
    		$findFoodPTitle[$key]['user_time']=$findFoodPTime[$key]['user_time'];
    		$findFoodPTitle[$key]['content']=$findFoodPContent[$key]['content'];
    	}
    	$this->assign('good',$goodName);
    	$this->assign('find',$findFoodPTitle);
         // print_r($findFoodPTitle);exit;
    	$this->display();
    }
    
}