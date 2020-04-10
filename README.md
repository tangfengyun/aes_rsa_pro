#### 说明
```$xslt
 这个项目是关于AES和RSA加密的原生封装。你可以很轻松的调用里面的方法
```
#### 使用
-   1.参考方法
```$xslt
参考事例文本在text.php中，你可以根据事例调用并生成相关数据
```
-   2.aes相关方法
```$xslt
//加密密钥
$key = 'hello-world';
$aes = new Aes($key);
//要加密的数据
$data = "xiaoleilei";
//加密
$encryptAes =  $aes->encrypt($data);
//解密
$decryptAes = $aes->decrypt($encryptAes);
```
-   3.rsa相关方法
```$xslt
$rsa = new Rsa();
//要加密的数据
$data = "xiaoleilei";
//加密
$encrypt = $rsa->encrypt($data);
//解密
$decrypt = $rsa->decrypt($encrypt);
//签名
$sign = $rsa->sign($data);
//验签
$verify = $rsa->verify($data, $sign);
```
