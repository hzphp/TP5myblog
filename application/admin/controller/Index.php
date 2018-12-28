<?php
namespace app\admin\controller;
use app\admin\controller\Base;

/**
* 
*/
class Index extends Base
{
	
	public function index()
	{
		return $this->fetch();
	}


	public function logout(){
        session(null);
        $this->success('退出成功！','Login/doLogin');
    }
}