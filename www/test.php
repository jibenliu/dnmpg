<?php
$a = '13455555555555555555555555555555555555555555555555555555555555555555555555000003333';
var_dump($a);
exit;
$firstname = "Bill";
$lastname = "Gates";
$age = "60";

$result = compact("firstname", "lastname", "age");
print_r($result);
exit;
//实现多线程必须继承Thread类
// class test extends \Thread {
//     public function __construct($arg){
//         $this->arg = $arg;
//     }
 
//     //当调用start方法时，该对象的run方法中的代码将在独立线程中异步执行。
//     public function run(){
//         if($this->arg){
//             printf("Hello %s\n", $this->arg);
//         }
//     }
// }
// $thread = new test("World");
 
// if($thread->start()) {
//     //join方法的作用是让当前主线程等待该线程执行完毕
//     //确认被join的线程执行结束，和线程执行顺序没关系。
//     //也就是当主线程需要子线程的处理结果，主线程需要等待子线程执行完毕
//     //拿到子线程的结果，然后处理后续代码。
//     $thread->join();
// }
// exit;
/*** ------------------------------pcntl无法在web环境下运行-------------------
$pid = pcntl_fork();
if ($pid == -1)
{
    die("could not fork");
}
elseif($pid == 0)
{
    echo "I'm the child  process \n";
}
else
{
    echo "I'm the parent process \n";
    exit;
}
exit;
--------------------***************/
phpinfo();
exit;
$str = '2018073029962282';
function modString($str, $mod = 32)
{
    $md5_string = md5($str);
    $ten_string = base_convert($md5_string, 16, 10);
    $short_string = substr($ten_string, 0, 8);
    return $short_string % $mod;
}
echo modString($str, 32);
exit;
$str = '{"code":200,"data":{"id":"1","username":"admin","nickname":"admin","token":"e758bf69620c3aa8632317fbeb36aa63","auth_key":"smTdQn01HjwaXlZzy5HbhIsSG90PztQn","email":"168648614qq@qq.com","mobile":"13333333335","type":"1","tax_code":null,"source":"","created_at":"1507625769","updated_at":"1531207686","creator":null,"pid":"0","is_new":"0","status":"1"},"msg":"OK"}';
var_dump(json_decode($str,true));
var_dump(json_last_error());
exit;
$url = 'https://einvoicelink.51fapiao.cn:8181/FPFX/actions/98ff520219b8c2cc40bed84a512dfee88971b8';
var_dump(pathinfo($url));
exit;
function disposeTradeNo($b_trade_no, $g_trade_no)
    {
        if ($b_trade_no == null) {
            return -1;
        }
        if ($g_trade_no == null || !is_numeric($g_trade_no) || strlen($g_trade_no) != 32) {
            return -2;
        }
        $date_part = substr($g_trade_no, 0, 8);
        $client_id_part = (int)substr($g_trade_no, 8, 10);
        if (!is_date($date_part) || !is_numeric($client_id_part)) {
            return -3;
        }
        $cur_date = substr($g_trade_no, 0, 6);
        $return_data = array(
            'data_base_name' => $client_id_part,
            'table_name' => $cur_date,
            'relation_table_name' => $cur_date,
            'b_trade_no' => $b_trade_no,
            'g_trade_no' => $g_trade_no,
        );
        return $return_data;

    }

    function is_date($val)
    {
        $result = true;
        $unixTime = strtotime($val);
        //转换时间戳错误，日期格式则不对。
        if (!$unixTime) {
            $result = false;
        }
        //校验日期的有效性
        if (date('Y-m-d', $unixTime) != $val && date('Ymd', $unixTime) != $val && date('Y-m-d H:i:s', $unixTime) != $val) {
            $result = false;
        }
        return $result;
    }
var_dump(disposeTradeNo('gp_20180428154741_44_135_23523','20180428000000025315249016737320'));
var_dump(253%16);
exit;

