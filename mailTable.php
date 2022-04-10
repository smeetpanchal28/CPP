<?php 
include_once('connection.php');
$data1 = array();
$data2 = array();
    
        //getting the company_details from the database
        $company_details = "select * from company_d where deleted=0 and id=1";
        $company_result = mysqli_query($conn, $company_details);
        if(mysqli_num_rows($company_result) == 1) 
        { 
            while($row = mysqli_fetch_array($company_result))
            {
                $data['json_type'] = $row['json_type'];
                $data['attach'] = $row['attach'];
            }
        } 
         /* ref_no doa doc policy salary escription address  placement_for eligible branches register  ldr selection dop tor vtr isiting count_visiting cp p_for_kjsit place_location nstruction*/
        $company = json_decode($data['json_type']);
        $attach = json_decode($data['attach'],1);
        
        foreach ($attach as $key => $value) 
        {
            echo $key.' ' .$value.'<br>';
        }
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <style>
      .mine
      {
        width: 600.65pt; 
      }
      table {
  border-collapse: collapse;
}

table, tr, td {
  border: 1px solid black;
}
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2></h2>
  <table class="table table-bordered">
    <tbody>     
<!--
      <tr class="info">
        <td>Info</td>
        <td>Dooley</td>
        <td>july@example.com</td>
      </tr>
-->
        <tr class="active">
            <td>Ref No.</td>
            <td class="mine"><?php  echo $company->ref_no; ?></td>
        </tr>
        <tr class="active">
            <td>Date of Announcement</td>
            <td class="mine"><?php echo $company->doa; ?></td>
        </tr>
        <tr class="active">
            <td>Date of Campus Placement</td>
            <td class="mine"><?php echo $company->doc; ?></td>
        </tr>
        <tr class="active">
            <td>Name of the Companys</td>
            <td class="mine"><?php echo $company->noc; ?></td>
        </tr>
        <tr class="active">
            <td>Type of company as per KJSCE placement policy</td>
            <td class="mine"><?php echo $company->policy; ?></td>
        </tr>
        <tr class="active">
            <td>Salary pm/pa</td>
            <td class="mine"><?php echo $company->salary; ?></td>
        </tr>
        <tr class="active">
            <td>Brief Job Description (JD) :</td>
            <td class="mine"><?php echo $company->description; ?></td>
        </tr>
        <tr class="active">
            <td>Address of corporate office of company</td>
            <td class="mine"><?php echo $company->address; ?></td>
        </tr>
        <tr class="active">
            <td>Placement for UG/PG/UG and PG both</td>
            <td class="mine"><?php echo $company->placement_for; ?></td>
        </tr>
        <tr class="active">
            <td>Eligibility: CGPI / Live KT criteria etc</td>
            <td class="mine"><?php echo $company->eligible; ?></td>
        </tr>
        <tr class="active">
            <td>Branches eligible to apply :</td>
            <td class="mine"><?php echo $company->branches; ?></td>
        </tr>
        <tr class="active">
            <td>Google Link to register</td>
            <td class="mine"><?php echo $company->register; ?></td>
        </tr>
        <tr class="active">
            <td>Last date to register</td>
            <td class="mine"><?php echo $company->ldr; ?></td>
        </tr>
        <tr class="active">
            <td>Mode of selection</td>
            <td class="mine"><?php echo $company->selection; ?></td>
        </tr>
        <tr class="active">
            <td>Date of PPT / Test / Interview</td>
            <td class="mine"><?php  echo $company->dop; ?></td>
        </tr>
        <tr class="active">
            <td>Time to report for written test / campus placement</td>
            <td class="mine"><?php echo $company->tor; ?></td>
        </tr>
        <tr class="active">
            <td>Venue to report</td>
            <td class="mine"><?php  echo $company->vtr; ?></td>
        </tr>
        <tr class="active">
            <td>Is the company visiting for the first time? Yes/No</td>
            <td class="mine"><?php echo $company->visiting; ?></td>
        </tr>
        <tr class="active">
            <td>If No, then details of past how many times visited in past for campus placement at KJSCE</td>
            <td class="mine"><?php echo $company->count_visiting; ?></td>
        </tr>
        <tr class="active">
            <td>Is it a campus placement or Pool Campus placement?</td>
            <td class="mine"><?php echo $company->cp; ?></td>
        </tr>
        <tr class="active">
            <td>Is it a campus placement for KJSIT also? Yes/No</td>
            <td class="mine"><?php echo $company->p_for_kjscit; ?></td>
        </tr>
        <tr class="active">
            <td>Location of Placement / Venue of Training of Selected students</td>
            <td class="mine"><?php echo $company->place_location; ?></td>
        </tr>
        <tr class="active">
            <td>Any specific Instructions</td>
            <td class="mine"><?php  echo $company->instruction; ?></td>
        </tr>
        
      
    </tbody>
  </table>
</div>

</body>
</html>
