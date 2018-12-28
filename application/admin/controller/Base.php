<?php 
namespace app\admin\controller;
use think\Controller;

/**
* 
*/
class Base extends Controller
{
	
	public function _initialize()
	{
		// if (empty($_SESSION['username'])) {
		// 	$this->error('请先登录系统！','Login/doLogin');
		// }$_SESSION['think']['expiretime']
		$sessionTime = session('expiretime');
		if(!session('username') || $_SESSION['think']['expiretime'] < time()){
			session(null);
            $this->error('请重新登录系统！','Login/doLogin');
        }
         
	}
}