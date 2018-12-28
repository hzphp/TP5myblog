<?php
namespace app\admin\validate;
use think\Validate;
class Article extends Validate
{
    protected $rule = [
        'title'  =>  'require|max:25',
        'cate_id' =>  'require',
    ];

    protected $message  =   [
        'title.require' => '文章标题必须填写',
        'title.max' => '文章标题长度不得大于25位',
        'cate_id.require' => '请选择文章所属栏目',

    ];

    protected $scene = [
        'add'  =>  ['title','cate_id'],
        'edit'  =>  ['title','cate_id'],
    ];




}
