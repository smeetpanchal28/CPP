<?php
include_once('connection.php');
 if (isset($_POST['check'])) {
     //Note: whenever passing data using json pass it in the form of assocaitive array here in th below code$data = array() is aan associative array
     $data = array();
    
     $sql = "select * from company where deleted=0";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) 
    { 
        $data['msg'] = 'success';
        
  	}
    else 
    {
  	    $data['msg'] = 'error';
  	}
    echo json_encode($data);
 }

if(isset($_POST['card']))
{
    $datas = array();
    $data = array();
     $sql = "select * from company where deleted=0";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) 
    { 
        while($row = mysqli_fetch_array($result))
        {
            $data['id'] = $row['id'];
            $data['companyName'] = $row['company_name'];
            $datas[] = $data;
        }
        
  	}
    else 
    {
  	    $data['msg'] = 'error';
  	}
    
    echo json_encode($datas);
}
?>