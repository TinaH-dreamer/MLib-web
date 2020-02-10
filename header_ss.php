<!--
<div class="header">
    <p><a><img src="img/sign.png" height="45px"></a></p>
</div>
-->
<div style="margin-top:2.4rem;margin-bottom:1rem;margin-left:0.4rem;margin-right:0.6rem">
    <ul class="nav nav-tabs">
        <li class="disabled"><img src="img/sign.png" height="45px"></li>
    <ul class="nav nav-tabs navbar-right">
        <li class="active">
            <a href="viewbooks.php">查询图书</a>
        </li>
        <li>
            <a href="myborrow.php">我的借阅</a>
        </li>
        <li>
            <a href="mydonate.php">捐书</a>
        </li>
        <li>
            <a href="logout.php">退出登录</a>
        </li>
    </ul>
</div>
<!--
<div class="menu">
    <ul>
        <li><a href="logout.php" id="logout.php">退出登录</a></li>
        <li><a href="mydonate.php" id="mydonate.php">捐书</a></li>
        <li><a href="myborrow.php" id="myborrow.php">我的借阅</a></li>
        <li><a href="viewbooks.php" id="viewbooks.php">查询图书</a></li>
    </ul>
</div>
-->
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
<script type="text/javascript">
    var loc = window.location.pathname;
    document.getElementById(loc).classList.add('active');
</script>