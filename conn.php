<?php 
$hostname = "localhost"; 		//主机名,可以用IP代替
$database = "library"; 			//数据库名
$username = "root"; 			//数据库用户名
$password = ""; 				//数据库密码
$conn = @mysqli_connect($hostname, $username, $password, $database);		//连接数据库
@mysqli_set_charset($conn,"utf8");
if(!$conn)
{
    echo '数据库连接失败:';
}
?> 