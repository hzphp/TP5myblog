<?php
namespace app\admin\model;
use think\Model;
use think\Db;
/**
* 
*/
class Article extends Model
{
	
	public function articleList($keywords)
	{
		// $data = $this->field('*')->select()->toArray();
		// $map = array();
		$map['a.title'] = ['like', '%'.trim($keywords).'%'];
		$data = $this->alias('a')
					 ->join('blog_category b', 'a.cate_id = b.id', 'left' )	
					 ->field('a.*, b.cate_name')
					 ->where($map)
					 ->order('a.created_at desc')
					 ->paginate(5);
		foreach ($data as $k => $v) {
			$data[$k]['created_at'] = date('Y-m-d H:i:s',$v['created_at']);
			$data[$k]['updated_at'] = date('Y-m-d H:i:s',$v['updated_at']);
		}
		// var_dump($data);die;
		return $data;
	}
}