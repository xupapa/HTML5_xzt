<?php
namespace Home\Controller;
use Think\Controller;
class DeliciousController extends Controller {
	// 小吃
    public function snacks(){
        $sliModel = M("sliders");
    	$model = M("sellertab");
        $actModel = M("activity");
        $condition = array(
                "type_origin" => '美食',
                "type_branch" => '小吃'
            );
        $data = array(
            "type_branch"=>'小吃'
        );
        $sliders=$sliModel->where($data)->select();
        $activity=$actModel->where($data)->select();
    	$seller = $model->where($condition)->select();
        $this->assign("sliders",$sliders);
    	$this->assign("sellertab", $seller);
        $this->assign("activity",$activity);
// 小徽章
        $data['busername']=$_SESSION['user']['busername'];
        //print_r($data);exit;
        $this->assign('user',$data);


        $chipsModel = M("chips");
        $condition = array(
                "type_branch" => '小吃'
            );
        $chips = $chipsModel->where($condition)->select();
        $this->assign('chips', $chips);


    	$this->display();
    }
	// 甜品
    public function dessert(){
        $sliModel = M("sliders");
    	$model = M("sellertab");
        $actModel = M("activity");
        $condition = array(
                "type_origin" => '美食',
                "type_branch" => '甜品'
            );
         $data = array(
            "type_branch"=>'甜品'
        );
    	$seller = $model->where($condition)->select();
        $sliders=$sliModel->where($data)->select();
        $activity=$actModel->where($data)->select();
    	$this->assign("sellertab", $seller);
        $this->assign("sliders",$sliders);
        $this->assign("activity",$activity);
    	$this->display();
    }
    // 饮品
    public function drink(){
        $sliModel = M("sliders");
    	$model = M("sellertab");
        $actModel = M("activity");
        $condition = array(
                "type_origin" => '美食',
                "type_branch" => '饮品'
            );
        $data = array(
            "type_branch"=>'饮品'
        );
    	$seller = $model->where($condition)->select();
        $sliders=$sliModel->where($data)->select();
        $activity=$actModel->where($data)->select();
    	$this->assign("sellertab", $seller);
        $this->assign("sliders",$sliders);
        $this->assign("activity",$activity);
    	$this->display();
    }
    // 快餐
    public function fastfood(){
        $sliModel = M("sliders");
    	$model = M("sellertab");
        $actModel = M("activity");
        $condition = array(
                "type_origin" => '美食',
                "type_branch" => '快餐'
            );
        $data = array(
            "type_branch"=>'快餐'
        );
    	$seller = $model->where($condition)->select();
        $sliders=$sliModel->where($data)->select();
        $activity=$actModel->where($data)->select();
    	$this->assign("sellertab", $seller);
        $this->assign("sliders",$sliders);
        $this->assign("activity",$activity); 
    	$this->display();
    }
    // 进入店铺的动态获取显示storelist
    public function storelist(){
    	$susername=$_GET['id'];//马步鱼4号店
        $sellModel=M("sellertab");//获取店名和图片，就这两个
        $model = M("productstab");
        $cateModel = M("category");
        $data = array(
            "susername"=>$susername//动态店名马步鱼4号店
        );
        $seller=$sellModel->where($data)->select();
        $catesult=$cateModel->where($data)->select();//食品的分类
        $prosult=$model->where($data)->limit(0,3)->select();
        $this->assign("seller",$seller);
        $this->assign("category",$catesult);
        $this->assign("productstab",$prosult);
        $this->display();
    }
    // 一个产品的详情
    public function shop_comment(){
        $pid=$_GET['id'];//产品的pid
        $idd=$_GET['idd'];//商家sid
        $model = M("productstab");
        $data = array(
            "pid"=>$pid
        );
        $prosult=$model->where($data)->select();
        $pname=$model->where($data)->field('pname')->select();
        $this->assign("productstab",$prosult);
        // 评论部分的输出 
        $data1=array(
            "sid"=>$idd,
            "pname"=>$pname[0]['pname']
        );
        $comModel=M("com_products");
        $reasult=$comModel->join('buyertab on com_products.bid=buyertab.bid')->join('imagetab on buyertab.blevel=imagetab.blevel')->where($data1)->order('pcomment_time desc')->select();
        $this->assign("reasult",$reasult);
        $this->display();
    }
    // 小徽章的方法
      public function set_hits(){
        $data['id']=isset($_POST['id'])?intval(trim($_POST['id'])):0;
        $obj = M("chips");
 
        $data['sex']=$_SESSION['user']['sex'];
        //print_r($data['sex']);exit;
        if($data['sex']['sex']=='男'){
            //print_r('吃饭');exit;
            $obj->where($data)->setInc('malenum');
        }
        if($data['sex']['sex']=='女'){
            $obj->where($data)->setInc('femalenum');
        }

        if(!isset($_COOKIE[$_POST['id']+10000])&&$obj->where($data)->setInc('clickcount')){
            $cookiename = $_POST['id']+10000;
            setcookie($cookiename,40,time()+60,'/'); 
 
            $data['info'] = "ok";
            $data['status'] = 1;
            $this->ajaxReturn($data);
            exit();
        }else{
            $data['info'] = "fail";
            $data['status'] = 0;
            $this->ajaxReturn($data);
            exit();
        }
        
    }



