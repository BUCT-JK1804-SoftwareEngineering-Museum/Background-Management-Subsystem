<?php
date_default_timezone_set('Asia/Hong_Kong');  //set time zone
set_error_handler("myHandler");               //set error handler
$chinatime = date('Y-m-d H:i:s');             //get current time
$max_size = 500000;

try
{
    $content = "Hello WeiXin!";
    logger2($content);
    //throw new Exception("Value must be 1 or below aaaaaaaaaaaaaaaaaaa");
}
catch(Exception $e)
{
    logger2("Exception Message: ".$e->getMessage());
}

//record operation log into .log file
function logger($log_content)
{
    print_r(date('H:i:s')." ".$log_content."<br />");
    $log_filename = date("Ymd").".log"; 
    $file = fopen($log_filename ,"a+");
    fwrite($file, date('H:i:s')." ".$log_content."\r\n");
    fclose($file);
}
//record operation log into .log file
function logger2($log_content)
{
    Global $max_size;   
    print_r(date('H:i:s')." ".$log_content." "."<br />");
    $log_filename = date("Ymd").".log";
    if(file_exists($log_filename) and (abs(filesize($log_filename)) > $max_size)){unlink($log_filename);sleep(1);}
    file_put_contents($log_filename, date('H:i:s')." ".$log_content." "."\r\n", FILE_APPEND);
}
//error handler function
function myHandler($level, $message, $file, $line, $context)
{
    logger("<b>[ERROR]</b> LEVEL: $level, MESSAGE: $message, FILE: $file, LINE: $line, CONTENT: $context");
    die();
}


?>