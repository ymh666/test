<?php
namespace app\index\model;
use think\Model;
class Celldata extends Model
{

    public function addcelldatauser($data){
        if(empty($data)||!is_array($data)){
            return false;
        }
        if($this->save($data)){
            return true;
        }else{
            return false;
        }
    }
//    public function getcelldata(){
//        return db('celldata')->paginate(10);
//    }
//    public function addcelldata($data){
//        if(empty($data)||!is_array($data)){
//            return false;
//        }
//        $celldata=new celldata();
//        if($celldata->save($data)){
//            return true;
//        }else{
//            return false;
//        }
//    }
}
