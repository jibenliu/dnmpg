<?php
//实现多线程必须继承Thread类
class test extends \Thread {
    public function __construct($arg){
        $this->arg = $arg;
    }
 
    //当调用start方法时，该对象的run方法中的代码将在独立线程中异步执行。
    public function run(){
        if($this->arg){
            printf("Hello %s\n", $this->arg);
        }
    }
}
$thread = new test("World");
 
if($thread->start()) {
    //join方法的作用是让当前主线程等待该线程执行完毕
    //确认被join的线程执行结束，和线程执行顺序没关系。
    //也就是当主线程需要子线程的处理结果，主线程需要等待子线程执行完毕
    //拿到子线程的结果，然后处理后续代码。
    $thread->join();
}
exit;
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