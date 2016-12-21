<?php
namespace Home\Controller;
use Think\Controller;
class AmusementController extends Controller {
    public function yl_movie(){
        $shopModel=M("sellertab");
        $shop = $shopModel->where("type_branch='电影'")->select();
	//幻灯片
		$slidersModel = D("sliders");
        $condition = array(
        		"type" => 'sliders',
        		"type_origin" => '娱乐',
        		"type_branch" => '电影'
        	);
        
		$sliders = $slidersModel->where($condition)->select();
		$this->assign('sliders', $sliders);
    //活动
        $activitiesModel = D("activity");
        //$condition = "type_branch='电影'";
        $activities = $activitiesModel->where( "type_branch='电影'")->select();
        $this->assign('activities', $activities);

        /*$chipsModel = D("chips");
        $chips = $chipsModel -> join('sellertab on chips.sid = sellertab.sid') -> where("")->select();

        $this ->assign("chips",$chips);*/

    //验证登陆 
        $data['busername']=$_SESSION['user']['busername'];
        //print_r($data);exit;
        $this->assign('user',$data);
        //print_r($chipname1[0]['chipname']);exit;
        //$this->assign('progress', $progress);
        
    //标签
	    $chipsModel = D("chips");
        $sid=$shopModel->where("type_branch='电影'")->field('sid')->select();
        
        foreach ($sid as $key => $value) {
             $sid[$key]=$sid[$key]['sid'];
             // $chips[$key] = $chipsModel->where("sid='$value'")->select();
         }
        $count=$chipsModel->where("id")->field('clickcount')->select();
        $male=$chipsModel->where("id")->field('malenum')->select();
        $female=$chipsModel->where("id")->field('femalenum')->select();
        $length=$chipsModel->count();
        for($i=0;$i<$length;$i++)
        {
            $malenum[$i]=round($male[$i]['malenum']/$count[$i]['clickcount'],2)*100;
            $femalenum[$i]=round($female[$i]['femalenum']/$count[$i]['clickcount'],2)*100;
            //$data['malewidth']=$malenum[$i];
        }
         foreach($malenum as $key=>$val)
        {
           //print($key);
            $data['malewidth']=$val;
            //print_r($data['malewidth']);
            $data11=array(
                "id"=>$key+1
                );
            $chipsModel->where($data11)->field('malewidth')->save($data);
        }
        foreach($femalenum as $key=>$val)
        {
            $data['femalewidth']=$val;
            //print_r($data['femalewidth']);
            $data11=array(
                "id"=>$key+1
                );
            $chipsModel->where($data11)->field('femalewidth')->save($data);
        }
     //进度条  
        $progress=$chipsModel->where("type_branch='电影'")->order('clickcount desc')->limit(0,2)->select();
        foreach($sid as $key => $value) {
            $chips[$key] = $chipsModel->where("sid='$value'")->field('chipname,clickcount,id,femalenum,malenum,malewidth,femalewidth')->order('clickcount+0 desc')->select();
        }
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
    
    public function yl_moviestore(){
        $id=I('id');
        $sellersModel=M("sellertab");
        $store=$sellersModel->find($id);
        //$shopcontent=$shoptabModel->where("shop_id='$id'")->find();
        $this->assign('sellertab', $store);
        $this->display();
    }
     public function yl_games(){
         $shopModel=M("sellertab");
        $shop = $shopModel->where("type_branch='游戏'")->select();
    //幻灯片
        $slidersModel = D("sliders");
        $condition = array(
                "type" => 'sliders',
                "type_origin" => '娱乐',
                "type_branch" => '游戏'
            );
        
        $sliders = $slidersModel->where($condition)->select();
        $this->assign('sliders', $sliders);
    //活动
        $activitiesModel = D("activity");
        //$condition = "type_branch='游戏'";
        $activities = $activitiesModel->where( "type_branch='游戏'")->select();
        $this->assign('activities', $activities);

        /*$chipsModel = D("chips");
        $chips = $chipsModel -> join('sellertab on chips.sid = sellertab.sid') -> where("")->select();

        $this ->assign("chips",$chips);*/

    //验证登陆 
        $data['busername']=$_SESSION['user']['busername'];
        //print_r($data);exit;
        $this->assign('user',$data);
        //print_r($chipname1[0]['chipname']);exit;
        //$this->assign('progress', $progress);
        
    //标签
        $chipsModel = D("chips");
        $sid=$shopModel->where("type_branch='游戏'")->field('sid')->select();
        
        foreach ($sid as $key => $value) {
             $sid[$key]=$sid[$key]['sid'];
             // $chips[$key] = $chipsModel->where("sid='$value'")->select();
         }
        $count=$chipsModel->where("id")->field('clickcount')->select();
        $male=$chipsModel->where("id")->field('malenum')->select();
        $female=$chipsModel->where("id")->field('femalenum')->select();
        $length=$chipsModel->count();
        for($i=0;$i<$length;$i++)
        {
            $malenum[$i]=round($male[$i]['malenum']/$count[$i]['clickcount'],2)*100;
            $femalenum[$i]=round($female[$i]['femalenum']/$count[$i]['clickcount'],2)*100;
            //$data['malewidth']=$malenum[$i];
        }
         foreach($malenum as $key=>$val)
        {
           //print($key);
            $data['malewidth']=$val;
            //print_r($data['malewidth']);
            $data11=array(
                "id"=>$key+1
                );
            $chipsModel->where($data11)->field('malewidth')->save($data);
        }
        foreach($femalenum as $key=>$val)
        {
            $data['femalewidth']=$val;
            //print_r($data['femalewidth']);
            $data11=array(
                "id"=>$key+1
                );
            $chipsModel->where($data11)->field('femalewidth')->save($data);
        }
     //进度条  
        $progress=$chipsModel->where("type_branch='游戏'")->order('clickcount desc')->limit(0,2)->select();
        foreach($sid as $key => $value) {
            $chips[$key] = $chipsModel->where("sid='$value'")->field('chipname,clickcount,id,femalenum,malenum,malewidth,femalewidth')->order('clickcount desc')->select();
        }
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
    public function yl_gamestore(){
        $id=I('id');
        $sellersModel=M("sellertab");
        $store=$sellersModel->find($id);
        //$shopcontent=$shoptabModel->where("shop_id='$id'")->find();
        $this->assign('sellertab', $store);
        $this->display();
    }
     public function yl_sports(){
         $shopModel=M("sellertab");
        $shop = $shopModel->where("type_branch='运动'")->select();
    //幻灯片
        $slidersModel = D("sliders");
        $condition = array(
                "type" => 'sliders',
                "type_origin" => '娱乐',
                "type_branch" => '运动'
            );
        
        $sliders = $slidersModel->where($condition)->select();
        $this->assign('sliders', $sliders);
    //活动
        $activitiesModel = D("activity");
        //$condition = "type_branch='运动'";
        $activities = $activitiesModel->where( "type_branch='运动'")->select();
        $this->assign('activities', $activities);

        /*$chipsModel = D("chips");
        $chips = $chipsModel -> join('sellertab on chips.sid = sellertab.sid') -> where("")->select();

        $this ->assign("chips",$chips);*/

    //验证登陆 
        $data['busername']=$_SESSION['user']['busername'];
        //print_r($data);exit;
        $this->assign('user',$data);
        //print_r($chipname1[0]['chipname']);exit;
        //$this->assign('progress', $progress);
        
    //标签
        $chipsModel = D("chips");
        $sid=$shopModel->where("type_branch='运动'")->field('sid')->select();
        
        foreach ($sid as $key => $value) {
             $sid[$key]=$sid[$key]['sid'];
             // $chips[$key] = $chipsModel->where("sid='$value'")->select();
         }
        $count=$chipsModel->where("id")->field('clickcount')->select();
        $male=$chipsModel->where("id")->field('malenum')->select();
        $female=$chipsModel->where("id")->field('femalenum')->select();
        $length=$chipsModel->count();
        for($i=0;$i<$length;$i++)
        {
            $malenum[$i]=round($male[$i]['malenum']/$count[$i]['clickcount'],2)*100;
            $femalenum[$i]=round($female[$i]['femalenum']/$count[$i]['clickcount'],2)*100;
            //$data['malewidth']=$malenum[$i];
        }
         foreach($malenum as $key=>$val)
        {
           //print($key);
            $data['malewidth']=$val;
            //print_r($data['malewidth']);
            $data11=array(
                "id"=>$key+1
                );
            $chipsModel->where($data11)->field('malewidth')->save($data);
        }
        foreach($femalenum as $key=>$val)
        {
            $data['femalewidth']=$val;
            //print_r($data['femalewidth']);
            $data11=array(
                "id"=>$key+1
                );
            $chipsModel->where($data11)->field('femalewidth')->save($data);
        }
     //进度条  
        $progress=$chipsModel->where("type_branch='运动'")->order('clickcount desc')->limit(0,2)->select();
        foreach($sid as $key => $value) {
            $chips[$key] = $chipsModel->where("sid='$value'")->field('chipname,clickcount,id,femalenum,malenum,malewidth,femalewidth')->order('clickcount desc')->select();
        }
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
     public function yl_sportsstore(){
        $id=I('id');
        $sellersModel=M("sellertab");
        $store=$sellersModel->find($id);
        //$shopcontent=$shoptabModel->where("shop_id='$id'")->find();
        $this->assign('sellertab', $store);
        $this->display();
    }

    public function set_hits(){
        /*
        M('chips')->where("id = '{$_GET['id']}'")->setInc('clickcount');
        $this->redirect('Life/tt');*/
        $data['id']=isset($_POST['id'])?intval(trim($_POST['id'])):0;
        $obj = M("chips");
 
        $data['sex']=$_SESSION['user']['sex'];
        //print_r($data['sex']);exit;
        if($data['sex']['sex']=='male'){
            //print_r('吃饭');exit;
            $obj->where($data)->setInc('malenum');
        }
        if($data['sex']['sex']=='female'){
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


}