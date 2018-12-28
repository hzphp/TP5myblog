<?php
namespace app\admin\model;
use think\Model;
use think\Db;

/**
* 
*/
class Category extends Model
{
	
	// protected $name = 'blog_category';
	public function cateList()
	{
		// $data = $this->field('id, cate_name, created_at, updated_at')->select()->toArray();
		$data = $this->field('id, cate_name, created_at, updated_at')->paginate(5);
		foreach($data as $k=>$v) {
			$data[$k]['id'] = $v['id'];
			$data[$k]['cate_name'] = $v['cate_name'];
			$data[$k]['created_at'] = date('Y-m-d H:i:s',$v['created_at']);
			$data[$k]['updated_at'] = date('Y-m-d H:i:s',$v['updated_at']);
		}
		// var_dump($data);die;
		return $data;
	}
}