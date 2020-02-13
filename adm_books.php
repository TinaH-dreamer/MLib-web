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
            <li><a href="adm_donate.php">捐书管理</a></li>
        	<li><a href="adm_borrow.php">借阅管理</a></li>
        	<li><a href="adm_books.php">库存管理</a></li>
        	<li><a href="adm_users.php">用户管理</a></li>
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
		<?php 
			$action = null;				//记录当前操作，有添加数据、删除数据、删除表格、编辑数据四种操作
			if(isset($_GET['act']))		//接收操作，表示当前操作
				$action = $_GET['act'];
			if($action == 'add') {			//添加数据操作
				$sql = "insert into ".$tablename." values(";		//插入数据的sql语句
				$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
				while($row = mysqli_fetch_row($res))
					$sql = $sql .'"'. $_POST[$row[0]] .'"'. ",";	//接收表单发送的数据写入到sql语句中
				$sql = rtrim($sql,",") .")";
				$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));		//数据库执行插入数据操作
			}
			if($action == 'deleteData') {	//删除数据操作
				$id = $_GET['id'];			//获取要删除数据的主码
				$sql = "delete from ".$tablename." where ".$pri."='".$id."';";	//编写sql语句，pri为主码属性名
				$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));	//数据库执行删除数据操作
			}
			if($action == 'edit') {			//编辑数据操作
				$id = $_GET['id'];			//获取要编辑数据的主码
				$sql = "update ".$tablename." set ";
				$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
				while($row = mysqli_fetch_row($res))
					$sql = $sql.$row[0]."='".$_POST[$row[0]]."',";	//接收表单发送的数据写入到sql与剧中
				$sql = rtrim($sql,",");
				$sql = $sql ." where ".$pri."='".$id."';";
				$res = mysqli_query($conn, $sql) or die(mysqli_error($conn)); //数据库执行编辑数据操作
			}
			$idorname = null;
			if(isset($_POST['number'])){
				$idorname = $_POST['number'];
			}
		?>
		<div class = "opbar">
		    <center>
		        <ul>
			        <form action="adm_books.php" method="post">
			        <li><input type="search" name="number" id="con" placeholder="按编号/书名查找"></li>
			        <li><button type="submit" name = "search" class = "button" style = "cursor:pointer">搜索</button></li>
			        </form>
		        </ul>
		    </center>
		</div>
	    <table class="mt">		<!-- 绘制表格 -->
			<thead>
				<tr>
					<td>编号</td>
					<td>书名</td>
					<td>作者</td>
					<td>位置</td>
					<td>状态</td>
					<td></td>
					</tr>
			</thead>
			<tbody>
				<?php
					if($idorname){
						$query = "select * from ".$tablename." where BName like '%".$idorname."%' or BId = '".$idorname."'";
					}
					else{
						$query = "select * from ".$tablename;	//获取当前表所有数据
					}
					$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
					while($row = mysqli_fetch_row($res)){
						echo "<tr>";
						echo "<td>".$row[0]."</td>";
						echo "<td>".$row[1]."</td>";
						echo "<td>".$row[2]."</td>";
						echo "<td>".$row[3]."</td>";
						if($row[4] == 0)
							echo "<td>在库</td>";
						else
							echo "<td>借出</td>";
						echo "<td><a href='edit_data.php?name=".$tablename."&id=".$row[$priNum]."'><button class='edit-button'>编辑</button></a> ";
						echo "<a href='admbooks.php?act=deleteData&name=".$tablename."&id=".$row[$priNum]."'><button class='delete-button'>删除</button></a></td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
		<div class="box_p">
			<p>
				<?php 
					//表格下方添加添加数据与删除表格的按钮，点击可以跳转到添加数据界面或者删除该表后的显示表格界面，添加数据与删除表格操作都会发送表名，删除表格操作还会发送当前操作的名称。
					echo "<a href='add_data.php?name=".$tablename."#pos'><button class='addData-button'>添加数据</button></a> ";
				?>
			</p>
		</div>
	</div>
</div>
</body>
</html>