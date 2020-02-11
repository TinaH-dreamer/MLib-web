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
				$studentNum = 2017192005;
		    	include ("conn.php");
				mysqli_query($conn,"set names utf-8");
				header("Content-type: text/html;charset=utf-8");
				// $index = 0;					//计数当前表属性数量
				// $tablename = "borrow";
				// $query = "desc ".$tablename;	//获取当前表的属性
				// $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
				// while($row = mysqli_fetch_row($res)) {	//遍历属性，找到主码
				// 	if($row[3] == "PRI"){		//如果是主码，记录其属性名以及编号，便于之后操作使用
				// 		$pri = $row[0];
				// 		$priNum = $index;
				// 	}
				// 	$index++;
				// }
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
						<!-- <td>库存</td> -->
						<td>预约取书时间</td>
						<td></td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php
						include ("conn.php");
						mysqli_query($conn,"set names utf-8");
						header("Content-type: text/html;charset=utf-8");
						$query = "select bid from borrow where sid = ".'"'.$studentNum.'";';	//获取该学号学生的所有预约信息
						$bid = mysqli_query($conn, $query) or die(mysqli_error($conn));
						while($row = mysqli_fetch_row($bid)){
							$sql = "select * from books where bid = "."'".$row[0]."'".";";
							$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
							$bookInfo = mysqli_fetch_row($res);
							echo "<tr>";
							$index = 0;
							if(is_array($bookInfo)){
								foreach ($bookInfo as $value){
									if($index != 0 && $index != 4)		//展示书名、作者、位置信息
										echo "<td>".$value."</td>";
									$index++;
								}
							}

							echo "<td>";
							echo "<input type='text' list='time'>";
							echo "<datalist id='time'>
									<option value='时间段1' label='上午9:00~11:30'></option>
									<option value='时间段2' label='下午14:30~17:30'></option>
								</datalist>";
							echo "</td>";
							//href='mycart.php?act=deleteData&name='
							echo "<td><a href='mycart.php?act=deleteData&id=".$priNum."'><button class='addData-button'>提交</button></a> ";
							//href='mycart.php?act=deleteData&name='
							echo "<td><a href='mycart.php?act=deleteData&name='><button class='delete-button'>删除</button></a> ";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
		</div>
    </div>
</body>
</html>