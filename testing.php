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
        //echo print_r($company);
        echo $company->noc;
        echo $company->ref_no;
        echo $company->doa;
        echo $company->doc;
        echo $company->policy;
        echo $company->salary;
        echo $company->description;
        echo $company->address;
        echo $company->placement_for;
        echo $company->eligible;
        echo $company->branches;
        echo $company->register;
        echo $company->ldr;
        echo $company->selection;
        echo $company->dop;
        echo $company->tor;
        echo $company->vtr;
        echo $company->visiting;
        echo $company->count_visiting;
        echo $company->cp;
        echo $company->p_for_kjscit;
        echo $company->place_location;
        echo $company->instruction;
        
            
?>