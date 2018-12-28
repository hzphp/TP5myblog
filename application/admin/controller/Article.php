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
class Article extends Base
{
	
	protected $name = 'article';

	public function index()
	{
		// var_dump($_SESSION['think']);die;
		$keyword = Request::instance()->param('keywords');
		// var_dump($keyword);die;
		$word = $keyword ? $keyword : '';
		// var_dump($word);die;
		$articleModel = model('Article');
		$list = $articleModel->articleList($word);
		$page = $list->render();
		
		// var_dump($list);die;
		$this->assign('list', $list);
		$this->assign('page', $page);
		return $this->fetch();
	}

	public function add()
	{
		if(request()->isPost()) {
			// $a =Request::instance()->param();
			// var_dump($a);
			$time = time();
			$data = [
				'title' => input('title'),
				'cate_id' => input('cate_id'),
				'desc' => input('desc'),
				'is_top' => input('is_top'),
				'user_id' => input('user_id'),
				'is_publish' => input('is_publish'),
				'content' => input('content'),
				'created_at' => $time,
			];
			if($_FILES['pic']['tmp_name']){
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                $data['pic']='/uploads/'.$info->getSaveName();
            } else {
            	return $this->error('忘记选择图片了！');
            }
            $validate = \think\Loader::validate('Article');
    		if(!$validate->scene('add')->check($data)){
			   $this->error($validate->getError()); die;
			}

			if(db('Article')->insert($data)){
    			return $this->success('添加文章成功！','index');
    		}else{
    			return $this->error('添加文章失败！');
    		}
    		return;
			echo "<hr>";
			var_dump($_FILES);die;
			// if($_FILES)
			echo 1;die;
		}
		$cate = Db::name('category')->select();
		$this->assign('cateList', $cate);
		// var_dump($cate);die;
		return $this->fetch();
	}

	/**
	 * 修改文章
	 * @param [int] $[] [description]
	 */
	public function edit()
	{	
		$artId = input('id');
		$user_id = $_SESSION['think']['uid'];
		$artDetail = Db::name('article')->where('id',$artId)->find();
		// $artDetail = $this->where('id',$artId)->find();

		// var_dump($artDetail);die;
		if(request()->isPost()) { 
			// var_dump(input('is_publish'));
			// var_dump(input('is_top'));die;
			// if (empty(input('is_top')) || empty(input('is_publish'))) {
			// 	$this->error('置顶或发表不能为空！');
			// }
			// var_dump($_FILES);die;
			$time = time();
			$data = [
				'id'=>$artId,
				'title' => input('title'),
				'cate_id' => input('cate_id'),
				'desc' => input('desc'),
				'is_top' => input('is_top'),
				'user_id' => $user_id,
				'is_publish' => input('is_publish'),
				'content' => input('content'),
				'updated_at' => $time,
			];
			if($_FILES['pic']['tmp_name']){
                
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                $data['pic']='/uploads/'.$info->getSaveName();
            }

            $validate = \think\Loader::validate('Article');
    		if(!$validate->scene('edit')->check($data)){echo 2;die;
			   $this->error($validate->getError()); die;
			}
    		if(db('Article')->update($data)){
    			$this->success('修改文章成功！','index');
    		}else{
    			$this->error('修改文章失败！');
    		}
    		return;
		}
		$this->assign('artDetail',$artDetail);
		$cate = Db::name('category')->select();
		$this->assign('cateList', $cate);
		return view('edit');
	}
}