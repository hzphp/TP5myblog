<?php
namespace app\admin\model;
use think\Model;
use think\Db;

/**
* 
*/
class Admin extends Model
{
	
	public function login($username,$password)
	{
		$user = Db::name('admin')->where('username',$username)->find();
		if ($user) {
			// $pass = password_hash($password,PASSWORD_DEFAULT);echo $pass;die;
			if(password_verify($password,$user['password'])) {
				session('username',$user['username']);
				session('uid',$user['id']);
				session('expiretime',time() + 3600);
				return 3;//信息正确
			} else {
				return 2;//密码错误
			}
		} else {
			return 1;//用户不存在
		}
	}
}