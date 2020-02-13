<!-- 管理员填写借阅记录 -->
<!-- 点击确认取书跳转至adm_borrow.php,act为confirm -->
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
        <div class="box_p">
            <?php 
                echo "<p>填写借阅信息</p>";
            ?>
        </div>
        <?php 
            $id = $_GET['id'];      //传进的主码值
            //表单，action写出了提交表单后要跳转的页面，并且传递了当前操作的名称、当前表名以及当前数据的主码值，method表示用post方法提交
            echo "<form action='adm_borrow.php?act=confirm"."&id=".$id."#pos' method='post'>";
        ?>
        <table class="me">
        	<thead>
				<tr>
					<td>编号</td>
					<td>姓名</td>
					<td>学号</td>
					<td>书名</td>
					<td>书号</td>
					<td>借阅日期</td>
					</tr>
			</thead>
            <tbody> 
                <?php
                    $query = "select * from ".$tablename." where ".$pri."='".$id."';";     //获取当前主码值对应的属性值
                    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
                    $dbrow = mysqli_fetch_array($res);
                    $bookname = explode(',',$dbrow[3]);
                    $count = count($bookname);
					for($i = 0; $i < $count; $i++){
						if($i == 0){
		                    echo "<tr>";
		                    echo "<td>".$dbrow[0]."</td>";		//编号
		                    $sql = "select SName from student WHERE SID = ".$dbrow[1];
		                    $res1 = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		                    $row1 = mysqli_fetch_row($res1);
		                    echo "<td>".$row1[0]."</td>";		//姓名
		                    echo "<td>".$dbrow[1]."</td>";		//学号
		                    echo "<td>".$bookname[$i]."</td>";		//书名
		                    echo "<td><input type='text' class='editText' name='bookid".$i."'></td>";		//书号
		                    echo "<td><input type='date' class='editText' name='borrowdate' value='".date("Y-m-d")."'></td>";		//借阅日期
		                    echo "</tr>";							
						}
						else{
							echo "<tr>";
							echo "<td></td>";
							echo "<td></td>";
							echo "<td></td>";
							echo "<td>".$bookname[$i]."</td>";		//书名
		                    echo "<td><input type='text' class='editText' name='bookid".$i."'></td>";		//书号
							echo "<td></td>";
							echo "</tr>";
						}
                	}
                ?>
            </tbody>
        </table>
        <div class="box_p">
            <p>
                <?php 
                    echo "<a href='adm_borrow.php'><button type='button' class='deleteTable-button'>返回</button></a> ";
                    echo "<button type='submit' class='addData-button'>确认</button>";
                ?>
            </p>
        </div>
        </form>
    </div>
</div>
</body>
</html>