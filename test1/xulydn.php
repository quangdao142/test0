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
echo "Incorrect username!";
}
  
//Lấy mật khẩu trong database ra
$row = pg_fetch_array($result);
  
//So sánh 2 mật khẩu có trùng khớp hay không
if ($password != $row['password']) {
echo "Incorrect password. Please try again. <a href='javascript: history.go(-1)'>Back</a>";
exit;
}
  
//Lưu tên đăng nhập
//$_SESSION['username'] = $username;
echo "Hello <b>" .$username . "</b>. Successful login. ";

$run =  "SELECT shop, password FROM shop WHERE shop ='$username'";
$rs = pg_query($conn, $run);
if (!$result) {
    $myfile = fopen("shoplog.php", "r") or die("Unable to open file!");
    echo fread($myfile,filesize("Logged.php"));
    }


pg_close($conn);
}
?>