<?php
namespace app\admin\controller;
use think\Controller;

class Common extends Controller
{
    public  function _initialize()
    {
        if(!session('id')||!session('name')){
            $this->error('请先进行登录!',url('login/index'));
        }
    }
}
