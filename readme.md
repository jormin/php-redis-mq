## About

这个项目是PHP+Redis做的轻量级MQ,仅仅用于测试说明,没有实际业务

## 使用

1. 配置 `register.php` 和 `worker.php` 中的数据库和Redis链接

2. 导入sql文件 `mq_user.sql`

3. 运行 `worker.php` ,订阅频道 `register_users`

```
vagrant@homestead:~/code/php-redis-mq$ php work.php
```

4. 运行 `register.php` 进行测试

```
vagrant@homestead:~/code/php-redis-mq$ php register.php [姓名] [手机号]
```

## 运行结果

![](https://qiniu.blog.lerzen.com/4afe78c0-bcfd-11e8-8098-d38853105177.gif)