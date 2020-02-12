<!DOCTYPE html>
<html lang='zh-CN'>
<?php
require "head.txt";
?>
<body style="background-color:#90003e">
    <?php
    require "header_ss.php";
    session_start();
    if(!isset($_SESSION['islogin'])){
        header('refresh:3; url=login.html');
    }
    ?>
    <div class="container">
        <div class="col-md-8 column">
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
                    $query = "select borrowID, BID, Borrow_Date, Expect_Return_Date, BorrowState from borrow where SID='".$username."' order by BorrowState DESC";	//获取当前表所有数据
                    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
                    while($row = mysqli_fetch_row($res)){
                        echo "<tr>";
                        $count = 0;
                        foreach ($row as $data){
                            if($count==1){
                                //输出到图书时
                                echo "<td>";
                                $index = 0;
                                $bidlist = explode(",",$data);
                                $sql = "select BName from books where BID='".$bidlist[0]."'";
                                $res_bname = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                while($brow = mysqli_fetch_row($res_bname)){
                                    echo $brow[0];
                                }
                                if(count($bidlist)>1){
                                    echo "  <button type='button' class='btn btn-tran' data-toggle='collapse' data-target='#demo'>";
                                    echo "<i class = 'fa fa-angle-down' style='font-size:10pt;color:#4d88ad'></i></button>";
                                    echo "<div id='demo' class='collapse'>";
                                    for($i=1;$i<count($bidlist);$i++){
                                        $sql = "select BName from books where BID='".$bidlist[$i]."'";
                                        $res_bname = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                        while($brow = mysqli_fetch_row($res_bname)){
                                            echo $brow[0];
                                        }
                                    }
                                    echo "</div>";
                                }   
                                
                                echo "</td>";
                            }
                            else{
                                echo "<td>{$data}</td>";
                            }
                            $count++;
                        }
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>            
    </div>
</body>
