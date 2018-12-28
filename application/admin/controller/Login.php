<?php

namespace app\admin\controller;
use think\Controller;
/**
* 
*/
class Login extends Controller
{
	
	public function doLogin()
	{
		if(request()->isPost()) {
			$param = input('post.');
			$username = $param['username'];
			$password = $param['password'];
			$adminUser = model('Admin');
			$num = $adminUser->login($username,$password);
			// var_dump($num);die;
			if($num == 3) {
				$this->success('正在登录...','index/index');
			} else {
				$this->error('用户名或者密码错误','Login/doLogin');
			}
		}
		return $this->fetch('login');
	}
}