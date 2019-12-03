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
							echo "<td><a><button class='add-button'>+</button></a> ";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
		</div>
    </div>
</body>
</html>