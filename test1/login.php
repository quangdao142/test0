<?php
//Khai báo sử dụng session
session_start();
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
//Xử lý đăng nhập
if (isset($_POST['dangnhap']))
{
//Kết nối tới database
include('connect.php');
  
//Lấy dữ liệu nhập vào
$username = addslashes($_POST['username']);
$password = addslashes($_POST['password']);
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$username || !$password) {
echo "Please enter your username and password. <a href='javascript: history.go(-1)'>Back</a>";
exit;
}

// mã hóa pasword
//$password = md5($password);
  
//Kiểm tra tên đăng nhập có tồn tại không
$query = "SELECT username, password FROM customer WHERE username ='$username'";

$result = pg_query($conn, $query);

if (!$result) {
echo "Incorrect username! <a href='javascript: history.go(-1)'>Back</a>";
}
  
//Lấy mật khẩu trong database ra
$row = pg_fetch_object($result);
  
//So sánh 2 mật khẩu có trùng khớp hay không
if ($password != $row->password) {
    echo '<script language="javascript">alert("Wrong password!"); window.location="login.php";</script>';
exit;
}
  
//Lưu tên đăng nhập
$_SESSION['usernamenow'] = $username;
$_SESSION['usernamenow'] = $row->username;
$run =  "SELECT shop, password FROM shop WHERE shop ='$username'";
$rs = pg_query($conn, $run);

if (!$rs) {
    //echo "Hello buyer <b>" .$username . "</b>. Successful login. ";
    header("location:shopLog.php");
    }
else {
    //echo "Hello shop <b>" .$username . "</b>. Successful login. ";
    header("location:shopLog.php");
    
}
pg_close($conn);
}
?>


<!DOCTYPE html> 
<html> 
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <link rel="stylesheet" href="styledn.css"/> 
</head> 
<body> 
    <form action='login.php' class="dangnhap" method='POST'>
    Username : <input type='text' name='username' /> 
    Password : <input type='password' name='password' /> 
    <a href= ""  > <input type='submit' class="button" name="dangnhap" value='Log in' />  </a>
    <a href='register.php' title='Sign up'>Sign up</a>

    
    <form>
</body> 
</html>