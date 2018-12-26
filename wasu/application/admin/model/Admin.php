<?php
namespace app\admin\model;
use think\Model;
class Admin extends Model
{
	public function addadmin($data){
		if(empty($data)||!is_array($data)){
			return false;
		}
		
		if($this->save($data)){
			return true;
		}else{
			return false;
		}
	}

	public function getadmin(){
		return Admin::order("ID asc")->paginate(5);
	}
    public function login($data){
	    $admin=Admin::getbyname($data['name']);
	    if($admin){
	        if($admin['password']==$data['password']) {
                session('id',$admin['id']);
                session('name',$admin['name']);
	            return 2;
            }else{
	            return 3;
            }
        }else{
	        return 1;
        }
    }
}
