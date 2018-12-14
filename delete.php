<?php
    $conn = new mysqli('localhost','root','root','biaobaiqiang');
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
    $sql = "delete from message where id=".$id;
    mysqli_query($conn,$sql);
    echo '<script>window.location.href="myshow.php"</script>';
?>