<!DOCTYPE html>
<?php
require "head.txt";
?>
<!--学生查询图书页面，原user.php-->
<body>
    <?php
    require "headbar_ss.php"
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
			

			<!--代码-->			
	<?php		if(!empty($_POST))
				{		
					$name = $_POST['number'];			//获取查询的信息
					$condition = " name like '%{$name}%'";			//查询条件
				}
				$sql = "select * from contacts WHERE {$condition}";		//sql查询语句
				echo $sql;			//php语句，对数据库进行筛选
				$result = $library->query($sql);		//把数据库执行查询的结果保存在变量$result中		
				
				if($result)			//如果有查到
				{
					$temp = $result->fetch_row();		//我们就把他找出来
					echo 
					" <tr>
					<td>{$temp[0]}</td> 		//编号
					<td>{$temp[1]}</td>			//书名
					<td>{$temp[2]}</td>			//作者
					<td>{$temp[3]}</td>			//位置
					<td>{$temp[4]}</td>			//库存
					</tr>"
				}

	?>		
			<!--代码-->
			
			
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
						include ("conn.php");//连接数据库
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