<!DOCTYPE html>
<html lang='zh-CN'>
<?php
require "head.txt";
?>
<body style="background-color:#90003e">
    <?php
    require "header_ss.php"
    ?>
    <div class="container">
        <div class="col-md-12 column">
            <table class="table">
                <thead>
                    <tr>
                        <th>预约编号</th>
                        <th>书目详情</th>
                        <th>借书日期</th>
                        <th>归还期限</th>
                        <th>状态</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include ("conn.php");
                    mysqli_query($conn,"set names utf-8");
                    header("Content-type: text/html;charset=utf-8");
                    $username = $_SESSION['username'];
                    $query = "select borrowID, BIDlist, Borrow_Date, Expect_Return_Date, status from borrow where SID='".$username."' order by status DESC";	//获取当前表所有数据
                    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
                    while($row = mysqli_fetch_row($res)){
                        echo "<tr>";
                        $index=0;
                        foreach ($row as $data){
                            /*
                            if($index==3){
                                //输出到图书时
                                echo "<td>";
                                foreach($data as $value)
                                    echo "{$value}, ";
                                echo "</td>";
                            }
                            */
                            echo "<td>{$data}</td>";
                            $index++;
                        }
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>            
    </div>
</body>
