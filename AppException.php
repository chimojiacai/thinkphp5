<?php
namespace app\common\exception;

use think\Exception;

/*
 * restful API 最佳实践
 *
 * POST 创建
 * PUT 更新
 * GET 查询
 * DELETE 删除
 * 状态码：404（当前请求的页面不存在） 400（当前的参数错误） 200（查询成功！）
 * 201 202（更新成功！） 401（未授权） 403（当前的资源被禁止） 500（服务器未知错误）
 * 错误码：自定义的错误ID号
 * 统一描述错误：错误码、错误信息 、当前URL
 * 使用token令牌来授权和验证身份
 * 版本控制
 * 测试与环境分开：api.xxx.com/dev.api.xxx.com
 * url 语义要明确，最好可以望文生义，最好是有一份比较标准的文档
 */

class AppException extends Exception
{
    public $code = 100500;
    public $msg = "100500 内部错误 ！";
    public $data = "";
    public $time = "";

    /**
     * 自定义返回的数据类型
     * AppException constructor.
     * @param string $code
     * @param int $msg
     * @param string $data
     */
    public function __construct($code, $msg, $data = '')
    {
        $this->code = $code;
        $this->msg = $msg;
        $this->data = $data;
        $this->time = time();
    }
}