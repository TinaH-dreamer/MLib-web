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
        	<li><a href="adm_books.php">库存管理</a></li>
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
    		echo "<p>添加书目</p>";
    	?>
    </div>
    <?php 
    	//表单，action写出了提交表单后要跳转的页面，并且传递了当前操作的名称以及当前表名，method表示用post方法提交
		echo "<form action='adm_books.php?act=add&name=".$tablename."' method='post'>";
	?>
    <table class="me">
		<tbody>	
			<?php
				for($i = 0; $i < 5; $i++) {
					echo "<tr>";
					echo "<td></td>";
					switch ($i) {
						case '0': echo "<td>编号</td><td><input type='text' class='editText' name='bid'></td>"; break;
						case '1': echo "<td>书名</td><td><input type='text' class='editText' name='bname'></td>"; break;
						case '2': echo "<td>作者<td><input type='text' class='editText' name='bauthor'></td></td>"; break;
						case '3': echo "<td>位置</td><td><input type='text' class='editText' name='bloc'></td>"; break;
						case '4': echo "<td>状态</td><td><select name='bstate'><option value='' style='display: none'>请选择</option><option value='0'>在库</option><option value='1'>借出</option></select></td>";break;
					}
					echo "<td></td>";
					echo "</tr>";
				}
			?>
		</tbody>
	</table>
	<div class="box_p">
		<p>
			<?php 
				//button标签的type设置为submit用于提交表单
				echo "<a href='adm_books.php'><button type='button' class='deleteTable-button'>返回</button></a> ";
				echo "<button type='submit' class='addData-button'>添加</button>";
			?>
		</p>
	</div>
	</form>
</div>
</div>
</body>
</html>