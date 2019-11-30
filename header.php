<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="css/navigationStyle.css">
    <link rel="stylesheet" type="text/css" href="css/font.css">
    <link rel="stylesheet" type="text/css" href="css/tableStyle.css">
    <link rel="stylesheet" type="text/css" href="css/editTextStyle.css">
    <link rel="stylesheet" type="text/css" href="css/panel.css">
</head>
<body>
    <div class="header">
    	<p><a><img src="sign.png" height="45px"></a></p>
    </div>
    <div class="menu">
        <ul>
        	<li><a>用户管理</a></li>
        	<li><a class="active" href="adm.php">库存管理</a></li>
        	<li><a>借阅管理</a></li>
        	<li><a>捐书管理</a></li>
        </ul>
    </div>
    <?php 
    	include ("conn.php");
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
    <div class="content">