<?php
namespace app\admin\controller;

class Index extends Common
{
    public  function _initialize()
    {
        if(!session('id')||!session('name')){
            $this->error('请先进行登录!',url('login/index'));
        }
    }
    public function index()
    {
        return view();
    }
}
