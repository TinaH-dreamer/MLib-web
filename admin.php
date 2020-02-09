<?php
	header('Content-type:text/html; charset=utf-8');
	// 开启Session
	session_start();

    include ("conn.php");
    mysqli_query($conn,"set names utf-8");

    $index = 0;					//计数当前表属性数量
    $tablename = "admin";
    $query = "desc ".$tablename;	//获取当前表的属性
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    while($row = mysqli_fetch_row($res)) {	//遍历属性，找到主码
        if($row[3] == "PRI"){		//如果是主码，记录其属性名以及编号，便于之后操作使用
            $pri = $row[0];
            $priNum = $index;
        }
        $index++;
    }

	// 处理用户登录信息
	if (isset($_POST['login'])) {
		# 接收用户的登录信息
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		// 判断提交的登录信息
		if (($username == '') || ($password == '')) {
			// 若为空,视为未填写,提示错误,并3秒后返回登录界面
			header('refresh:3; url=login.html');
			echo "用户名或密码不能为空!";
			exit;
		}

		else{
		    $sql = 'SELECT * FROM ADMIN WHERE AID = '.$username.' AND Apass = '.$password;
		    $result = $conn->query($sql);
		    if($result->num_rows>0){
		        # 用户名和密码都正确,将用户信息存到Session中
                $_SESSION['username'] = $username;
                $_SESSION['islogin'] = 1;
                // 若勾选7天内自动登录,则将其保存到Cookie并设置保留7天
                if ($_POST['remember'] == "yes") {
                    setcookie('username', $username, time()+7*24*60*60);
                    setcookie('code', md5($username.md5($password)), time()+7*24*60*60);
                } else {
                    // 没有勾选则删除Cookie
                    setcookie('username', '', time()-999);
                    setcookie('code', '', time()-999);
                }
                // 处理完附加项后跳转到登录成功的首页
                header('location:admbooks.php');
		    }
		    else{
                //用户名或密码错误,同空的处理方式
			    header('refresh:3; url=admin.html');
			    echo "用户名或密码错误!";
			    exit;
		    }

		}
	}
	$conn->close();
?>