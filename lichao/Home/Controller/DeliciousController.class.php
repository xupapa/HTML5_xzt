<?php
namespace Home\Controller;
use Think\Controller;
class DeliciousController extends Controller {
	// 小吃
   public function snacks(){
           $sliModel = M("sliders");
           $actModel = M("activity");
           $shopModel=M("sellertab");
           $condition = array(
                   "type_origin" => '美食',
                   "type_branch" => '小吃'
               );
           $data = array(
               "type_branch"=>'小吃'
           );

           $sliders=$sliModel->where($data)->select();
           $activity=$actModel->where($data)->select();
       	$shop= $shopModel->where($condition)->select();
           $this->assign("sliders",$sliders);
           $this->assign("activity",$activity);
   // print_r($activity);exit;
           $data['busername']=$_SESSION['user']['busername'];
           $this->assign('user',$data);


           $chipsModel=M("chips");
           $sid=$shopModel->where("type_branch='小吃'")->field('sid')->select();
           foreach ($sid as $key => $value) {
                $sid[$key]=$sid[$key]['sid'];
            }//sid的数组
           $count=$chipsModel->where("id")->field('clickcount')->select();
           $male=$chipsModel->where("id")->field('malenum')->select();
           $female=$chipsModel->where("id")->field('femalenum')->select();
           $length=$chipsModel->count();
           for($i=0;$i<$length;$i++)
           {
               $malenum[$i]=round($male[$i]['malenum']/$count[$i]['clickcount'],2)*100;
               $femalenum[$i]=round($female[$i]['femalenum']/$count[$i]['clickcount'],2)*100;
           }
           foreach($malenum as $key=>$val)
           {
               $data['malewidth']=$val;
               $data11=array(
                   "id"=>$key+1
                   );
               $chipsModel->where($data11)->field('malewidth')->save($data);
           }
           foreach($femalenum as $key=>$val)
           {
               $data['femalewidth']=$val;
               $data11=array(
                   "id"=>$key+1
                   );
               $chipsModel->where($data11)->field('femalewidth')->save($data);
           }
           $progress=$chipsModel->where("type_branch='小吃'")->order('clickcount+0 desc')->limit(0,2)->select();
           foreach($sid as $key => $value) {
               $chips[$key] = $chipsModel->where("sid='$value'")->field('chipname,clickcount,id,femalenum,malenum,malewidth,femalewidth')->order('clickcount+0 desc')->select();
           }//0店  0 1 2。。的标签

            foreach($chips as $key=>$value){
              foreach ($value as $k => $v) {
                  $data[$key][$k]=$v;
              }
             }
           foreach($shop as $key=>$val){
                $shop[$key]['chiptwo']=$data[$key];
            }
           $this->assign('sellertab', $shop);
       	$this->display();
       }
	// 甜品
     public function dessert(){
            $sliModel = M("sliders");
            $actModel = M("activity");
            $shopModel=M("sellertab");
            $condition = array(
                    "type_origin" => '美食',
                    "type_branch" => '甜品'
                );
            $data = array(
                "type_branch"=>'甜品'
            );

            $sliders=$sliModel->where($data)->select();
            $activity=$actModel->where($data)->select();
            $shop= $shopModel->where($condition)->select();
            $this->assign("sliders",$sliders);
            $this->assign("activity",$activity);

            $data['busername']=$_SESSION['user']['busername'];
            $this->assign('user',$data);


            $chipsModel=M("chips");
            $sid=$shopModel->where("type_branch='甜品'")->field('sid')->select();
            foreach ($sid as $key => $value) {
                 $sid[$key]=$sid[$key]['sid'];
             }//sid的数组
             $count=$chipsModel->where("id")->field('clickcount')->select();
            $male=$chipsModel->where("id")->field('malenum')->select();
            $female=$chipsModel->where("id")->field('femalenum')->select();
            $length=$chipsModel->count();
            for($i=0;$i<$length;$i++)
            {
                $malenum[$i]=round($male[$i]['malenum']/$count[$i]['clickcount'],2)*100;
                $femalenum[$i]=round($female[$i]['femalenum']/$count[$i]['clickcount'],2)*100;
            }
            foreach($malenum as $key=>$val)
            {
                $data['malewidth']=$val;
                $data11=array(
                    "id"=>$key+1
                    );
                $chipsModel->where($data11)->field('malewidth')->save($data);
            }
            foreach($femalenum as $key=>$val)
            {
                $data['femalewidth']=$val;
                $data11=array(
                    "id"=>$key+1
                    );
                $chipsModel->where($data11)->field('femalewidth')->save($data);
            }
            $progress=$chipsModel->where("type_branch='甜品'")->order('clickcount+0 desc')->limit(0,2)->select();
            foreach($sid as $key => $value) {
                $chips[$key] = $chipsModel->where("sid='$value'")->field('chipname,clickcount,id,femalenum,malenum,malewidth,femalewidth')->order('clickcount+0 desc')->select();
            }//0店  0 1 2。。的标签

             foreach($chips as $key=>$value){
               foreach ($value as $k => $v) {
                   $data[$key][$k]=$v;
               }
              }
            foreach($shop as $key=>$val){
                 $shop[$key]['chiptwo']=$data[$key];
             }
            $this->assign('sellertab', $shop);
            $this->display();
        }
    // 饮品
    public function drink(){
            $sliModel = M("sliders");
            $actModel = M("activity");
            $shopModel=M("sellertab");
            $condition = array(
                    "type_origin" => '美食',
                    "type_branch" => '饮品'
                );
            $data = array(
                "type_branch"=>'饮品'
            );

            $sliders=$sliModel->where($data)->select();
            $activity=$actModel->where($data)->select();
            $shop= $shopModel->where($condition)->select();
            $this->assign("sliders",$sliders);
            $this->assign("activity",$activity);

            $data['busername']=$_SESSION['user']['busername'];
            $this->assign('user',$data);


            $chipsModel=M("chips");
            $sid=$shopModel->where("type_branch='饮品'")->field('sid')->select();
            foreach ($sid as $key => $value) {
                 $sid[$key]=$sid[$key]['sid'];
             }//sid的数组
             $count=$chipsModel->where("id")->field('clickcount')->select();
            $male=$chipsModel->where("id")->field('malenum')->select();
            $female=$chipsModel->where("id")->field('femalenum')->select();
            $length=$chipsModel->count();
            for($i=0;$i<$length;$i++)
            {
                $malenum[$i]=round($male[$i]['malenum']/$count[$i]['clickcount'],2)*100;
                $femalenum[$i]=round($female[$i]['femalenum']/$count[$i]['clickcount'],2)*100;
            }
            foreach($malenum as $key=>$val)
            {
                $data['malewidth']=$val;
                $data11=array(
                    "id"=>$key+1
                    );
                $chipsModel->where($data11)->field('malewidth')->save($data);
            }
            foreach($femalenum as $key=>$val)
            {
                $data['femalewidth']=$val;
                $data11=array(
                    "id"=>$key+1
                    );
                $chipsModel->where($data11)->field('femalewidth')->save($data);
            }
            $progress=$chipsModel->where("type_branch='饮品'")->order('clickcount+0 desc')->limit(0,2)->select();
            foreach($sid as $key => $value) {
                $chips[$key] = $chipsModel->where("sid='$value'")->field('chipname,clickcount,id,femalenum,malenum,malewidth,femalewidth')->order('clickcount+0 desc')->select();
            }//0店  0 1 2。。的标签

             foreach($chips as $key=>$value){
               foreach ($value as $k => $v) {
                   $data[$key][$k]=$v;
               }
              }
            foreach($shop as $key=>$val){
                 $shop[$key]['chiptwo']=$data[$key];
             }
            $this->assign('sellertab', $shop);
            $this->display();
        }
    // 快餐
    public function fastfood(){
            $sliModel = M("sliders");
            $actModel = M("activity");
            $shopModel=M("sellertab");
            $condition = array(
                    "type_origin" => '美食',
                    "type_branch" => '快餐'
                );
            $data = array(
                "type_branch"=>'快餐'
            );

            $sliders=$sliModel->where($data)->select();
            $activity=$actModel->where($data)->select();
            $shop= $shopModel->where($condition)->select();
            $this->assign("sliders",$sliders);
            $this->assign("activity",$activity);

            $data['busername']=$_SESSION['user']['busername'];
            $this->assign('user',$data);


            $chipsModel=M("chips");
            $sid=$shopModel->where("type_branch='快餐'")->field('sid')->select();
            foreach ($sid as $key => $value) {
                 $sid[$key]=$sid[$key]['sid'];
             }//sid的数组
             $count=$chipsModel->where("id")->field('clickcount')->select();
            $male=$chipsModel->where("id")->field('malenum')->select();
            $female=$chipsModel->where("id")->field('femalenum')->select();
            $length=$chipsModel->count();
            for($i=0;$i<$length;$i++)
            {
                $malenum[$i]=round($male[$i]['malenum']/$count[$i]['clickcount'],2)*100;
                $femalenum[$i]=round($female[$i]['femalenum']/$count[$i]['clickcount'],2)*100;
            }
            foreach($malenum as $key=>$val)
            {
                $data['malewidth']=$val;
                $data11=array(
                    "id"=>$key+1
                    );
                $chipsModel->where($data11)->field('malewidth')->save($data);
            }
            foreach($femalenum as $key=>$val)
            {
                $data['femalewidth']=$val;
                $data11=array(
                    "id"=>$key+1
                    );
                $chipsModel->where($data11)->field('femalewidth')->save($data);
            }
            $progress=$chipsModel->where("type_branch='快餐'")->order('clickcount+0 desc')->limit(0,2)->select();
            foreach($sid as $key => $value) {
                $chips[$key] = $chipsModel->where("sid='$value'")->field('chipname,clickcount,id,femalenum,malenum,malewidth,femalewidth')->order('clickcount+0 desc')->select();
            }//0店  0 1 2。。的标签

             foreach($chips as $key=>$value){
               foreach ($value as $k => $v) {
                   $data[$key][$k]=$v;
               }
              }
            foreach($shop as $key=>$val){
                 $shop[$key]['chiptwo']=$data[$key];
             }
            $this->assign('sellertab', $shop);
            $this->display();
        }
    // 进入店铺的动态获取显示storelist
    public function storelist(){
        	$sid=$_GET['id'];//sid
            $sellModel=M("sellertab");//获取店名和图片，就这两个
            $model = M("productstab");//所有的产品
            $cateModel = M("product_category");//得到店铺有几个分类
            $data = array(
                "sid"=>$sid//sid
            );
            $seller=$sellModel->where($data)->select();
            $catesult=$cateModel->where($data)->select();//食品的分类

            // 实现双循环输出产品过程
            foreach ($catesult as $key => $value) {
                $condition=array(
                    "pcid"=>$catesult[$key]['pcid']
                );
                $prosult=$model->where($condition)->select();
                $catesult[$key]['products']=$prosult;
            }
            // print_r($catesult);exit;
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
           $sellerModel=M('sellertab');
           $user=$sellerModel->where("sid=$idd")->select();
           $this->assign("user",$user);

           $prosult=$model->where($data)->select();
           $pname=$model->where($data)->field('pname')->select();
           $this->assign("productstab",$prosult);
            //print_r($user);exit;
           // 评论部分的输出
           $data1=array(
               "sid"=>$idd,
               "pname"=>$pname[0]['pname']
           );
           $comModel=M("com_products");
           $reasult=$comModel->join('buyertab on com_products.bid=buyertab.bid')->where($data1)->order('pcomment_time desc')->select();
           $this->assign("reasult",$reasult);
            // print_r($reasult);exit;
           // 小标签
           $data['busername']=$_SESSION['user']['busername'];
           $branchModel=M('sellertab');
           $branch=$branchModel->where("sid=$idd")->field('type_branch')->select();
           $branch1=$branch[0]['type_branch'];
           $chipsModel=M('chips');
           $data=array(
               "type_branch"=>$branch1
               );
           $chips=$chipsModel->where($data)->order('clickcount desc')->limit(0,4)->select();
           $this->assign("chips",$chips);
           //print_r($chips);exit;
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

 public function addSave_good(){//添加商品收藏
        // if (!isLogin()) {
        //     $this->error("请登录",U("Home/Account/login"));
        // }
        $id=I('get.id');
        $data['sid']=I('post.sids');
        $data['title']=I('post.title');
        $data['images']=I('post.images');
        $data['susername']=I('post.susername');
        $data['busername']=$_SESSION['user']['busername'];
        $data['time']=date("Y-m-d  h:i:s");

        $Model=M('collecttab');
        $productModel=M('productstab');
        $content=$productModel->where("pid=$id")->select();
        $data['content']=$content[0]['introduce'];
        $data['sid']=$content[0]['sid'];
        $data['type']="商品";

        //查询发布时间
        $time=$Model->where("busername='$busername' AND title='$title'")->field('time')->select();
        $time=$time[0][time];

         // print_r($time);exit;
        $result=$Model->field('sendTime')->select();
        // $result=$result[0];

        foreach ($result as $key => $value) {
            // print_r($result[$key][sendtime]);
            $newtime['time']=$result[$key][sendtime];
            // print_r($newtime);
            if ($newtime['time']==$time) {
                // $this->error("请勿重复收藏");
                $this->error('请勿重复收藏','',1);
            }
        }
        if ($Model->add($data)) {
            $this->success("添加成功");
        }
        else{
            $this->error("添加失败");
        }

    }

    public function submit(){
            // print_r($_SESSION['user']);exit;
            $pid=$_GET['id'];//能获取当前的产品的id
            if (!isLogin()) {
                $this->error("请登录",U("Home/Login/login"));
            }
            if ($_POST['comment']=="") {
                $this->error("发表内容不许为空");
            }else{
                 //创建模型
            $proModel=M('productstab');
            $data=array(
                "pid"=>$pid
            );
            $pn=$proModel->where($data)->field('pname')->select();
            $pname=$pn[0]['pname'];//找到pname

            $sun=$proModel->where($data)->field('sid')->select();
            $sid=$sun[0]['sid'];//找到sid
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