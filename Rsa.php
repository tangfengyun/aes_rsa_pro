<?php
include_once "./secret/RSA.class.php";
/**
 * Created by PhpStorm.
 * User: MorBro
 * Date: 2020/4/9
 * Time: 18:19
 * Desc: RSA加密/解密/签名/验签
 */

/**
 * 公私钥文件
 */
const PRIVATE_KEY_FILE = __DIR__ . "/cert/private_key.pem";
const PUBLIC_KEY_FILE = __DIR__ . "/cert/public_key.pem";

class Rsa {


    /**
     * @var RSA
     */
    private $rsa;

    /**
     * @var string 公钥
     */
    private $public_key_file =  PUBLIC_KEY_FILE;

    /**
     * @var string 私钥
     */
    private $private_key_file = PRIVATE_KEY_FILE;



    public function __construct()
    {
        $this->rsa = new RSA();
        $this->init();
    }

    /**
     * 初始化公私钥
     */
    private function init()
    {
        // 没有就生成一对
        if (!file_exists($this->private_key_file) || !file_exists($this->public_key_file)) {
            $key = $this->rsa->generate();

            file_put_contents($this->private_key_file, $key['private_key'], LOCK_EX);
            file_put_contents($this->public_key_file, $key['public_key'], LOCK_EX);
        } else {
            $key = [
                "private_key" => file_get_contents($this->private_key_file),
                "public_key" => file_get_contents($this->public_key_file)
            ];
        }

        //初始化后，读取公钥和私钥
        $this->rsa->init($this->public_key_file,$this->private_key_file);

        return $key;
    }

    /**
     * @desc 加密
     * @param string $data
     * @return string
     */
    public function encrypt($data)
    {
        return $this->rsa->encrypt($data);
    }

    /**
     * @desc 解密
     * @param string $encrypt
     * @return string
     */
    public function decrypt($encrypt)
    {
        return $this->rsa->decrypt($encrypt);
    }

    /**
     * @desc 生成签名
     * @param string $data
     * @return bool|string
     */
    public function sign($data)
    {
        return $this->rsa->sign($data);
    }

    /**
     * @desc 验证签名
     * @param string $data
     * @param string $sign
     * @return bool
     */
    public function verify($data,$sign)
    {
        return $this->rsa->verify($data,$sign);
    }
}