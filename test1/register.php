

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="styledk.css"/>
    <link rel="stylesheet" href="/assests/css/Logged.css"/>
</head>
<body>
    <h1> <a href = "main.php"> Trang chủ </h1>
    <form method="post" action="register.php" class="form">

    <h2>SIGN UP</h2>

       <li class="navbar-item tenUser"> Account type
                            <ul class="subTenUser">
                                <li> <a href = "?type = 'cus'" > Customer </a></li>
                                <li> <a href = "?type = 'shop'"> Shop </a></li>
                            </ul>
                    </li>

    Username: <input type="text" name="username" >

    Password: <input type="text" name="password" />

    Email: <input type="email" name="email" />

    Phone: <input type="text" name="phone" />

    Address: <input type="text" name="address" />

    <input type="submit" name="dangky" value="Sign up"/>
    </form>
    <?php
header('Content-Type: text/html; charset=utf-8');
// Kết nối cơ sở dữ liệu
// $conn = mysqli_connect('localhost', 'root', '', 'data') or die ('Error');
// mysqli_set_charset($conn, "utf8");
session_start();
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
    if(isset($_GET['type'])){
        $type = $_GET['type'];
        //echo '<script language="javascript">alert("type"); window.location="register.php";</script>';
    
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$address = trim($_POST['address']);

if($type == 'cus')
{
    if (empty($username)) {
        echo '<script language="javascript">alert("Please enter username."); window.location="register.php";</script>';

    if (empty($password)) {
        echo "Incorrect password. Please try again. <a href='javascript: history.go(-1)'>Back</a>";
        }
    
}
else
{
    if (empty($username)) {
        echo '<script language="javascript">alert("Please enter username."); window.location="register.php";</script>';
        }
    if (empty($email)) {
        echo '<script language="javascript">alert("Please enter email."); window.location="register.php";</script>';
        }
    if (empty($phone)) {
        echo '<script language="javascript">alert("Please enter phone number."); window.location="register.php";</script>';
        }
    if (empty($password)) {
        echo '<script language="javascript">alert("Please enter password."); window.location="register.php";</script>';
        }
    if (empty($address)) {
        echo '<script language="javascript">alert("Please enter address."); window.location="register.php";</script>';
        }
    
}

$sql = "SELECT * FROM customer WHERE username = '$username'";

$sql = "SELECT * FROM shop WHERE shop = '$username'";


// Kiểm tra username hoặc email có bị trùng hay không
//$sql = "SELECT * FROM customer WHERE username = '$username'";

// Thực thi câu truy vấn
$result = pg_query($conn, $sql);

// Nếu kết quả trả về lớn hơn 1 thì nghĩa là username hoặc email đã tồn tại trong CSDL
if (pg_num_rows($result) > 0)
{
echo '<script language="javascript">alert("User already exist"); window.location="register.php";</script>';

// Dừng chương trình
die ();
}

else {
if($type == "cus")
    $sql1 = "INSERT INTO customer (username, password, email, phone, address) VALUES ('$username','$password','$email','$phone', '$address')";
    else
    {    
        $sql1 = "INSERT INTO customer (username, password, email, phone, address) VALUES ('$username','$password','$email','$phone', '$address')";
        $sql2 = "INSERT INTO shop (shop, password, email, phone, address) VALUES ('$username','$password','$email','$phone', '$address')";
        $res2 = pg_query($conn, $sql2);
    }
echo '<script language="javascript">alert("Sign Up Successfully!"); window.location="register.php";</script>';

$res1 = pg_query($conn, $sql1);

if (!$res1 || !$res2)
    echo '<script language="javascript">alert("Error"); window.location="register.php";</script>';

}
}
}
}
?>
</body>
</html>


