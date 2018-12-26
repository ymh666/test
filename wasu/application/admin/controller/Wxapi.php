<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Wxapi extends Controller
{
    public function wxtest(){
        $data = input('post.');
        $res = Db::name('test')->insert($data,true);
        $arraysuccess = [
            "msg" => "上传成功",
        ];
        $arrayfail = [
            "msg" => "上传失败",
        ];
        if ($res)
        {
            return  json_encode($arraysuccess);
        }else{
            return  json_encode($arrayfail);
        }
        //dump(json_decode($array));

    }

    public function wxcellinformationinput(){
        $data = input('post.');
        $res = Db::name('celldata')->insert($data,true);

        $arraysuccess = [
            "msg" => "上传成功",
        ];
        $arrayfail = [
            "msg" => "上传失败",
        ];
        if ($res)
        {
            return  json_encode($arraysuccess);
        }else{
            return  json_encode($arrayfail);
        }
        //dump(json_decode($array));

    }
    public function wxcellinformationinputwithpic(){
        $data = [
            "cell_name" => $_POST['cell_name'],
            "resident_name" => $_POST['resident_name'],
            "telephone" =>  $_POST['telephone'],
            "id_number" => $_POST['id_number'],
            "id_car" => $_POST['id_car'],
            "adress" =>  $_POST['adress'],
            "is_mobile" =>  $_POST['is_mobile'],
            "relation" => $_POST['relation'],
            "is_same" => $_POST['is_same'],
            "is_noman" =>  $_POST['is_noman'],
            "uploadimage" =>  '',
        ];
        if($_FILES['wxuploadimg']['tmp_name']){
            $data['uploadimage']=$this->upload();
        }
        $res = Db::name('celldata')->insert($data,true);

        $arraysuccess = [
            "msg" => "上传成功",
        ];
        $arrayfail = [
            "msg" => "上传失败",
        ];
        if ($res)
        {
            return  json_encode($arraysuccess);
        }else{
            return  json_encode($arrayfail);
        }
        /*$data = input('post.');
        if($_FILES['wxuploadimg']['tmp_name']){
            $data['uploadimage']=$this->upload();
        }
        $res = Db::name('celldata')->insert($data,true);

        $arraysuccess = [
            "msg" => "上传成功",
        ];
        $arrayfail = [
            "msg" => "上传失败",
        ];
        if ($res)
        {
            return  json_encode($arraysuccess);
        }else{
            return  json_encode($arrayfail);
        }*/
    }
    public function upload(){
        // 获取表单上传的文件，例如上传了一张图片
        $file = request()->file('wxuploadimg');
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
