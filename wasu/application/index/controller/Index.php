<?php
namespace app\index\controller;
use app\index\model\Celldata as CelldataModel;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
        return view();
    }
    public function addcelldatauser()
    {
        if(request()->isPost())
        {
            $data=input('post.');
            if($_FILES['uploadimage']['tmp_name']){
                $data['uploadimage']=$this->upload();
            }
            $celldata=new CelldataModel();
            if($celldata->addcelldatauser($data))
            {
                $this->success('添加小区人员信息成功！ ',url('/index'));
            }else{
                $this->error('添加小区人员信息失败！ ');
            }
            return;
        }
//        if(request()->isPost()){
//            $data=input('post.');
//            //处理图片上传
//            //提交时在浏览器存储的临时文件名称
//            if($_FILES['image']['tmp_name']){
//                $data['image']=$this->upload();
//            }
//            //讲传入的图片写入到test_images表中，使用Thinkphp5自定义的函数insert()
//            $add=db('test_images')->insert($data);
//            if($add){
//                //如果添加成功，提示添加成功。success也可以定义跳转链接，success('添加图片成功！','这里写人跳转的url')
//                $this->success('添加图片成功！');
//            }else{
//                $this->error('添加图片失败！');
//            }
//            return;
//        }
        return view();
    }
    public function upload(){
        // 获取表单上传的文件，例如上传了一张图片
        $file = request()->file('uploadimage');
        if($file){
            //将传入的图片移动到框架应用根目录/public/uploads/ 目录下，ROOT_PATH是根目录下，DS是代表斜杠 /
            $info = $file->move(ROOT_PATH . 'public' . DS . 'static'. DS .'uploads');
            if($info){
                return $info->getSaveName();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();die;
            }
        }
    }
}
