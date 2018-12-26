<?php
namespace app\admin\controller;
use app\admin\model\Admin as AdminModel;
use app\admin\model\Celldata as CelldataModel;
class Admin extends Common
{
    public function lst()
    {

    	$admin=new AdminModel();
    	$res=$admin->getadmin();
    	$this->assign('adminres',$res);
        return view();
    }
    public function celldata()
    {
        $celldata=new CelldataModel();
        $res=$celldata->getcelldata();
        $this->assign('celldatares',$res);
        return view();
    }
    public function add()
    {
    	if(request()->isPost())
    	{
    		$admin=new AdminModel();
    		if($admin->addadmin(input('post.')))
    		{
    			$this->success('添加管理员成功！ ',url('lst'));
    		}else{
    			$this->error('添加管理员失败！ ');
    		}
    		return;
    	}
        return view();
    }

    public function addcelldata()
    {
        if(request()->isPost())
        {
            $data=input('post.');
            if($_FILES['uploadimage']['tmp_name']){
                $data['uploadimage']=$this->upload();
            }

            $celldata=new CelldataModel();
            if($celldata->addcelldata($data))
            {
                $this->success('添加小区人员信息成功！ ',url('celldata'));
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
    public function addcelldatauser()
    {
        if(request()->isPost())
        {
            $data=input('post.');
            if($_FILES['uploadimage']['tmp_name']){
                $data['uploadimage']=$this->upload();
            }
            $celldata=new CelldataModel();
            if($celldata->addcelldata($data))
            {
                $this->success('添加小区人员信息成功！ ',url('/index/index'));
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

    public function edit()
    {
        return view();
    }
    public function editadmin($id)
    {
        if(request()->isPost())
        {
            $res=db('admin')->update(input('post.'));
            if($res!==false){
                $this->success('修改管理员成功！',url('lst'));
            }else{
                $this->error('修改管理员失败！');
            }
            return;
        }
        $admin=db('admin')->find($id);
        if(!$admin){
            $this->error('该管理员不存在',url('lst'));
        }
        $this->assign('editadmin',$admin);
        return view();
    }
    public function deladmin($id)
    {
        $res=db('admin')->delete($id);
        if($res){
            $this->success('删除管理员成功！',url('lst'));
        }else{
            $this->error('删除管理员失败！');
        }
    }
    public function editcelldata($id)
    {
        if(request()->isPost())
        {
            $imgres=db('celldata')->select($id);
            $imagepath=$imgres[0]['uploadimage'];
            if(!$imagepath){
                $data=input('post.');
                if($_FILES["uploadimage"]["tmp_name"]){
                    $data['uploadimage']=$this->upload();
                }
                $res=db('celldata')->update($data);
                if($res!==false){
                    $this->success('修改小区人员信息成功！',url('celldata'));
                }else{
                    $this->error('修改小区人员信息失败！');
                }
            }else{

                $data=input('post.');
                if($_FILES["uploadimage"]["tmp_name"]){
                    $data['uploadimage']=$this->upload();
                    $delimgres=unlink(ROOT_PATH . 'public' . DS . 'static'. DS .'uploads'.'\\'.$imagepath);
                }


                $res=db('celldata')->update($data);
                if($res!==false){
                    $this->success('修改小区人员信息成功！',url('celldata'));
                }else{
                    $this->error('修改小区人员信息失败！');
                }
            }

            return;
        }
        $celldata=db('celldata')->find($id);
        if(!$celldata){
            $this->error('该小区人员信息不存在',url('celldata'));
        }
        $this->assign('editcelldata',$celldata);
        return view();
    }
    public function delcelldata($id)
    {
        $imgres=db('celldata')->select($id);
        $imagepath=$imgres[0]['uploadimage'];
        if(!$imagepath){
            $res=db('celldata')->delete($id);
            if($res){
                $this->success('删除小区人员信息成功！',url('celldata'));
            }else{
                $this->error('删除小区人员信息失败！');
            }
        }else{
            $delimgres=unlink(ROOT_PATH . 'public' . DS . 'static'. DS .'uploads'.'\\'.$imagepath);
            $res=db('celldata')->delete($id);
            if($res&&$delimgres){
                $this->success('删除小区人员信息成功！',url('celldata'));
            }else{
                $this->error('删除小区人员信息失败！');
            }
        }

    }
    public function logout(){
        session(null);
        $this->success('退出登录成功！',url('login/index'));
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