$arr = ['a'=>[1,3,4,5],'b'=>[5,7,8,9]];
var_dump(array_keys($arr));
var_dump(array_values($arr));
exit;
function generateTree($items){
    $tree = array();
    foreach($items as $item){
        if(isset($items[$item['pid']])){
            $items[$item['pid']]['son'][] = &$items[$item['id']];
        }else{
            $tree[] = &$items[$item['id']];
        }
    }
    return $tree;
}
$items = array(
    1 => array('id' => 1, 'pid' => 0, 'name' => '安徽省'),
    2 => array('id' => 2, 'pid' => 0, 'name' => '浙江省'),
    3 => array('id' => 3, 'pid' => 1, 'name' => '合肥市'),
    4 => array('id' => 4, 'pid' => 3, 'name' => '长丰县'),
    5 => array('id' => 5, 'pid' => 1, 'name' => '安庆市'),
);
print_r(generateTree($items));
exit;
function test()
{
    echo '<pre>';
    var_dump(getopt('code:name:'));
}
test(['code'=>'abcd','name'=>1111]);
test(['code'=>'abcd']);
test(['name'=>'12132']);
exit;
var_dump(strlen('3a7b08bb8e6dbce3c9671d6fdb69d15066227608'));
exit;
function getMonthExpand($start, $end)
    {
        $start = strtotime($start);
        $end = strtotime($end);
        $temp = $start;
        $arr = [];
        while ($temp <= $end) {
            $arr[] = date('Y-m', $temp);
            $temp = strtotime(date('Ymt', $temp)) + 24 * 3600;
        }
        rsort($arr);
        return $arr;
    }
var_dump(getMonthExpand('2018-04','2018-05'));
exit;
$a = '999999999999999999999.99';
$b = '56.01';
$c = bcmul($a, $b);
$c=preg_replace("/\..*0+$/",'',$c);
var_dump($c);
exit;
// $a = 6666666666666;
var_dump(bccomp($a, 99999999, 14));
exit;
function numToStr($num)
    {
        if (stripos($num, 'e') === false) return $num;
        $num = trim(preg_replace('/[=\'"]/', '', $num, 1), '"');//出现科学计数法，还原成字符串
        $result = "";
        while ($num > 0) {
            $v = $num - floor($num / 10) * 10;
            $num = floor($num / 10);
            $result = $v . $result;
        }
        return $result;
    }

echo numToStr(8.7377766990291E+5);
exit;

