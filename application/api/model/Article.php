<?php
namespace app\api\model;
use think\Model;
use think\Db;

/**
* 
*/
class Article extends Model
{
	public function showData()
	{
		$data = $this->order('id desc')->paginate(6);
		foreach ($data as $k => $v) {
			$data[$k]['created_at'] = date('Y-m-d H:i:s',$v['created_at']);
			$data[$k]['updated_at'] = date('Y-m-d H:i:s',$v['updated_at']);
		}
		// var_dump($data);die;
		return $data;
	}

	public function articleData($id)
	{
		$result = Db::name('article')->where('id',$id)->find();
		// $res = collection($result)->toArray();
		// var_dump($result);die;
		if (!$result) {
			return $this->error('文章已删除！');
		}
		Db::name('article')->where('id', $id)->setInc('view_count');
		$result['created_at'] = date('Y-m-d ',$result['created_at']);
		$result['updated_at'] = date('Y-m-d ',$result['updated_at']);
		// var_dump($result['created_at']);die;
		// foreach ($result as $key => $vo) {
		// 	$result[$key]['created_at'] = date('Y-m-d H:i:s',$vo['created_at']);
		// 	$result[$key]['updated_at'] = date('Y-m-d H:i:s',$vo['updated_at']);
		// }
		// $list = collection($result)->toArray();
		// var_dump($list);die;
		// var_dump($result);die;
		return $result;
	}

	
}