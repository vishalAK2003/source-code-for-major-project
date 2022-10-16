<?php

$text = $_POST['uname'];
$password = $_POST['upswd'];




if (!empty($uname) || !empty($upswd) )
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
    $SELECT = "SELECT uname From login Where uname = ? Limit 1";

    $INSERT = "INSERT Into login ( uname , upswd )
    values(?,?)";

    //prepare statement
      $stmt = $conn->prepare($SELECT);
      $stmt->bind_param("s", $uname);
      $stmt->execute();
      $stmt->bind_result($text);
      $stmt->store_result();
      $rnum = $stmt->num_rows;

    //checking username
     if ($rnum==0) {
     $stmt->close();
     $stmt = $conn->prepre($INSERT);
     $stmt->bind_param("ss", $uname,$upswd);
     $stmt->execute();
     echo "New record inserted sucessfully";
     } else {
        echo "someone already register using this username";
     }
     $stmt->close();
     $conn->close();
}
}   else {
    echo "All field are required";
    die();
}
?>