$tax_no_list = [1111111111111111112,2222222222,3333333,'asdasdasd12312'];
function stringType($v)
{
    return strval($v);
}
var_dump(array_map('stringType', $tax_no_list));
exit;
$str = '江苏省洪泽县高良涧镇大庆中路1-3号';
$arr = explode('省', $str);
if (isset($arr[1])) {
    $province = $arr[0] . '省';
    $temp = explode('市', $arr[1]);
    if(count($temp)>=2){
    	$city = $temp[0] . '市';
    	$arr = explode('区', $temp[1]);
    	$area = $arr[0] . '地区';
    }else{
    	$temp = explode('县', $arr[1]);
    	$city = $temp[0] . '县';
    	$arr = explode('区', $temp[1]);
    	$area = $arr[0] . '地区';
    }    
} else {
    $tmp = explode('市', $arr[0]);
    $province = $tmp[0] . '省';
    $city = $tmp[0] . '市';
    $arr = explode('区', $tmp[1]);
    $area = $arr[0] . '地区';
}
var_dump($province);
var_dump($city);
var_dump($area);
exit;
$str = 'eyJEYXRhIjoiPD94bWwgdmVyc2lvbj1cIjEuMFwiIGVuY29kaW5nPVwiVVRGLThcIj8+XG48TVNH
PjxIRUFEPjxGUExYPjAxPC9GUExYPjxGUERNPjUxMDAxNzIxMzA8L0ZQRE0+PEZQSE0+MDM0OTI5
NDE8L0ZQSE0+PEtQUlE+MjAxNzEyMTk8L0tQUlE+PEZQSkU+MTE2NDYuMTg8L0ZQSkU+PEpZTT48
L0pZTT48Q1lKR0RNPjAwMTwvQ1lKR0RNPjwvSEVBRD48Qk9EWT48RlBETT41MTAwMTcyMTMwPC9G
UERNPjxGUEhNPjAzNDkyOTQxPC9GUEhNPjxDWUNTPjE8L0NZQ1M+PEtQUlE+MjAxNzEyMTk8L0tQ
UlE+PEdGTUM+6LS15bee6auY5pyL5b6u6KGM56eR5oqA5pyJ6ZmQ5YWs5Y+4PC9HRk1DPjxHRlNC
SD45MTUyMDkwME1BNkU3VDIzNTg8L0dGU0JIPjxHRkRaREg+6LS15bee55yB6LS15a6J5paw5Yy6
5aSn5a2m5Z+O6LS15a6J5pWw5a2X57uP5rWO5Lqn5Lia5ZutOeWPt+alvDnlsYIx5Y+3MTg2ODIw
MDY5NzA8L0dGRFpESD48R0ZZSFpIPuS4reWbvemTtuihjOiCoeS7veaciemZkOWFrOWPuOi0teWu
ieaWsOWMuuaUr+ihjDEzMjA1MDk0NjY5ODwvR0ZZSFpIPjxYRk1DPuaIkOmDveS6rOS4nOS4lue6
qui0uOaYk+aciemZkOWFrOWPuDwvWEZNQz48WEZTQkg+OTE1MTAxMDc2OTg4Njg4MDRKPC9YRlNC
SD48WEZEWkRIPuaIkOmDveW4guatpuS+r+WMuuenkeWNjuWMl+i3rzY15Y+35Zub5bed5aSn5a2m
5Zu96ZmF5a2m5pyv5Lqk5rWB5Lit5b+D77yI5LiW5aSW5qGD5rqQ5bm/5Zy677yJQULmoIsxNuWx
giA2NTk3Njc5ODwvWEZEWkRIPjxYRllIWkg+5Lit5Zu95bu66K6+6ZO26KGM6IKh5Lu95pyJ6ZmQ
5YWs5Y+45oiQ6YO956ys5LqM5pSv6KGMNTEwMDE0MjYyMDgwNTE1MDY5NjY8L1hGWUhaSD48SkU+
MTE2NDYuMTg8L0pFPjxTRT4xOTc5LjgyPC9TRT48SlNISj4xMzYyNjwvSlNISj48Qlo+enA2MzQz
MjcwNTI4MCgwMDAwMSw3MDA5Nzc5Nzg1OCk8L0JaPjxKUUJIPjY2MTUzNTYyMjUyNTwvSlFCSD48
SllNPjg0NzExMjkyOTI0MDQ2NjQxNTc1PC9KWU0+PFpGQlo+TjwvWkZCWj48Q1BZQlo+TjwvQ1BZ
Qlo+PENZU0o+MjAxOC0wNS0yMyAyMDoxNToxMjwvQ1lTSj48Q0hJTERMSVNUPjxDSElMRD48SFdN
Qz4o6K+m6KeB6ZSA6LSn5riF5Y2VKTwvSFdNQz48R0dYSD4gPC9HR1hIPjxEVz4gPC9EVz48U0w+
IDwvU0w+PERKPiA8L0RKPjxKRT4xMTY0Ni4xODwvSkU+PFNMVj4xNzwvU0xWPjxTRT4xOTc5Ljgy
PC9TRT48L0NISUxEPjxDSElMRD48SFdNQz7prYXml48g6a2F6JOdIE5vdGU2IDNHQisxNkdCIOWF
qOe9kemAmuWFrOW8gOeJiCDlrZTpm4DpnZIg56e75Yqo6IGU6YCa55S15L+hNEfmiYvmnLog5Y+M
5Y2h5Y+M5b6FPC9IV01DPjxHR1hIPumtheiTnSBOb3RlNjwvR0dYSD48RFc+5LiqPC9EVz48U0w+
MTwvU0w+PERKPjkzOS4zMTYyMzkzMTYyMzkzPC9ESj48SkU+OTM5LjMyPC9KRT48U0xWPjE3PC9T
TFY+PFNFPjE1OS42ODwvU0U+PC9DSElMRD48Q0hJTEQ+PEhXTUM+5oi05bCU77yIREVMTO+8iSBQ
MjMxN0ggMjPoi7Hlr7jml4vovazljYfpmY1JUFPlsY/mmL7npLrlmajvvIjluKZEUOe6v++8iTwv
SFdNQz48R0dYSD5QMjMxN0g8L0dHWEg+PERXPuS4qjwvRFc+PFNMPjM8L1NMPjxESj45ODIuMDUx
MjgyMDUxMjgyMTwvREo+PEpFPjI5NDYuMTU8L0pFPjxTTFY+MTc8L1NMVj48U0U+NTAwLjg1PC9T
RT48L0NISUxEPjxDSElMRD48SFdNQz7lsI/nsbM2IOWFqOe9kemAmiA0R0IrNjRHQiDkuq7pu5Ho
ibIg56e75Yqo6IGU6YCa55S15L+hNEfmiYvmnLog5Y+M5Y2h5Y+M5b6FPC9IV01DPjxHR1hIPuWw
j+exszY8L0dHWEg+PERXPuS4qjwvRFc+PFNMPjE8L1NMPjxESj4xOTY0Ljk1NzI2NDk1NzI2NTwv
REo+PEpFPjE5NjQuOTY8L0pFPjxTTFY+MTc8L1NMVj48U0U+MzM0LjA0PC9TRT48L0NISUxEPjxD
SElMRD48SFdNQz7ljY7kuLogUDkg5YWo572R6YCaIDNHQiszMkdC54mIIOa1geWFiemHkSDnp7vl
iqjogZTpgJrnlLXkv6E0R+aJi+acuiDlj4zljaHlj4zlvoU8L0hXTUM+PEdHWEg+UDk8L0dHWEg+
PERXPuS4qjwvRFc+PFNMPjE8L1NMPjxESj4yMDQxLjAyNTY0MTAyNTY0MTwvREo+PEpFPjIwNDEu
MDM8L0pFPjxTTFY+MTc8L1NMVj48U0U+MzQ2Ljk3PC9TRT48L0NISUxEPjxDSElMRD48SFdNQz7m
kanmiZjnvZfmi4koTW90b3JvbGEpQ0wxMDJD5pWw5a2X5peg57uz55S16K+d5py65bqn5py65a2Q
5q+N5py65Lit5paH5pi+56S65YWN5o+Q5aWX6KOF5Yqe5YWs5a6255So5LiA5ouW5LqM5Zu65a6a
5peg57q/5bqn5py6KDwvSFdNQz48R0dYSD5DTDEwMkM8L0dHWEg+PERXPuS4qjwvRFc+PFNMPjI8
L1NMPjxESj4zMDYuODM3NjA2ODM3NjA2ODwvREo+PEpFPjYxMy42ODwvSkU+PFNMVj4xNzwvU0xW
PjxTRT4xMDQuMzI8L1NFPjwvQ0hJTEQ+PENISUxEPjxIV01DPuW4jOaNtyhTRUFHQVRFKemFt+mx
vOezu+WIlyAyVEIgNzIwMOi9rDY0TSBTQVRBMyDlj7DlvI/mnLrmnLrmorDnoaznm5goU1QyMDAw
RE0wMDYpPC9IV01DPjxHR1hIPkJhcnJhQ3VkYTwvR0dYSD48RFc+5LiqPC9EVz48U0w+MTwvU0w+
PERKPjM0MS4wMjU2NDEwMjU2NDEwNTwvREo+PEpFPjM0MS4wMzwvSkU+PFNMVj4xNzwvU0xWPjxT
RT41Ny45NzwvU0U+PC9DSElMRD48Q0hJTEQ+PEhXTUM+5biM5o2377yIU0VBR0FURe+8iemFt+eO
qTFUQiA1NDAw6L2sIDEyOE0gU0FUQSAyLjXoi7Hlr7gg56yU6K6w5pysU1NIROWbuuaAgea3t+WQ
iOehrOebmCDmuLjmiI/noaznm5gg77yIU1QxMDAwTFgwMTwvSFdNQz48R0dYSD4xVEIgNTQwMOi9
rCAxMjhNIFNBPC9HR1hIPjxEVz7kuKo8L0RXPjxTTD4xPC9TTD48REo+NDA5LjQwMTcwOTQwMTcw
OTQ8L0RKPjxKRT40MDkuNDwvSkU+PFNMVj4xNzwvU0xWPjxTRT42OS42PC9TRT48L0NISUxEPjxD
SElMRD48SFdNQz7kuIPlvanombnvvIhDb2xvcmZ1bO+8iWlHYW1lMTA1MCDng4jnhLDmiJjnpZ5T
LTJHRDUgR1RYMTA1MCAxNDMwLTE1NDRNSHovNzAwME1IeiAyRy8xMjhiaXQgR0REUjUg5pi+5Y2h
PC9IV01DPjxHR1hIPmlHYW1lMTA1MCDng4jnhLDmiJjnpZ5TLTI8L0dHWEg+PERXPuS4qjwvRFc+
PFNMPjE8L1NMPjxESj43NjguMzc2MDY4Mzc2MDY4NDwvREo+PEpFPjc2OC4zODwvSkU+PFNMVj4x
NzwvU0xWPjxTRT4xMzAuNjI8L1NFPjwvQ0hJTEQ+PENISUxEPjxIV01DPuWwj+exsyDnuqLnsbNO
b3RlNFgg5YWo572R6YCa54mIIDNHQiszMkdCIOmmmeann+mHkSDnp7vliqjogZTpgJrnlLXkv6E0
R+aJi+acujwvSFdNQz48R0dYSD7nuqLnsbNOb3RlNFg8L0dHWEg+PERXPuS4qjwvRFc+PFNMPjE8
L1NMPjxESj44NTMuODQ2MTUzODQ2MTUzODwvREo+PEpFPjg1My44NTwvSkU+PFNMVj4xNzwvU0xW
PjxTRT4xNDUuMTU8L1NFPjwvQ0hJTEQ+PENISUxEPjxIV01DPuiNo+iAgCBWOSBwbGF5IOWFqOe9
kemAmiDmoIfphY3niYggM0dCKzMyR0Ig5bm75aSc6buRIOenu+WKqOiBlOmAmueUteS/oTRH5omL
5py6IOWPjOWNoeWPjOW+hTwvSFdNQz48R0dYSD7ojaPogIBWOSBwbGF5PC9HR1hIPjxEVz7kuKo8
L0RXPjxTTD4xPC9TTD48REo+NzY4LjM3NjA2ODM3NjA2ODQ8L0RKPjxKRT43NjguMzg8L0pFPjxT
TFY+MTc8L1NMVj48U0U+MTMwLjYyPC9TRT48L0NISUxEPjwvQ0hJTERMSVNUPjwvQk9EWT48L01T
Rz4iLCJNc2ciOiLlj5Hnpajmn6Xpqozmk43kvZzmiJDlip8iLCJDb2RlIjoiMDAwMCJ9';
$base64 = base64_decode($str);
$data = json_decode($base64,true);
echo '<pre>';
var_dump($data['Data']);
exit;
// $goods_info = $biz_content['goods_info'];
// var_dump($goods_info);
// exit;
// $aa = date('Y-m-d H:i:s',strtotime('2020/1/1'));
// $str = '{
//         "buyer_title_type":1,
//         "taxpayer_num":"91469027MA5RH09M0R",
//         "seller_name":"测试",
//         "b_unique_id":"200000001327144140800000013",
//         "buyer_title":"个人",
//         "buyer_address":"购买方地址",
//         "buyer_phone":"23823191831",
//         "buyer_bank_account":"6228124512451212",
//         "extra":"发票备注",
//         "result_call_back":"http://",
//         "cashier":"收款人",
//         "buyer_bank_name":"中国工商",
//         "checker":"复核人",
//         "invoicer":"开票人",
//         "trade_type":"3",
//         "etr_data":"哈哈哈，我还第一次听所呢 ",
//         "bureau_code":"GP430001",
//         "goods_info":[
//             {
//                 "name":"卤鸭翅【大盒】测试 0.13",
//                 "tax_code":"3050100000000000000",
//                 "tax_type":"natural_gas",
//                 "models":"规格型号",
//                 "unit":"盒力女 ",
//                 "total_price":10.5,
//                 "total":1,
//                 "price":10.5,
//                 "tax_rate":"0",
//                 "tax_amount":"0",
//                 "zero_tax_flag":1
//             },
//             {
//                 "name":"卤鸭翅【大盒】2测试 0.13",
//                 "tax_code":"3050100000000000000",
//                 "tax_type":"natural_gas",
//                 "models":"规格型号",
//                 "unit":"盒力女 ",
//                 "total_price":10.5,
//                 "total":1,
//                 "price":10.5,
//                 "tax_rate":"0",
//                 "tax_amount":"0",
//                 "zero_tax_flag":1
//             }
//         ]
//     }';
// //$data = json_decode($str,true);
// function http_post($url,$param,$content_type='form',$post_file=false){
//     $oCurl = curl_init();
//     if(stripos($url,"https://")!==FALSE){
//         curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, false);
//         curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
//         curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
//     }
//     if (PHP_VERSION_ID >= 50500 && class_exists('\CURLFile')) {
//         $is_curlFile = true;
//     } else {
//         $is_curlFile = false;
//         if (defined('CURLOPT_SAFE_UPLOAD')) {
//             curl_setopt($oCurl, CURLOPT_SAFE_UPLOAD, false);
//         }
//     }
//     if (is_string($param)) {
//         $strPOST = $param;
//     }elseif($post_file) {
//         if($is_curlFile) {
//             foreach ($param as $name => $filename) {
//                 if (function_exists('curl_file_create')) {
//                     $param[$name] = @curl_file_create($filename);
//                 }else{
//                     $param[$name] = "@$filename;filename=".basename($filename);
//                 }
//             }
//             version_compare(PHP_VERSION, '5.5', '>') || curl_setopt($oCurl, CURLOPT_SAFE_UPLOAD, false);
//         }
//         $strPOST = $param;
//     }elseif($content_type == 'json'){
//         $strPOST = json_encode($param,JSON_UNESCAPED_UNICODE+JSON_UNESCAPED_SLASHES);
//         curl_setopt($oCurl, CURLOPT_HTTPHEADER, array(
//             'Content-Type: application/json',
//             'Content-Length: '.strlen($strPOST))
//         );
//     }else{
//         $aPOST = array();
//         foreach($param as $key=>$val){
//             $aPOST[] = $key."=".urlencode($val);
//         }
//         $strPOST =  join("&", $aPOST);
//     }
//     curl_setopt($oCurl, CURLOPT_URL, $url);
//     curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
//     curl_setopt($oCurl, CURLOPT_POST,true);
//     curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);
//     $sContent = curl_exec($oCurl);
//     $aStatus = curl_getinfo($oCurl);
//     curl_close($oCurl);
//     return $sContent;
// }
// $result = http_post('http://10.98.6.12:8501/invoice/apply',$str,'json');
// echo '<pre>';
// print_r($result);

