<?php
include_once('connection.php');
 if (isset($_POST['check'])) {
     //Note: whenever passing data using json pass it in the form of assocaitive array here in th below code$data = array() is aan associative array
     $data = array();
    $id = $_POST['id'];
     $sql = "select * from company_d where deleted=0 and id=".$id;
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 1) 
    { 
        $data['msg'] = 'success';
        
  	}
    else 
    {
  	    $data['msg'] = 'error';
  	}
    echo json_encode($data);
 }
if(isset($_POST['details']))
{
    $data = array();
    $id = $_POST['id'];
    $sql = "select * from company_d where deleted=0 and id=".$id;
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 1) 
    { 
        while($row = mysqli_fetch_array($result))
        {
            $data['msg'] = 'success'; 
            $data['id'] = $row['id'];
            $data['json_type'] = $row['json_type'];
            $data['attach'] = $row['attach'];
        }
  	}
    else 
    {
  	     echo "Error: ".mysqli_error();
  	}
    echo json_encode($data);
}
?>