<div class="header">
    <p><a><img src="img/sign.png" height="45px"></a></p>
</div>
<div class="menu">
    <ul>
        <li><a href = "mydonate.php">捐书</a></li>
        <li><a href = "myborrow.php">我的借阅</a></li>
        <li><a href = "mycart.php">我的书篮</a></li>
        <li><a href = "viewbooks.php">查询图书</a></li>
    </ul>
</div>
<?php 
public $hostname = "localhost";        //主机名,可以用IP代替
public $database = "library";          //数据库名
public $username = "root";             //数据库用户名
public $password = "";                 //数据库密码
public $conn = @mysqli_connect($hostname, $username, $password, $database);        //连接数据库
@mysqli_set_charset($conn,"utf8");
if(!$conn)
{
    echo '数据库连接失败:';
}
 mysqli_query($conn,"set names utf-8");
    header("Content-type: text/html;charset=utf-8");
    $index = 0;					//计数当前表属性数量
    $tablename = "books";
    $query = "desc ".$tablename;	//获取当前表的属性
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    while($row = mysqli_fetch_row($res)) {	//遍历属性，找到主码
        if($row[3] == "PRI"){		//如果是主码，记录其属性名以及编号，便于之后操作使用
            $pri = $row[0];
            $priNum = $index;
        }
        $index++;
    }
?>