<?php
include_once "./secret/AES.class.php";
/**
 * Created
 * User: MorBro
 * Date: 2020/4/9
 * Time: 18:19
 * Desc: AES加密/解密
 */

class Aes
{

    /**
     * @var AES
     */
    private $aes;

    public function __construct($key)
    {
       $this->aes = new AES($key);
    }

    /**
     * @desc 加密
     * @param string $str
     * @return string
     */
    public function encrypt($str)
    {
        return $this->aes->encrypt($str);
    }


    /**
     * @desc 解密
     * @param string $str
     * @return bool|string
     */
    public function decrypt($str)
    {
        return $this->aes->decrypt($str);
    }



}