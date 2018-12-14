<?php
    header("content-type:text/html; charset=utf-8");
    $conn = new mysqli('localhost','root','root','biaobaiqiang');
    $message['username0'] = $_REQUEST['username'];
    $message['password1'] = $_REQUEST['password1'];
    $message['password2'] = $_REQUEST['password2'];
    $x = 1;
    if($message['username0']==null)
    {
	    echo '<script>alert("账号不能为空");window.location.href="zhuce.php"</script>';
	    $x = 0;
    }
    if($message['password1']!=$message['password2'])
    {
	    echo '<script>alert("两次输入密码不一致，请重新输入");window.location.href="zhuce.php"</script>';
	    $x = 0;
    }
    if($message['password1']==null)
    {
	    echo '<script>alert("密码不能为空");window.location.href="zhuce.php"</script>';
	    $x = 0;
    }
    $sql = sprintf("select count(*) from user where username = '".$message['username0']."'");
    $result = mysqli_query($conn,$sql);
    $num = mysqli_fetch_array($result,MYSQLI_NUM);
    if($num[0]!=0)
    {
	    echo '<script>alert("账号已存在");window.location.href="zhuce.php"</script>';
	    $x = 0;
    }
    if($x)
    {
	    $sql2 = sprintf("insert into user value(null,'%s','%s')",$message['username0'],md5($message['password1']));
        $conn->query($sql2);
        echo '<script>alert("注册成功");window.location.href="denglu.php"</script>';
    }
?>