# thinkphp5
异常捕捉
把这三个文件放到/application/common目录下,没有common目录就新建个.
然后再application下的config.php里修改
    // 异常处理handle类 留空使用 \think\exception\Handle
    'exception_handle' => 'app\common\exception\ExceptionHandler',
.最后代码中调用
throw new AppException(错误码, 错误说明);
