<?php
require './lib.php';
$name = $argv[1];
$mobile = $argv[2];
if(empty($name) || empty($mobile)){
    die("参数错误");
}
$connection = getDBConnection('127.0.0.1', 'homestead', 'secret', 'mq');
// 开启事务
mysqli_begin_transaction($connection);
$sql = "insert into mq_user(name, mobile) values ('$name', '$mobile')";
if(!mysqli_query($connection, $sql)){
    die("写入用户信息失败,原因:".$connection->error);
}
$redis = getRedis();
// 添加消息
$result = $redis->lpush('register_users', json_encode(array('name'=>$name, 'mobile'=>$mobile), JSON_UNESCAPED_UNICODE));
if($result === false){
    mysqli_rollback($connection);
    die("添加消息队列失败");
}
// 发布消息
$redis->publish('register_success', 'ok');
// 所有操作完成后提交事务
mysqli_commit($connection);
$connection->close();
$redis->close();