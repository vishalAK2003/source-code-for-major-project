<?php

$text = $_POST['text'];
$email = $_POST['email'];
$password = $_POST['password'];




if (!empty($text) || !empty($email)
   || !empty($password) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "vishalstore";    



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
    die('connect Error ('.
    mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
    $SELECT = "SELECT email From register Where email = ? Limit 1";

    $INSERT = "INSERT Into register (text , email , password )
    values(?,?,?)";

    //prepare statement
      $stmt = $conn->prepare($SELECT);
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt->bind_result($email);
      $stmt->store_result();
      $rnum = $stmt->num_rows;

    //checking username
     if ($rnum==0) {
     $stmt->close();
     $stmt = $conn->prepre($INSERT);
     $stmt->bind_param("sss", $text,$email,$password);
     $stmt->execute();
     echo "New record inserted sucessfully";
     } else {
        echo "someone already register using this email";
     }
     $stmt->close();
     $conn->close();
}
}   else {
    echo "All field are required";
    die();
}
?>