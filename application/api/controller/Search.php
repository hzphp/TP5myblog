<?php
namespace app\api\controller;
use \think\Db;
use \think\Controller;
use \think\Request;


/**
* 
*/
class Search extends Base
{
	
	public function index()
	{
		// echo "string";die;
		$words = Request::instance()->param('keyword');
		// var_dump($words);die;
		if ($words) {
			$map['title'] = ['like','%'.$words.'%'];
			$result = Db::name('article')->where($map)->select();
			$res = collection($result)->toArray();
			// var_dump($a);die;
			foreach ($res as $key => $value) {
				$res[$key]['created_at'] = date('Y-m-d ',$value['created_at']);
			}
			
			$this->assign('data',$res);
		} else {
			$this->assign('data','没找到该文章');
		} 

		return $this->fetch();

	}
}