// $str = 'eyJEYXRhIjoiIiwiTXNnIjoiW+WuouaIt+erryhUZXN0MTUyMDgyNjgyMTkyMCnlpLHmlYhdIiwi\nQ29kZSI6IjAwMDQifQ==';
$baseStr = base64_decode($str);
var_dump($baseStr);
// $ret = json_decode($baseStr, true);
// var_dump($ret);
// exit;
// var_dump(1749%16);
// exit;
// function isPictureExists($url)
// {
// 	$arr = pathinfo($url);
// 	$host = parse_url($url);
// 	if(!empty($arr) && is_array($host) && preg_match('/^.*myqcloud.com$/i', $host['host'])){
// 		if(isset($arr['extension']) && in_array($arr['extension'], ['png','jpg','jpeg','gif'])){
// 			return true;
// 		}
// 	}
// 	return false;
// }

// var_dump(isPictureExists('http://kpserverdev-1251506165.cossh.myqcloud.com/identity-image/20180509/1525854563929614.png'));
// $res = is_file('http://img.zcool.cn/community/01c57657b516ea0000018c1b285a05.png@1280w_1l_2o_100sh.png');
// var_dump($res);
// exit;
// $str = '20180503000000191815253315755998';
// echo strlen($str);
/*
private static $_output;
public static function export($var)
{
    self::$_output = '';
    self::exportInternal($var, 0);
    return self::$_output;
}

public static function exportInternal($var, $level)
{
    switch (gettype($var)) {
        case 'NULL':
            self::$_output .= 'null';
            break;
        case 'array':
            if (empty($var)) {
                self::$_output .= '[]';
            } else {
                $keys = array_keys($var);
                $outputKeys = ($keys !== range(0, count($var) - 1));
                $spaces = str_repeat(' ', $level * 4);
                self::$_output .= '[';
                foreach ($keys as $key) {
                    self::$_output .= "\n" . $spaces . '    ';
                    if ($outputKeys) {
                        self::exportInternal($key, 0);
                        self::$_output .= ' => ';
                    }
                    self::exportInternal($var[$key], $level + 1);
                    self::$_output .= ',';
                }
                self::$_output .= "\n" . $spaces . ']';
            }
            break;
        case 'object':
            $output = 'unserialize(' . var_export(serialize($var), true) . ')';
            self::$_output .= $output;
            break;
        default:
            self::$_output .= var_export($var, true);
    }
}*/



/*$conn = mysqli_connect('115.159.76.132','devroot','devroot@123','title_manage');
$sql = 'SELECT `area_id`,`area_name`,`area_parent_id` FROM `wx_areas`';
$result = mysqli_query($conn,$sql);
$arr = mysqli_fetch_all($result,MYSQLI_ASSOC);
// $arr = mysqli_fetch_all($result,MYSQLI_NUM);
// $arr = mysqli_fetch_all($result,MYSQLI_BOTH);

function getTree($data, $pId=0)
{
$tree = [];
foreach($data as $k => $v)
{
  if($v['area_parent_id'] == $pId)
  {        //父亲找到儿子
   $v['area_parent_id'] = getTree($data, $v['area_id']);
   $tree[] = $v;
  }
}
return $tree;
}
file_put_contents('area.json', json_encode(getTree($arr),JSON_UNESCAPED_UNICODE));
exit;*/

// function modString($str, $mod = 32)
// {
//     $md5_string = md5($str);
//     $ten_string = base_convert($md5_string, 16, 10);
//     $short_string = substr($ten_string, 0, 8);
//     return $short_string % $mod;
// }

// var_dump(modString('2017120476902176'));
// exit;