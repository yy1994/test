<?php
// namespace Workerman\model
/**
* 测试表
*/
use Illuminate\Database\Eloquent\SoftDeletes;
class Test extends Illuminate\Database\Eloquent\Model {
    //设置软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //此模型使用的数据库表名
    protected $table = "test";

    //设置是否有created_at和update_at字段
    public $timestamps = false;
    


}