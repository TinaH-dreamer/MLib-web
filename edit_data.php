<!DOCTYPE html>
<?php
require "head.txt";
?>
<body>
    <div class="header">
    	<p><a><img src="img/sign.png" height="45px"></a></p>
    </div>
    <div class="menu">
        <ul>
            <li><a href="admdonate.php">捐书管理</a></li>
        	<li><a href="adm_borrow.php">借阅管理</a></li>
        	<li><a href="admbooks.php">库存管理</a></li>
        	<li><a href="admusers.php">用户管理</a></li>
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
<div class = "content">
<div class="box">
    <div class="box_p">
    	<?php 
    		echo "<p>更新数据</p>";
    	?>
    </div>
    <?php 
    	$id = $_GET['id'];		//传进的主码值
    	//表单，action写出了提交表单后要跳转的页面，并且传递了当前操作的名称、当前表名以及当前数据的主码值，method表示用post方法提交
		echo "<form action='adm_books.php?act=edit&name=".$tablename."&id=".$id."' method='post'>";
	?>
    <table class="me">
		<tbody>	
			<?php
				$query1 = "desc ".$tablename;
				$res1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
				$query2 = "select * from ".$tablename." where ".$pri."='".$id."';";		//获取当前主码值对应的属性值
				$res2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
				$dbrow2 = mysqli_fetch_array($res2);
				$row = mysqli_num_rows($res1);
				for($i = 0; $i < $row; $i++) {
					$dbrow1 = mysqli_fetch_array($res1);
					echo "<tr>";
					echo "<td></td>";
					switch ($i) {
						case '0': echo "<td>编号</td>"; break;
						case '1': echo "<td>书名</td>"; break;
						case '2': echo "<td>作者</td>"; break;
						case '3': echo "<td>位置</td>"; break;
						case '4': echo "<td>状态</td>"; break;
					}
					//value让文本框有默认数据，即原本属性值
					echo "<td><input type='text' class='editText' name='".$dbrow1[0]."' value='".$dbrow2[$i]."'></td>";
					echo "<td></td>";
					echo "</tr>";
				}
			?>
		</tbody>
	</table>
	<div class="box_p">
		<p>
			<?php 
				echo "<button type='submit' class='addData-button'>更新数据</button>";
			?>
		</p>
	</div>
	</form>
</div>
</div>
</body>
</html>