<?php
namespace Admin\Controller;
use Think\Controller;
class SettingController extends Controller {
    public function index(){
        $m=M('product');
        $arr=$m->find($_SESSION['prodid']);
        $this->assign('arr',$arr);
         
        $this->display();
    }
    
    
    
    public function aimg(){
        $m=M('product');
        $arr=$m->find($_SESSION['prodid']);
        $this->assign('arr',$arr);
         
        $this->display();
        
    }
    
    public function img(){

        $upload = new \Think\Upload();// 实例化上传类
//         $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath =  './Public/Upload/';// 设置附件上传目录
        $upload->savePath  = '/Setting/adress/'; // 设置附件上传目录
        
        $info  =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功 获取上传文件信息
            $_POST['path']=$info['img']['savepath'];
            $_POST['img']=$info['img']['savename'];
            /* 实例化模型*/
            $db=D('product');
            if ($db->save($_POST)){
//                 $image = new \Think\Image();
//                 $image->open('./Public/Upload/'.$info['aimg']['savepath'].$info['aimg']['savename']);
//                 $image->thumb(800, 400,\Think\Image::IMAGE_THUMB_CENTER)->save('./Public/Upload/'.$info['aimg']['savepath'].'/thumb_'.$info['aimg']['savename']);
                $this->success("上传成功！");
            }else{
                $this->error("上传失败！");
            }
        }
        
    }
    
    public function update(){
        $db=D('product');        
        $_POST['moder']=$_SESSION['realname'];              
        if ($db->save($_POST)){
            $this->success("修改成功！");
        }else{
            $this->error("修改失败！");
        }
    }
}