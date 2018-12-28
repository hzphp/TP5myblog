<?php
namespace app\admin\validate;
use think\Validate;
class Category extends Validate
{
    protected $rule = [
        'cate_name'  =>  'require|max:25',
    ];

    protected $message  =   [
        'cate_name.require' => '栏目名称必须填写',
        'cate_name.max' => '栏目名称长度不得大于25位',
        // 'cate_name.unique' => '栏目名称不得重复',

    ];

    protected $scene = [
        'add'  =>  ['cate_name'=>'require'],
        'edit'  =>  ['cate_name'=>'require'],
    ];




}
