<?php
use Workerman\Worker;
use Workerman\WebServer;
// use Workerman\model\Test;



require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__.'/prepare.php';



//--------------WebServer--------------
// 这里监听8080端口，如果要监听80端口，需要root权限，并且端口没有被其它程序占用
$webserver = new WebServer('http://0.0.0.0:8888');
// 类似nginx配置中的root选项，添加域名与网站根目录的关联，可设置多个域名多个目录
$webserver->addRoot('workman.app', '/home/vagrant/Code/com/php');

// 设置开启多少进程
$webserver->count = 4;

//-------------------------------------

//--------------WebSocket--------------
//定义以守护进程启动时输出文件
Worker::$stdoutFile = "./logs/TestLog.php";
// 创建一个Worker监听7777端口，使用http协议通讯
$worker = new Worker("websocket://0.0.0.0:7777");
// 设置Worker实例的名称
$worker->name = "websocket";

// 启动4个进程对外提供服务
$worker->count = 4;

// 当有连接时
$worker->onConnect = function($connection) {
    echo $connection->getRemoteIp()."连接上了".PHP_EOL;
};


// 接收到浏览器发送的数据时回复hello world给浏览器
$worker->onMessage = function($connection, $data)
{

    $test = new Test;
    $test->msg = $data;
    $test->time = time();
    $test->save();

    // var_dump($data);
    $connection->send($data);
    // 向浏览器发送hello world
    // $connection->send('msg');
};




// 运行worker
Worker::runAll();

//--------------------------------------
