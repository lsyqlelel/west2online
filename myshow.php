<?php
    header("content-type:text/html; charset=utf-8");
    $username = $_COOKIE['username'];
    $conn = new mysqli('localhost','root','root','biaobaiqiang');
    $cpage = isset($_REQUEST['p'])?$_REQUEST['p']:1;
    if($cpage<1)
    {
	    $cpage=1;
    }
    $sql0 = sprintf("select * from message where author = '".$username."'",($cpage-1)*4);
    $result = mysqli_query($conn,$sql0);
    $records = mysqli_num_rows($result);
    $ptotal = floor($records/4);
    if($records%4>0)
    {
	    $ptotal++;
    }
    if($cpage>=$ptotal)
    {
	    $cpage = $ptotal;
    }
    $message = array();
    while(($row = @mysqli_fetch_array($result)) != false)
    {
	    $message[] = $row;
    }
?>

<html>
    <body>
        <div align='center'><a href='qubiaobai.php'>去表白</a></div>
        <div align='center'><a href='show.php'>所有表白</a></div>
        <table border="1" width=1000 bgcolor="#fffaf0">
            <?php
                foreach($message as $row){
            ?>
            <tr>
                <td><?=$row['content']?></td>
                <td><a href="javascript:if(confirm('确认删除?')){location('delete.php?id=<?=$row['id']?>')}">删除</a></td>
            </tr>
            <?php
                }
            ?>
        </table>
        <table border="1" width=500 bgcolor="#fffaf0">
            <tr>
                <td>共<?=$records?>条表白 共<?=$ptotal?>页 当前第<?=$cpage?>页
                    <a href="show.php?p=1">首页</a>
                    <a href="show.php?p=<?=($cpage-1)?>">上一页</a>
                    <a href="show.php?p=<?=($cpage+1)?>">下一页</a>
                    <a href="show.php?p=<?=$ptotal?>">尾页</a>
                </td>
            </tr>
        </table>
    </body>
</html>