<!-- 管理员通过编号查询借阅记录 -->
<!-- 点击归还跳转至adm_return_book.php -->
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
		$tablename = "borrow";
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
			if($action == 'return') {			//编辑数据操作
				$id = $_GET['id'];			//获取要编辑数据的主码
				$sql = "update ".$tablename." set Return_Date='".$_POST['returndate']."', type='2'";	//2表示该预约记录已完成
				$sql = $sql ." where ".$pri."='".$id."';";
				$res = mysqli_query($conn, $sql) or die(mysqli_error($conn)); //数据库执行编辑数据操作
			}
			$id = null;
			if(isset($_POST['number'])){
				$id = $_POST['number'];
			}
		?>
		<div class = "opbar">
		    <ul>
		    	<form action="adm_return.php" method="post">
		        <li><input type="search" name="number" id="con" placeholder="按编号查找"></li>
		        <li><button type="submit" name = "search" class = "button" style = "cursor:pointer">搜索</button></li>
		        </form>
		    	<?php 
					echo "<li style='float: right;'><a href='adm_finish.php'><button class='addData-button'>完成记录</button></a></li>";
					echo "<li style='float: right;'><a href='adm_return.php'><button class='active-button'>借阅记录</button></a></li>";
					echo "<li style='float: right;'><a href='adm_borrow.php'><button class='addData-button'>预约记录</button></a></li>";
				?>
		    </ul>
		</div>
	    <table class="mt">		<!-- 绘制表格，显示所有的预约记录 -->
			<thead>
				<tr>
					<td>编号</td>
					<td>姓名</td>
					<td>学号</td>
					<td>书名</td>
					<td>书号</td>
					<td>借书日期</td>
					<td></td>
					</tr>
			</thead>
			<tbody>
				<?php
					if($id){
						$query = "select * from ".$tablename." where BorrowId = '".$id."'";
					}
					else{
						$query = "select * from ".$tablename;	//获取当前表所有数据
					}
					$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
					while($row = mysqli_fetch_row($res)){
						if($row[7] == 1)			//判断该记录是预约记录还是借阅记录，0表示预约记录，1表示借阅记录
						{
							echo "<tr>";
							echo "<td>".$row[0]."</td>";	//编号
							$sql = "select SName from student WHERE SID = ".$row[1];		//通过对应的学号，查询student表获取学生的姓名
							$res1 = mysqli_query($conn, $sql) or die(mysqli_error($conn));
							$row1 = mysqli_fetch_row($res1);
							echo "<td>".$row1[0]."</td>";	//姓名
							echo "<td>".$row[1]."</td>";	//学号
							if(mb_strlen($row[3])>10)
								$newStr = mb_substr($row[3],0,10,"UTF8")."...";
							else
								$newStr = $row[3];
							echo "<td>".$newStr."</td>";	//书名
							if(mb_strlen($row[2])>8)
								$newStr1 = mb_substr($row[2],0,8,"UTF8")."...";
							else
								$newStr1 = $row[2];
							echo "<td>".$newStr1."</td>";	//书号
							$arr = explode(' ',$row[4]);
							echo "<td>".$arr[0]."</td>";	//取书日期
							echo "<td><a href='adm_return_book.php?id=".$row[$priNum]."#pos'><button class='addData-button'>归还</button></a></td>";
							echo "</tr>";
						}
					}
				?>
			</tbody>
		</table>
	</div>
</div>
</body>
</html>