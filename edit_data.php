<?php
require "header.php";
?>
<div class="box">
    <div class="box_p">
    	<?php 
    		echo "<p>更新数据</p>";
    	?>
    </div>
    <?php 
    	$id = $_GET['id'];		//传进的主码值
    	//表单，action写出了提交表单后要跳转的页面，并且传递了当前操作的名称、当前表名以及当前数据的主码值，method表示用post方法提交
		echo "<form action='adm.php?act=edit&name=".$tablename."&id=".$id."#pos' method='post'>";
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
						case '0': echo "<td>序号</td>"; break;
						case '1': echo "<td>书名</td>"; break;
						case '2': echo "<td>作者</td>"; break;
						case '3': echo "<td>位置</td>"; break;
						case '4': echo "<td>库存</td>"; break;
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
<?php
require "footer.php";
?>