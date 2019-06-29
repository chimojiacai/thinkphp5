<?php

namespace app\common\exception;

use think\Exception;
use think\exception\Handle;
use think\Log;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;
    private $data;
    private $time;

    /**
     * 继承并重写Exception类
     * @param \Exception $ex
     * @return array|\think\Response
     */
    public function render(\Exception $ex)
    {
        if ($ex instanceof AppException) {
            $this->code = $ex->code;
            $this->msg = $ex->msg;
            $this->data = $ex->data;
            $this->time = $ex->time;
        } else {
            if (config('app_debug')) {
                //显示页面错误，用于开发人员内部开发
                return parent::render($ex);
            } else {
                $this->code = 500;
                $this->msg = "server error !";
                $this->data = '';
                $this->errorCode = 999999;
                $this->recordErrorLog($ex);
            }
        }

        $result = [
            'code' => $this->code,
            'msg' => $this->msg,
            'data' => $this->data,
            'time' => $this->time,
        ];
        return json($result, 200);
    }

    /**
     * 自定义日志错误记录
     * @param \Exception $ex
     */
    private function recordErrorLog(\Exception $ex)
    {
        $error = $ex->getMessage() . $ex->getFile() . '文件' . $ex->getLine() . '行';
        Log::init([
            'type' => 'File',
            'path' => '../logs/',
            'level' => ['error'],
        ]);
        Log::write($error, 'error');
    }

}