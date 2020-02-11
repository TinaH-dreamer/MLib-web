<!DOCTYPE html>
<?php
require "head.txt";
?>
<!--学生查询图书页面，原user.php-->
<body>
    <?php
    require "header_ss.php"
    ?>
    <div class="content">
		<div class="box">
			<?php 
	    	include ("conn.php");
			mysqli_query($conn,"set names utf-8");
			header("Content-type: text/html;charset=utf-8");
			$tablename = "borrow";
			$action = null;				//记录当前操作
			if(isset($_GET['act']))		//接收操作，表示当前操作
				$action = $_GET['act'];
			if($action == 'addcart') {			//添加至书篮操作
				$bid = $_GET['bid'];			//获取需要添加至书篮的书本编号
				$sql = "insert into borrow(sid, bid, Borrow_Date) values(";		//插入数据的sql语句
				//???怎么获取学号
				$sid = "2017192005";
				$sql = $sql.$sid.",".$bid.","."'".date('Y-m-d H:i:s')."');";
				$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));		//数据库执行插入数据操作
			}
			?>
			<div class = "opbar">
			    <center>
			        <ul>
			            <li><input type="text" name="number" placeholder="按编号查找"></li>
			            <li><button name = "search" class = "button" style = "cursor:pointer">搜索</button></li>
			        </ul>
			    </center>
			</div>
		    <table class="mt">		<!-- 绘制表格 -->
				<thead>
					<tr>
						<td>书名</td>
						<td>作者</td>
						<td>位置</td>
						<td>库存</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php
						include ("conn.php");
						mysqli_query($conn,"set names utf-8");
						header("Content-type: text/html;charset=utf-8");
						$query = "select * from books";	//获取当前表所有数据
						$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
						while($row = mysqli_fetch_row($res)){
							echo "<tr>";
							$index = 0;
							foreach ($row as $value){
								if($index == 0)
									$priNum = $value;
								else
									echo "<td>".$value."</td>";
								$index++;
							}
							echo "<td><a href = 'viewbooks.php?act=addcart&bid=".$priNum."'><button class='add-button'>+</button></a> ";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
		</div>
    </div>
</body>
</html>