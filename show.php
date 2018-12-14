<?php
    header("content-type:text/html; charset=utf-8");
    $id = $_COOKIE['id'];
    $username = $_COOKIE['username'];
    $conn = new mysqli('localhost','root','root','biaobaiqiang');
    $cpage = isset($_REQUEST['p'])?$_REQUEST['p']:1;
    if($cpage<1)
    {
        $cpage=1;
    }
    $records = mysqli_num_rows(mysqli_query($conn,'select * from message'));
    $ptotal = floor($records/4);
    if($records%4>0)
    {
        $ptotal++;
    }
    if($cpage>=$ptotal){
        $cpage = $ptotal;
    }
    $sql = sprintf("select * from message limit %d,4",($cpage-1)*4);
    $result = mysqli_query($conn,$sql);
    $message = array();
    while(($row = @mysqli_fetch_array($result)) != false)
    {
        $message[] = $row;
    }
?>
<html>
    <body>
        <div align='center'><a href='qubiaobai.php'>去表白</a></div>
        <div align='center'><a href='myshow.php'>我的表白</a></div>
        <table border="1" width=1000 bgcolor="#fffaf0">
            <?php
                foreach($message as $row){
            ?>
            <tr>
            <td><?=$row['author']?>的表白：</td>
            <td><?=$row['content']?><br/>
            <hr/>回复：<br/>
            <?php
                $sarr = @explode('####',$row['reply']);
                foreach($sarr as $str)
                {
                    echo $str."<br/>";
                 }
            ?>
            </td>
            <td>
                <form action="tijiaohuifu.php" method="post">
                    <input type="hidden" name="id" value="<?=$row['id']?>"/>
                    回复：<textarea name="reply"></textarea><input type="submit" value="回复"/>
                </form>
            </td>
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