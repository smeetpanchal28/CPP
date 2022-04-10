<?php
    $conn = mysqli_connect("localhost", "root", "", "cpp1");
    if($conn)
    {
        
    }
else
{
    echo "Error: ". mysqli_error($conn);
}
?>