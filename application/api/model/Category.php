<?php
namespace app\api\model;

use \think\Model;
use \think\Db;

/**
* 
*/
class Category extends Model
{
	
	public function showCate($id)
	{
		if (empty($id)) {
			// echo 'daola';die;
			// $data = Db::name('article')->order('id desc')->paginate(6);
			$data = $this->alias('a')
					->join('blog_article b', 'a.id = b.cate_id', 'left')
					->field('b.*')
					->order('b.id desc')
					->paginate(6);
			foreach ($data as $k => $v) {
				$data[$k]['created_at'] = date('Y-m-d H:i:s',$v['created_at']);
				$data[$k]['updated_at'] = date('Y-m-d H:i:s',$v['updated_at']);
			}
			// var_dump($data);die;
				return $data;
		}
		$data = $this->alias('a')
				->join('blog_article b', 'a.id = b.cate_id','left' )
				->where('b.cate_id',$id)
				->field('b.*')
				->paginate(6);
				// ->fetchSql(true)
				// ->select();
		foreach ($data as $k => $v) {
				$data[$k]['created_at'] = date('Y-m-d H:i:s',$v['created_at']);
				$data[$k]['updated_at'] = date('Y-m-d H:i:s',$v['updated_at']);
		}
		// var_dump($data);die;
		return $data;
		// var_dump($id);die;
	}
}