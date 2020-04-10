<?php
/**
 * Created by PhpStorm.
 * User: MorBro
 * Date: 2020/4/9
 * Time: 17:59
 * Desc: 用于AES加解密数据
 */
class AES
{
    protected $cipher = MCRYPT_RIJNDAEL_256; //AES加密算法
    protected $mode = MCRYPT_MODE_CBC; //采用cbc加密模式
    protected $key; //密钥
    protected $iv; //cbc模式加密向量，如为空将采用密钥代替
    /**
     * AES constructor.
     *
     * @param  string $key 密钥
     * @param null $iv 向量 可选 如为空将采用密钥代替
     *
     * @throws Exception
     */
    public function __construct($key, $iv = NULL)
    {
        if (!extension_loaded("mcrypt")) {
//      throw new \Exception("mcrypt extension do not exist. it was DEPRECATED in PHP 7.1.0, and REMOVED in PHP 7.2.0. use OpenSSL instead");
        }
        $this->key = $key;
        $this->iv = $iv;
    }
    /**
     * 加密数据
     * @param $data
     *
     * @return string
     */
    public function encrypt($data)
    {
        $td = mcrypt_module_open($this->cipher, '', $this->mode, '');
        $key = hash("sha256", $this->key, true);
        $iv = isset($this->iv) ? hash("sha256", $this->iv, true) : $key;
        $data = $this->padding($data);
        mcrypt_generic_init($td, $key, $iv);
        $encryptedData = base64_encode(mcrypt_generic($td, $data));
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        return $encryptedData;
    }
    /**
     * 解密数据
     * @param $data
     *
     * @return bool|string
     */
    public function decrypt($data)
    {
        $td = mcrypt_module_open($this->cipher, '', $this->mode, '');
        $key = hash("sha256", $this->key, true);
        $iv = isset($this->iv) ? hash("sha256", $this->iv, true) : $key;
        mcrypt_generic_init($td, $key, $iv);
        $decrypted_data = mdecrypt_generic($td, base64_decode($data));
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        return $this->unPadding($decrypted_data);
    }
    /**
     * 填充数据到分组大小的整数倍
     * @param null $data
     *
     * @return string
     */
    protected function padding($data = null)
    {
        $blockSize = 32; //MCRYPT_RIJNDAEL_256算法的分组大小是32字节
        $pad = $blockSize - (strlen($data) % $blockSize);
        return $data . str_repeat(chr($pad), $pad);
    }
    /**
     * 去掉填充的数据
     * @param null $data
     *
     * @return bool|string
     */
    protected function unPadding($data = null)
    {
        $pad = ord($data[strlen($data) - 1]);
        if ($pad > strlen($data)) {
            return false;
        }
        if (strspn($data, chr($pad), strlen($data) - $pad) != $pad) {
            return false;
        }
        return substr($data, 0, -1 * $pad);
    }
    /**
     * @return mixed
     */
    public function getSecretKey()
    {
        return $this->key;
    }
    /**
     * @param mixed $key
     */
    public function setSecretKey($key)
    {
        $this->key = $key;
    }
    /**
     * @return null
     */
    public function getIv()
    {
        return $this->iv;
    }
    /**
     * @param null $iv
     */
    public function setIv($iv)
    {
        $this->iv = $iv;
    }
}


?>