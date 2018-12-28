<?php
namespace app\api\controller;
use think\Controller;
use \think\Db;
use \think\Request;
/**
* 
*/
class Account extends Controller
{

	//用户注册
	public function resgister()
	{
		$param = Request::instance()->param();
		// var_dump($param);die;
		if ($param) {
			$name = $param['user'];
			$pwd  = $param['password'];
			// var_dump($name);die;
			if(!empty(trim($name))) {
				$user = Db::name('user')->where('username', $name)->find();
				if ($user) {
					return $this->error('此用户昵称已存在');
				}
				if (!empty(trim($pwd))) {
					$p = password_hash($pwd, PASSWORD_DEFAULT);
					// var_dump($p);die;
					// $time = date('Y-m-d H:i:s',time());
					$time = time();
					// var_dump($time);die;
					$data = [
						'username'=>$name,
						'password'=>$p,
						'addtime'=>$time,
					];
					$res = Db::name('user')->insert($data);
					if ($res) {
						return $this->success('注册成功','Account/login');
					} else {
						return $this->error('呜哇，注册失败了');
					}
				}
			}
		}
		return $this->fetch('reg');
	}


	//用户登录
	public function login()
	{
		$param = Request::instance()->param();
		if ($param) {
			$name = $param['user'];
			$pwd  = $param['password'];
			if (empty(trim($name)) || empty(trim($pwd))) {
				return $this->error('用户名或密码不能为空');
			}
			$user = Db::name('user')->where('username', $name)->find();
			if ($user) {
				if (password_verify($pwd, $user['password'])) {
					session('username',$user['username']);
					session('id',$user['id']);
					// var_dump($_SESSION);die;
					session('expire',time() + 1800);
					return $this->success('登录成功...即将跳转','Index/index');
				}
			} else {
				return $this->error('用户不存在');
			}

		}
		return $this->fetch('login');
	}

	public function logout()
	{
		session(null);
        $this->success('退出成功！','Index/index');
	}
}