<?php
require "header.php";
?>
<div class="box">
    <div class="box_p">
    	<?php 
    		echo "<p>添加数据</p>";
    	?>
    </div>
    <?php 
    	//表单，action写出了提交表单后要跳转的页面，并且传递了当前操作的名称以及当前表名，method表示用post方法提交
		echo "<form action='adm.php?act=add&name=".$tablename."#pos' method='post'>";
	?>
    <table class="me">
		<tbody>	
			<?php
				$query = "desc ".$tablename;
				$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
				$row = mysqli_num_rows($res);
				for($i = 0; $i < $row; $i++) {
					$dbrow = mysqli_fetch_array($res);
					echo "<tr>";
					echo "<td></td>";
					switch ($i) {
						case '0': echo "<td>序号</td>"; break;
						case '1': echo "<td>书名</td>"; break;
						case '2': echo "<td>作者</td>"; break;
						case '3': echo "<td>位置</td>"; break;
						case '4': echo "<td>库存</td>"; break;
					}
					//name设置了提交表单数据的名称，只有设置了名称的数据才能被传递
					echo "<td><input type='text' class='editText' size='30' name='".$dbrow[0]."'></td>";
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
				echo "<button type='submit' class='addData-button'>添加数据</button>";
			?>
		</p>
	</div>
	</form>
</div>
<?php
require "footer.php";
?>