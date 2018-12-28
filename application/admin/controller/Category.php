<?php
namespace app\admin\controller;

use app\admin\controller\Base;
// use app\admin\model\Category as CateModel;
// use \think\db;
use \think\Request;
use \think\Db;
use \think\Validate;
/**
* 
*/
class Category extends Base
{
	
	public function index()
	{
		// var_dump($_SESSION['think']);die;
		$cateModel = model('Category');
		$list = $cateModel->cateList();
		$page = $list->render();
		// $list = CateModel::paginate(5);
		// var_dump($list);die;
		$this->assign('list', $list);
		$this->assign('page', $page);
		return $this->fetch();
	}

	public function add()
	{
		if(request()->isPost()) {
			$time = time();
			// $data=[
   //  			'cate_name'=>input('cate_name'),
   //  			'created_at'=>$time,
   //  		];
			$data = array();
			$data['cate_name'] = input('cate_name');
			$data['created_at'] = $time;
			// $result = $this->validate($data,'Category.add');
			// var_dump($result);die;
    		$validate = \think\Loader::validate('Category');
    		// $validate = new Validate('Category');
    		$cname = db('category')->where('cate_name',$data['cate_name'])->find();
    		if($cname) {
    			return $this->error('此类已存在');
    		}
    		if(!$validate->scene('add')->check($data)){
			   $this->error($validate->getError()); die;
			}
			if(db('category')->insert($data)){
    			return $this->success('添加分类成功！','index');
    		}else{
    			return $this->error('添加栏目失败！');
    		}
    		return;
		}
		return $this->fetch();
	}

	public function del()
	{
    	$id=input('id');
    	if($id != 2){
    		if(db('category')->delete(input('id'))){
    			$this->success('删除栏目成功！','index');
    		}else{
    			$this->error('删除栏目失败！');
    		}
    	}else{
    		$this->error('初始化栏目不能删除！');
    	}
    	
    }

    public function edit()
    {
    	// $data     = Request::instance()->param();//获取传过来的所有数据
    	$id     = Request::instance()->param('id');
    	// var_dump($data);die;
    	$cate = Db::name('category')->where(['id'=>$id])->find();
    	if(!$cate) {
    		return $this->error('该分类不存在');
    	}
    	if(request()->isPost()) {
    		$time = time();
    		$data=[
    			'id'=>input('id'),
    			'cate_name' => input('cate_name'),
    			'updated_at' => $time,
    		];
    		// var_dump($data);die;
    		$cname = Db::name('category')->column('cate_name');
    		if (in_array($data['cate_name'], $cname)) {
    			return $this->error('该分类已经存在');
    		}
    		// var_dump($cname);die;
    		$validate = \think\Loader::validate('Category');
    		if(!$validate->scene('edit')->check($data)){
			   $this->error($validate->getError()); die;
			}
			$result=Db::name('category')->update($data);
			// var_dump($result);die;
			if($result !== false){
    			$this->success('修改分类成功！','index');
    		}else{
    			$this->error('修改分类失败！');
    		}
    		return;
    	}
    	$this->assign('cates',$cate);
    	return $this->fetch();
    }
}