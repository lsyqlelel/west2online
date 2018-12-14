<?php
    $conn = new mysqli('localhost','root','root','biaobaiqiang');
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
    $reply = $_REQUEST['reply'];
    $reply.="####" ;
    $sql = sprintf("update message set reply=concat(reply,'%s') where id=%d",$reply,$id);
    mysqli_query($conn,$sql);
    echo '<script>window.location.href="show.php"</script>';
?>