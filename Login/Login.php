<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta name="viewport"
          content="width=device-width">
    <link rel="stylesheet" href="login.css">
    <title>管理员登录页面</title>
</head>


<?php

    $logInfo='';
    //$logInfo='<span style="color: red;">Please enter username</span>';
    $logIndex = 1;
    $time=(int)date("H");


    $username=$_POST['Username'] ?? '';
    $password=$_POST['Password'] ?? '';

    //正则识别
    $user_pattern='/^[a-zA-Z0-9]+$/S';
    $pwd_pattern='/^\w{8,16}$/S';

    if(!empty($username)) {
        if (preg_match($user_pattern, $username)) {
            $logIndex = 2;
        }else{
            $logIndex = 0;
        }
    }

    if(!empty($password)){
        if(preg_match($pwd_pattern,$password)){
            $logIndex = 2;
        }else{
            $logIndex = 0;
        }
    }

    if($logIndex=0){
        $logInfo = '<span style="color: red; ">Failed</span>';
    }else if($logIndex=2){
        $logInfo = '';
    }else{
        $logInfo = '<span style="color: green; ">Succeed</span>';
    }

    $servername = "localhost";
    $uname = "MuseumSystem";
    $pwd = "imadmin";
    $dbname = "MuseumSystem";

    $conn = new mysqli($servername,$uname,$pwd,$dbname);
    if($conn->connect_error){
        die("Error:".$conn->connect_error);
        $conn_index=-1;
    }else{
        $conn_index=1;
        echo "<span style='color: green'>SQL Linked Successfully</span>";
    }

    if($conn_index>0){
        $sql = "SELECT uname,upassword,level FROM `user`";
        $result = $conn->query($sql);

        $logIndex=0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row["uname"] == $username && $row["upassword"] == $password && $row["level"] == 3) {
                    $logIndex = 1;
                    header("location:https://github.com/BUCT-JK1804-SoftwareEngineering-Museum/Background-Management-Subsystem");
                }
            }
            if(!empty($username)&&!empty($password)&&$logIndex==0)
                echo "<script>alert('Failed')</script>";
        }
    }



?>


    <body>
    <form method="post" action="" class="login">
        <p>Login</p>
        <input type="text" name="Username" placeholder="Username">
        <input type="password" name="Password" placeholder="Password">
        <input type="submit" class="btn" value="Submit">
        <br><?php echo $logInfo?>
    </form>
    </body>


</html>