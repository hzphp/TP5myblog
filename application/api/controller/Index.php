<?php
namespace app\api\controller;
use \think\Db;
use \think\Controller;
use \think\Request;
// use app\api\controller\Base;
class Index extends Base
{
    public function index()
    {
    	$artModel = model('article');
    	$articles =$artModel->showData();
    	// $art = collection($articles)->toArray();
    	// var_dump($art);die;
  
  		//var_dump($articles);die;
    	$this->assign('articles',$articles);
    	$page = $articles->render();
    	$this->assign('page', $page);
        return  $this->fetch('index');
    }

    public function articleDetail()
    {
    	$artId = Request::instance()->param('id');
    	// var_dump($artId);die;
    	$artModel = model('article');
    	$data =$artModel->articleData($artId);
    	// var_dump($data);die;
        // $this->assign('artDetail',$data);
        // return  $this->fetch('articleDetail');
        return view('articleDetail',['artDetail'=>$data]);
    }

   
}
