<!DOCTYPE html>
<?php
require "head.txt";
?>
<body>
    <?php
   	 require "headbar_ss.php"
    ?>
    <div class="content">
	<div class="box">
		<form action="" method="post">
			<br>
			请填写以下信息：
			<br>
			<br>
			姓名&nbsp<input type="text" name="name" placeholder="&nbsp姓名">
			<br>
			学号&nbsp<input type="text" name="number" placeholder="&nbsp学号">
			<br>
			书名&nbsp<input type="text" name="bname" placeholder="&nbsp书名">
			<br>
			数量&nbsp<input type="text" name="bnumber" placeholder="&nbsp数量">
			<br>
			<input name="submit" type="submit" value="确认" name="button"/>	
  		</form>
		<?php
			$con=mysqli_connect("localhost","root","","library"); 
			if (mysqli_connect_errno($con)) 
			{ 
				echo "连接 MySQL 失败: " . mysqli_connect_error(); 
			} 
			if(empty($_POST['button']))
			{			
				$name = $_POST['name'];
				$number = $_POST['number'];
				$bname = $_POST['bname'];		
				$bnumber = $_POST['bnumber'];
				if(!($name & $number & $bname & $bnumber))
				{
					echo "请完善数据";
					exit;
				}else{
					echo '<br>名字：'.$name;
					echo '<br>学号：'.$number;
					echo '<br>书名：'.$bname;
					echo '<br>数量：'.$bnumber;
				}			
			}
			

								
			
			
												
		?>		
	</div>
    </div>
</body>
</html>