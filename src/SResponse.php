<?php


namespace Alan\SimpleResponse;


use Alan\SimpleResponse\Helpers\Arrays;

class SResponse
{
    const CODE_OK       = 1;
    const CODE_FAIL     = 2;
    const MSG_OK        = "this is ok";
    const MSG_FAIL      = "has error";
    const FIELD_CODE    = 'code';
    const FIELD_MESSAGE = 'msg';
    const FIELD_DATA    = 'data';

    private $data;

    /**
     * 构造RCP的业务返回结构
     * @param integer $code 状态码
     * @param string $msg 消息内容
     * @param string|array $data 数据体
     * @return array
     */
    private static function build ($code, $msg, $data){
        return [self::FIELD_CODE => $code, self::FIELD_DATA => $data, self::FIELD_MESSAGE => $msg];
    }

    /**
     * 构造RCP的业务正常的返回结构
     * @param array $data
     * @param string $msg
     * @param int $code
     * @return array
     */
    public static function ok ($data = [], $msg = self::MSG_OK, $code = self::CODE_OK)
    {
        return self::build($code, $msg, $data);
    }

    /**
     * 构造RCP的业务异常的返回结构
     * @param array $data
     * @param string $msg
     * @param int $code
     * @return array
     */
    public static function fail($msg = self::MSG_FAIL, $data = [], $code = self::CODE_FAIL)
    {
        return self::build($code, $msg, $data);
    }

    /**
     * 构造RCP的业务返回对象
     * @param $response
     */
    public static function load($response)
    {
        $data = [];
        $code = self::CODE_OK;
        $msg  = self::MSG_OK;
        if (is_string($data)){
            $data = $response;
        }
        $instance = new self();
        $instance->data = [
            self::FIELD_CODE => $code,
            self::FIELD_MESSAGE => $msg,
            self::FIELD_DATA => $data,
        ];
    }

    /**
     * 判断返回状态码是否正常
     * @return bool
     */
    public function isOk()
    {
        return Arrays::getValue($this->data, self::FIELD_CODE) == self::CODE_OK;
    }

    /**
     * 判断返回状态码是否异常
     * @return bool
     */
    public function isFail()
    {
        return Arrays::getValue($this->data, self::FIELD_CODE) == self::CODE_FAIL;
    }

    /**
     * 返回消息体
     * @return bool
     */
    public function getMsg()
    {
        return Arrays::getValue($this->data, self::FIELD_MESSAGE, '');
    }

    /**
     * 返回数据体
     * @return bool
     */
    public function getData()
    {
        return Arrays::getValue($this->data, self::FIELD_DATA, []);
    }
}