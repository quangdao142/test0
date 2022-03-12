<?php
header('Content-Type: text/html; charset=utf-8');
// Kết nối cơ sở dữ liệu
// $conn = mysqli_connect('localhost', 'root', '', 'data') or die ('Error');
// mysqli_set_charset($conn, "utf8");

require("db_con.php");

// $conn = pg_connect("host=localhost port=5432 dbname=<db_name> user=<db_user> password=<db_pass>");
// if (!$conn) {
//     echo "An error occurred.\n";
//     exit;
// }
// Query data
// $result = pg_query($conn, 'SELECT * FROM hr_employee');
// if (!$result) {
//     echo "An error occurred.\n";
//     exit;
// }
// // Show value
// while ($row = pg_fetch_assoc($result)) {
//     var_dump($row);
// }

// Dùng isset để kiểm tra Form
if(isset($_POST['dangky'])){
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);


if (empty($username)) {
array_push($errors, "Username is required"); 
}
if (empty($email)) {
array_push($errors, "Email is required"); 
}
if (empty($phone)) {
array_push($errors, "Password is required"); 
}
if (empty($password)) {
array_push($errors, "Two password do not match"); 
}

// Kiểm tra username hoặc email có bị trùng hay không
$sql = "SELECT * FROM member WHERE username = '$username'";

// Thực thi câu truy vấn
$result = pg_query($conn, $sql);

// Nếu kết quả trả về lớn hơn 1 thì nghĩa là username hoặc email đã tồn tại trong CSDL
if (pg_num_rows($result) > 0)
{
echo '<script language="javascript">alert("Already exist"); window.location="register.php";</script>';

// Dừng chương trình
die ();
}
else {
$sql = "INSERT INTO member (username, password, email, phone) VALUES ('$username','$password','$email','$phone')";
echo '<script language="javascript">alert("Sign Up Successfully!"); window.location="register.php";</script>';

if (pg_query($conn, $sql)){
echo "Tên đăng nhập: ".$_POST['username']."<br/>";
echo "Mật khẩu: " .$_POST['password']."<br/>";
echo "Email đăng nhập: ".$_POST['email']."<br/>";
echo "Số điện thoại: ".$_POST['phone']."<br/>";
}
else {
echo '<script language="javascript">alert("Error"); window.location="register.php";</script>';
}
}
}
?>