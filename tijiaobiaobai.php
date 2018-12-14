<?php
    header("content-type:text/html; charset=utf-8");
    $author = $_COOKIE['username'];
    $conn = new mysqli('localhost','root','root','biaobaiqiang');
    $message['content'] = $_REQUEST['content'];
    $sql = sprintf("insert into message value(null,'%s','%s',' ')",$message['content'],$author);
    $conn->query($sql);
    echo '<script>alert("表白成功");window.location.href="show.php"</script>';
?>