<?php
namespace app\api\controller;
use think\Controller;
use \think\Db;

/**
* 
*/
class Base extends Controller
{
	
	public function _initialize()
    {
    	$this->right();
    	
    }


    public function right(){
    	$res = Db::name('article')->order('view_count desc')->limit(8)->select();
    	$cate = Db::name('category')->select();
    	$user = session('username');
        $userTime = session('expire');

        if ($userTime && $userTime < time()) {
            session(null);
            $user = '';
        }
		if(!$res || !$cate) {
			return $this->error('找不到你想要的，不好意思');
		}
		$this->assign('hot',$res);
		$this->assign('user',$user);
		$this->assign('hotcate',$cate);
		// return $res;
    }
}