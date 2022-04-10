<?php 
include_once('connection.php');
 if (isset($_POST['save'])) {
    $name = $_POST['company_name'];
    echo $name;
  	$sql = "INSERT INTO company (company_name) VALUES ('".$name."')";
    if (mysqli_query($conn, $sql)) 
    { 
        echo"successfull insertion";
        
  	}else 
    {
  	  echo "Error: ". mysqli_error($conn);
  	}
 }
?>