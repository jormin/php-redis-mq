<?php
require './lib.php';
$redis = getRedis();
$redis->subscribe(['register_success'], function ($instance, $channelName, $message){
    if($channelName == "register_success" && $message = "ok"){
        $redis = getRedis();
        $arr = $redis->brPop(['register_users'], 20);
        if(count($arr)){
            $userInfo = json_decode($arr[1], true);
            stdout("新注册用户信息:");
            stdout("姓名:".$userInfo['name']);
            stdout("手机号:".$userInfo['mobile']);
            stdout();
        }
    }
});