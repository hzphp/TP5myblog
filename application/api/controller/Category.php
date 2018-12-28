<?php
namespace app\api\controller;
use \think\Db;
use \think\Controller;
use \think\Request;
// use app\api\controller\Base;

/**
* 
*/
class Category extends Base
{
	
	public function index()
	{
		// echo '到达';die;
		$cateId = Request::instance()->param('id');
		$cateId = $cateId ? $cateId : '';
		// var_dump($cateId);die;
		$cateModel = model('Category');
		$cates = $cateModel->showCate($cateId);

		// var_dump($cates);die;
		
		$this->assign('cates',$cates);

    	$page = $cates->render();
    	// var_dump($page);die;
    	$this->assign('page', $page);
        return  $this->fetch();
		// var_dump($data);die;
	}
}