    public function submit(){
        // print_r($_SESSION['user']);exit;
        $pid=$_GET['id'];//能获取当前的产品的id
        if (!isLogin()) { 
            $this->error("请登录",U("Home/Login/login"));
        }
        //创建模型
        $proModel=M('productstab');
        $data=array(
            "pid"=>$pid
        );
        $pn=$proModel->where($data)->field('pname')->select();//找到pname
        $pname=$pn[0]['pname'];

        $sun=$proModel->where($data)->field('susername')->select();//找到susername
        $susername=$sun[0]['susername'];
        //有susername在sellertab表中找sids
        $sellerModel=M('sellertab');
        $data2=array(
            "susername"=>$susername
        );
        $ssid=$sellerModel->where($data2)->field('sid')->select();
        $sid=$ssid[0]['sid'];
        //向表里存储
        $commentModel=M('com_products');
        $data['bid']=$_SESSION['user']['bid']['bid'];
        $data['pcomment_time']=date("Y-m-d h:i:s");
        $data['pcomment_content']=$_POST['comment'];
        $data['sid']=$sid;
        $data['pname']=$pname;

        //添加
        if ($commentModel->add($data)) {
            $this->success("发表成功",Home/Delicious/shop_comment/id/$id );
        }
        else{
            $this->error("发表失败");
        }
    }
    // 心愿页面的输出
    public function comment(){
        // 知道店名
        $shopname=$_GET['id'];
        $data=array(
            "shopname"=>$shopname
        );
        $proModel=M('productstab');
        $prosult=$proModel->where($data)->select();
        $this->assign("prosult",$prosult);
        //print_r($prosult);exit;
        $this->display();
    }
    // 心愿的提交
    public function wish(){
        if (!isLogin()) { 
            $this->error("请登录",U("Home/Login/login"));
        }
        $wishModel=M('wishtab');
        // 知道了susername
        $su=$_GET['id'];
        $data['busername']=$_SESSION['user']['busername'];
        $data['susername']=$su;
        $data['wish_title']=I('post.title');
        $data['wish_content']=I('post.content');
        $data['wtime']=date("Y-m-d h:i:s");
        $data['wish_type']="未采纳";
        if (IS_POST) {
           $upload = new \Think\Upload();
            $upload->maxSize=3145728 ;
            $upload->exts=array('jpg', 'gif', 'png', 'jpeg');
            $upload->rootPath="./Public/upload/";
            $upload->saveName = '';
            $upload->replace=true;
            $upload->autoSub=false;
            $info=$upload->upload();
           if($info!=false){
                $data['images']=$info['images']['savename'];     
            }
        }
        if ($wishModel->add($data)) {
            $this->success('添加成功',U("Home/Delicious/storelist/id/$su"));
        }
        else{
            $this->error('添加失败'); 
        }
    }
    

    public function choose(){
        $this->display();
    }
 
}