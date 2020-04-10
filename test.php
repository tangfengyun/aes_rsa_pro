<?php
//引入rsa和ase类
include_once 'Rsa.php';
include_once 'Aes.php';


echo "<br/>";
echo "<br/> 这里是rsa加密解密验签和签名 <br/>";
$rsa = new Rsa();
//要加密的数据
$data = "xiaoleilei";
echo "<br/> 加密的数据：" . $data , "\n-------------------------------\n";

//加密
$encrypt = $rsa->encrypt($data);
echo "<br/> 公钥加密后的数据: " . $encrypt . "\n";

//解密
$decrypt = $rsa->decrypt($encrypt);
echo "<br/> 私钥解密后的数据: " . $decrypt, "\n-------------------------------\n";

//签名
$sign = $rsa->sign($data);
echo "<br/> 签名的数据: " . $sign . "\n";

//验证
$verify = $rsa->verify($data, $sign);
echo "<br/> 验证的数据: " . $verify . "\n", "\n-------------------------------\n";


echo "<br/>";
echo "<br/>";
echo "<br/> 这里是aes加密解密 <br/>";

$key = 'hello-world';//加密密钥
$aes = new Aes($key);
echo "<br/> 加密的数据：" . $data , "\n-------------------------------\n";

$encryptAes =  $aes->encrypt($data);
echo "<br/> 加密的aes数据: " .$encryptAes , "\n";

$decryptAes = $aes->decrypt($encryptAes);
echo "<br/> 解密的aes数据： " .$decryptAes ,"\n-------------------------------\n";

?>