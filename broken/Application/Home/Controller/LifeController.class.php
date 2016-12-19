<?php
namespace Home\Controller;
use Think\Controller;
class LifeController extends Controller {
	public function match(){
        $slidersModel=M("sliders");
        $sliders = $slidersModel->where("type_branch='搭配'")->select();
        $this->assign('sliders', $sliders);
        $activityModel=M("activity");
        $activity = $activityModel->where("type_branch='搭配'")->select();
        $this->assign('activity', $activity);
        //判断登陆
        $data['busername']=$_SESSION['user']['busername'];
        $this->assign('user',$data);
        $shopModel=M("sellertab");
        $shop = $shopModel->where("type_branch='搭配'")->select();
        // $this->assign('sellertab', $shop);
        // print_r($shop);exit;
        //标签部分
        $chipsModel=M("chips");
        $sid=$shopModel->where("type_branch='搭配'")->field('sid')->select();
        foreach ($sid as $key => $value) {
             $sid[$key]=$sid[$key]['sid'];
             // $chips[$key] = $chipsModel->where("sid='$value'")->select();
         }//sid的数组
       //  print_r($sid);exit;

        $count=$chipsModel->where("id")->field('clickcount')->select();
        $male=$chipsModel->where("id")->field('malenum')->select();
        $female=$chipsModel->where("id")->field('femalenum')->select();
        //print_r($male);exit;
        //print_r(round($male[1]['malenum']/$count[1]['clickcount'],2));exit;
        $length=$chipsModel->count();
        //print_r($length);exit;
        for($i=0;$i<$length;$i++)
        {
            $malenum[$i]=round($male[$i]['malenum']/$count[$i]['clickcount'],2)*100;
            $femalenum[$i]=round($female[$i]['femalenum']/$count[$i]['clickcount'],2)*100;
            //$data['malewidth']=$malenum[$i];
        }
        //print_r($malenum);exit;
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
        $progress=$chipsModel->where("type_branch='搭配'")->order('clickcount+0 desc')->limit(0,2)->select();
        //print_r($progress);exit;
        //$this->assign('progress',$progress);

        foreach($sid as $key => $value) {
            $chips[$key] = $chipsModel->where("sid='$value'")->field('chipname,clickcount,id,femalenum,malenum,malewidth,femalewidth')->order('clickcount+0 desc')->select();
        }//0店  0 1 2。。的标签 
        //print_r($chips);exit;
        //print_r($new);exit;
        //三层转二层
        // foreach($chips as $key=>$value){
        //     if($value['id']){
        //         $newchips[]=$value;
        //     }
        //     else{
        //        foreach($value as $k=>$v){
        //         $newchips[]=$v;
        //     } 
        //     }
         foreach($chips as $key=>$value){
           foreach ($value as $k => $v) {
               $data[$key][$k]=$v;
           }
          }  
        //print_r($data);exit;
        // foreach($newchips as $k=>$v){
        //     $newchips[$k]=$newchips[$k]['chipname'];
        // }
        // foreach($shop as $k=>$v){
        //     $shop[$k]['chipname']=$newchips;
        // }
        //print_r($chips);exit;
        // $chipnamestr= implode(",",$newchips);
        // $chipnamearr=explode(",",$chipnamestr,3);
        //print_r($chipnamearr);exit;
        // foreach($shop as $key=>$val){
        //     $shop[$key]['chipname']=$chipnamestr;
        // }
        foreach($shop as $key=>$val){
             $shop[$key]['chiptwo']=$data[$key];
         }
        //print_r($shop);exit;
        $this->assign('sellertab', $shop);
        //print_r($sid);exit;
        // for ($j=0;$j<count($sid);$j++) {
        //     for ($i=0;$i<count($sid);$i++){
        //         $chips[$i] = $chipsModel->where("sid='$value'")->select();
        //     }
        // }
        //print_r($chips);exit;
        
        $this->display();
    }
    public function mat(){
        $chipsModel=M("chips");
         $id=$_POST['data'];
         $ssid=I('id');
        // //print_r($_POST['data']);exit;
        $chips = $chipsModel->where("sid=4")->order('clickcount+0 desc')->select();
        // //print_r($chip);exit;
        error_log(print_r($ssid, true));
        // $this->assign('ch',$chips);
       echo $_POST['data'];
       
    }
    public function beauty(){
        $slidersModel=M("sliders");
        $sliders = $slidersModel->where("type_branch='美妆'")->select();
        $this->assign('sliders', $sliders);
        $activityModel=M("activity");
        $activity = $activityModel->where("type_branch='美妆'")->select();
        $this->assign('activity', $activity);
        //判断登陆
        $data['busername']=$_SESSION['user']['busername'];
        $this->assign('user',$data);
        //店铺部分
        $shopModel=M("sellertab");
        $shop = $shopModel->where("type_branch='美妆'")->select();
        //标签部分
        $chipsModel=M("chips");
        $sid=$shopModel->where("type_branch='美妆'")->field('sid')->select();
        //店铺赋值
        foreach ($sid as $key => $value) {
             $sid[$key]=$sid[$key]['sid'];
             // $chips[$key] = $chipsModel->where("sid='$value'")->select();
         }
         //进度条计算
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
        $progress=$chipsModel->where("type_branch='美妆'")->order('clickcount+0 desc')->limit(0,2)->select();
        //店铺表与标签表数据处理
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
    public function book(){
        $slidersModel=M("sliders");
        $sliders = $slidersModel->where("type_branch='阅读'")->select();
        $this->assign('sliders', $sliders);
        $activityModel=M("activity");
        $activity = $activityModel->where("type_branch='阅读'")->select();
        $this->assign('activity', $activity);
        //判断登陆
        $data['busername']=$_SESSION['user']['busername'];
        $this->assign('user',$data);
        //店铺部分
        $shopModel=M("sellertab");
        $shop = $shopModel->where("type_branch='阅读'")->select();
        //标签部分
        $chipsModel=M("chips");
        $sid=$shopModel->where("type_branch='阅读'")->field('sid')->select();
        //店铺sid赋值
        foreach ($sid as $key => $value) {
             $sid[$key]=$sid[$key]['sid'];
             // $chips[$key] = $chipsModel->where("sid='$value'")->select();
         }
         //进度条计算
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
        $progress=$chipsModel->where("type_branch='阅读'")->order('clickcount+0 desc')->limit(0,2)->select();
        //店铺表与标签表数据处理
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
    public function store(){
        $id=I('id');
        $shoptabModel=M("sellertab");
        $shop=$shoptabModel->find($id);
        $this->assign('sellertab', $shop);
        //$shopcontent=$shoptabModel->where("shop_id='$id'")->find();
        $this->display();
    }
    public function post(){
        $shopModel=M("sellertab");
        $shop = $shopModel->where("type_branch='快递'")->select();
        $this->assign('sellertab', $shop);
    	$this->display();
    }
    
     //标签点击函数
    public function set_hits(){
        /*
        M('chips')->where("id = '{$_GET['id']}'")->setInc('clickcount');
        $this->redirect('Life/tt');*/
        //echo $_POST['data']?$_POST['data']:'000';exit;
        $data['id']=isset($_POST['data'])?intval(trim($_POST['data'])):0;
        //print_r($data['id']);exit;
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
        if(!isset($_COOKIE[$_POST['data']+10000])&&$obj->where($data)->setInc('clickcount')){
            $cookiename = $_POST['data']+10000;
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
    /*
    public function issex(){
        $obj = M("chips");
        $data['id']=isset($_POST['id'])?intval(trim($_POST['id'])):0;
        $obj = M("chips");
        //$obj->where($data)->setInc('femalecount');
        if($data['sex']['sex']=='male'){
            //print_r('吃饭');exit;
            $obj->where($data)->setInc('femalenum');
            $data['info'] = "ok";
            $data['status'] = 1;
            $this->ajaxReturn($data);
            exit();
        }
        else if($data['sex']['sex']=='female'){
            $obj->where($data)->setInc('malenum');
            $data['info'] = "ok";
            $data['status'] = 1;
            $this->ajaxReturn($data);
            exit();
        }
        else{
            $data['info'] = "fail";
            $data['status'] = 0;
            $this->ajaxReturn($data);
            exit();
        }*/
        /*
        $obj = M("chips");
        $data['username']=$_SESSION['user']['busername'];
        $data['sex']=$_SESSION['user']['sex'];
        //print_r($data['sex']);exit;
        if($data['sex']['sex']=='male'){
            //print_r('吃饭');exit;
            $obj->setInc('femalecount');
        }
        if($data['sex']=='female'){
            $obj->setInc('malecount');

        }
*/
}  