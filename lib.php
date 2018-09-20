<?php

/**
 * 获取数据库连接
 *
 * @param $host
 * @param $username
 * @param $password
 * @param $database
 * @return mysqli
 */
function getDBConnection($host, $username, $password, $database){
    $connection = new mysqli($host, $username, $password, $database);
    if($connection->connect_errno){
        die("数据库连接出错");
    }
    mysqli_query($connection, "set names 'utf8'");
    return $connection;
}

/**
 * 获取Redis连接
 *
 * @param $host
 * @param $port
 * @param string $password
 * @param int $database
 * @return Redis
 */
function getRedis($host='127.0.0.1', $port='6379', $password=null, $database=0){
    $redis = new Redis();
    if(!$redis->connect($host, $port)){
        die("Redis连接失败:IP或端口有误");
    }
    if(!empty($password) && !$redis->auth($password)){
        die("Redis连接失败:密码错误");
    }
    if($database){
        $redis->select($database);
    }
    return $redis;
}

/**
 * 打印消息日志
 *
 * @param $msg
 */
function stdout($msg=null){
    $msg = '['.date('Y-m-d H:i:s').']'.$msg.chr(10);;
    fwrite(STDOUT, $msg);
}