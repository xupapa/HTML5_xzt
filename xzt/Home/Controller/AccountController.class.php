<?php
namespace Home\Controller;
use Think\Controller;
session_start();
class AccountController extends Controller {
    public function login(){
    	if (IS_POST) {
            $Model = M('buyertab');
            $condition = array(
                    "busername" => I("post.username"),
                    "bpassword" => I("post.password"),
                    
                );           
            // $condition['bid']=$Model->where('$condition['busername']=busername')->select(bid); 
            $result = $Model->where($condition)->find();
            if ($result > 0) {
                $condition['bid']=$Model->field('bid')->find();
                $condition['score']=$Model->field('score')->find();
                $condition['sex']=$Model->field('sex')->find();
                $_SESSION['user']=$condition;
                 // print_r($_SESSION['user']);exit;           
                $this->success("登录成功！", U("Home/Index/index"));
            }
            else {
                $this->error("用户名或密码不正确");
            }
        }
        else {
            $this->display();   
        }
    }
    // 注册用户$length = strlen();
    public function registered(){   
        if(IS_POST){
            $userModel=M("buyertab");
            $data['busername']=I("post.username");
            $data['bpassword']=I("post.password");
            $data['sex']=I("docInlineRadio");
            $name=array(
                "busername" => I("post.username")
            );
            $d=$_POST['rpassword'];
            $a=$_POST['password'];
            if (strlen(I("post.username"))<5||strlen(I("post.username"))>16) {
                $this->error("用户名长度不符");
            }
            if ($userModel->where($name)->find()) {
                $this->error("用户名已被注册");
            }
            if (strlen(I("post.password"))<6||strlen(I("post.password"))>20) {
                $this->error("密码长度6~20位");
            }
            if ($d!=$a) {
                $this->error("两次密码不一致");
            }
            if($userModel->add($data)){
                $this->success("注册成功",U('Index/index'));
            }
            else{
                $this->error("注册失败");
            }
        }
        else {
            $this->display();   
        }

    }
    public function me(){
       
        $data['busername']=$_SESSION['user']['busername'];
        $data['bid']=$_SESSION['user']['bid'];
        $data['score']=$_SESSION['user']['score'];
        $data['sex']=$_SESSION['user']['sex'];
        //print_r($data);exit;  
        $this->assign('buyertab',$data);
        $this->display();
    }
    public function addSave_shop(){//添加店铺收藏
        $Model=M('collecttab');
        // $images=I('img');
        // print_r($images);exit;
        $recommendModel=M('recommendtab_food');
        $data['busername']=$_SESSION['user']['busername'];
        $data['susername']=I('susername');
        // print_r($data['susername']);exit;
        $susername=$data['susername'];
        $data['title']=I('title');
        $title=$data['title'];
        
        $data['time']=date("Y-m-d  h:i:sa");
        //查询发布时间
        $time=$recommendModel->where("susername='$susername' AND title='$title'")->field('time')->select();
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
        // print_r($result);exit;
        //存储发布时间到collecttab表
        $data['sendTime']=$time;
        $addSave=$recommendModel->where("susername='$susername' AND title='$title'")->select();
        // print_r($addSave);exit;
        //当前要收藏的动态发布时间
        // $sendTime=$recommendModel->where("susername='$susername' AND title='$title'")->field('time')->select();
        // print_r($sendTime);exit;
        $data['content']=$addSave[0]['content'];
        $data['type']="动态";
        if ($Model->add($data)) {
            $this->success("添加成功");
        }
        else{
            $this->error("添加失败");
        }

    }
       public function addSave_good(){//添加商品收藏
        $Model=M('collecttab');
        $recommendModel=M('recommendtab_share');
        // $data['busername']=$_SESSION['user']['busername'];
        $data['busername']=I('busername');
        //print_r($data['busername']);exit;
        $busername=$data['busername'];
        $data['title']=I('title');
        $title=$data['title'];
        $data['images']=I('images');
        $data['time']=date("Y-m-d  h:i:sa");
        //查询发布时间
        $time=$recommendModel->where("busername='$busername' AND title='$title'")->field('time')->select();
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
        // print_r($result);exit;
        //存储发布时间到collecttab表
        $data['sendTime']=$time;
        $addSave=$recommendModel->where("busername='$busername' AND title='$title'")->select();
         // print_r($addSave);exit;
        //当前要收藏的动态发布时间
        // $sendTime=$recommendModel->where("susername='$susername' AND title='$title'")->field('time')->select();
        // print_r($sendTime);exit;
        $data['content']=$addSave[0]['content'];
        $data['type']="商品";
        if ($Model->add($data)) {
            $this->success("添加成功");
        }
        else{
            $this->error("添加失败");
        }

    }
    public function mySave(){
        $mySaveModel=M('collecttab');
        $busername=$_SESSION['user']['busername'];
        $susername=$mySaveModel->where("busername='$busername' AND title='$title'")->field('susername')->select();
        $mySave_good=$mySaveModel->where("'$busername'=busername AND type='商品'")->select();
        $mySave_shop=$mySaveModel->where("'$busername'=busername AND type='动态'")->select();
          // print_r($mySave_shop);exit;
        //动态发布时间来确定图片
        foreach ($mySave_shop as $key => $value) {
            $sendTime[$key]['time']=$mySave_shop[$key][sendtime];
        }
        // print_r($sendTime[1]['time']);exit;
        foreach ($sendTime as $key => $value) {
            $sendTime[$key]=$sendTime[$key]['time'];
        }
        //print_r($sendTime);exit;
        //读取recommendtab_food的time(发布时间)
        $foodModel=M('recommendtab_food');
        foreach ($sendTime as $key => $value) {
            $time[$key]=$foodModel->where("'$sendTime[$key]'=time")->field('time')->select();
        }
        
         // print_r($time);exit;
        foreach ($time as $key => $value) {
            $time[$key]=$time[$key][0]['time'];
        }
         // print_r($time);exit;
        foreach ($time as $key => $value) {
            $images[$key]=$foodModel->where("'$time[$key]'=time")->field('images')->select();
            
        }   
         // print_r($images);exit;
        foreach ($images as $key => $value) {
             $images[$key]=$images[$key][0];
         } 
         // print_r($images);exit;
         // print_r($mySave_shop);exit;
        $this->assign('images',$images);
        $this->assign('collecttab_shop',$mySave_shop);
        $this->assign('collecttab_good',$mySave_good);       
        $this->display();
    }
    public function myHeart(){
        $heartModel=M('wishtab');
        $busername=$_SESSION['user']['busername'];
        $heart=$heartModel->where("'$busername'=busername")->select();
        $this->assign('wishtab',$heart);
        $this->display();
    }
    public function heartContent(){
        $id=I('id');
        $heartModel=M('wishtab');
        // $heart=$heartModel->where("wid='$id'")->select();
        $heart=$heartModel->find($id);
        // print_r($heart);exit;
        $this->assign('wishtab',$heart);
        $this->display();
    }
    public function submit_wish(){
        
        
            $Model=M('sellertab');
        $wishModel=M('wishtab');
        // $img=$_POST['img'];
        // print_r($img);exit;
        $shopname=I('post.shopname');
         //print_r($shopname);exit;
        $data['busername']=$_SESSION['user']['busername'];
        $da['susername']=$Model->where("shopname='$shopname'")->field('susername')->select();
        //print_r($da['susername'][0]['susername']);exit;
        $name=$da['susername'][0]['susername'];
        $data['susername']=$name;
        //print_r($data['susername']);exit;
        $data['wish_content']=I('post.content');
        $data['wish_title']=I('post.title');
        // $data['images']=I('images');

        $data['wtime']=date("Y-m-d h:i:sa");
        $data['wish_type']="未采纳";
        // $data['wid']=4;

           $upload = new \Think\Upload();
                $upload->maxSize=3145728 ;
                $upload->exts=array('jpg', 'gif', 'png', 'jpeg');
                $upload->rootPath="./Public/upload/";
                $upload->saveName = '';
                $upload->replace=true;
                $upload->autoSub=false;
                $info=$upload->upload();
                // print_r($info);exit;
                // $goodsModel=M("productstab");
                // $data=$goodsModel->create();
                if($info!=false)
                {
                    
                    $data['images']=$info['images']['savename'];
                    
                }
                 // print_r($data['images']);exit;
         // print_r($data);exit;
        if ($wishModel->add($data)) {
            $this->success('添加成功',U('Account/myHeart'));
        }
        else{
            // print_r($data);exit;
            $this->error('添加失败');
        }
    
        
       
}
    public function myYHQ(){
        $Model=M('');
        $this->display();
    }
}