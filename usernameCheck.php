<?php
include("src/conn.php");

$username = $_POST['user_name'];
$checkUser = mysqli_query($conn," SELECT * FROM users WHERE User_name ='$username'");

$countUser =mysqli_num_rows($checkUser);

if($username== '')
{
    echo "<span></span>";
} else if($countUser >0){
    echo "<span class='badge badge-danger'><b> $username</b> is already exit</span>";
    echo "<script>document.getElementById('userID').disabled = true</script>";

}else if($countUser <= 0){
    echo "<span class='badge badge-success'><b> $username</b> is available</span>";
    echo "<script>document.getElementById('userID').disabled = false</script>";
}


?>