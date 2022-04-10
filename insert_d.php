<?php 
include_once('connection.php');
if (isset($_POST['create'])){ 
    $data = array();
    $files = array();
    $dir_name = "uploaded";
    $k=1;
    $id = $_POST['id'];
    

    /* ref_no doa doc policy salary escription address  placement_for eligible branches register  ldr selection dop tor vtr isiting count_visiting cp p_for_kjsit place_location nstruction*/
    $data['ref_no'] = stripslashes($_POST['ref_no']);
    $data['doa'] = stripslashes($_POST['doa']);
    $data['doc'] = stripslashes($_POST['doc']);
    $data['noc'] = str_replace("\r\n","</br>",$_POST['noc']);
    $data['policy'] = stripslashes($_POST['policy']);
    $data['salary'] = str_replace("\r\n","</br>",$_POST['salary']);
    $data['description'] = str_replace("\r\n","</br>",$_POST['description']);
    $data['address'] = str_replace("\r\n","</br>",$_POST['address']);
    $data['placement_for'] = stripslashes($_POST['placement_for']);
    $data['eligible'] = str_replace("\r\n","</br>",$_POST['eligible']);
    $data['branches'] = stripslashes($_POST['branches']);
    $data['register'] = str_replace("\r\n","</br>",$_POST['register']);
    $data['ldr'] = stripslashes($_POST['ldr']);
    $data['selection'] = str_replace("\r\n","</br>",$_POST['selection']);
    $data['dop'] = stripslashes($_POST['dop']);
    $data['tor'] = stripslashes($_POST['tor']);
    $data['vtr'] = stripslashes($_POST['vtr']);
    $data['visiting'] = stripslashes($_POST['visiting']);
    $data['count_visiting'] = stripslashes($_POST['count_visiting']);
    $data['cp'] = stripslashes($_POST['cp']);
    $data['p_for_kjscit'] = stripslashes($_POST['p_for_kjsit']);
    $data['place_location'] = stripslashes($_POST['place_location']);
    $data['instruction'] = str_replace("\r\n","</br>",$_POST['instruction']);
    echo $_POST['instruction'];
    $json_type = json_encode($data);
        //handling of multiple file attachments with different extensions like jpeg,jpg,png,pdf,doc,docx,ppt;
     if(count($_FILES['attach']['name']) > 0){
        //Loop through each file
        for($i=0; $i<count($_FILES['attach']['name']); $i++) {
          //Get the temp file path
            $tmpFilePath = $_FILES['attach']['tmp_name'][$i];

            //Make sure we have a filepath
            if($tmpFilePath != ""){
            
                //save the filename
                $shortname = $_FILES['attach']['name'][$i];
                //save the url and the file
                
                $shortname = str_replace("'", "", $shortname);
               
                $filePath = $dir_name."/".$shortname;

                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $filePath)) {
                     $files[$k] = $shortname;
                    $k++;
                    //insert into db 
                    //use $shortname for the filename
                    //use $filePath for the relative url to the file

                }
              }
        }
    }
    //show success message
    $file_attachments = (string)json_encode($files);
    $sql = "INSERT INTO company_d (id,json_type,attach) VALUES ($id,'".$json_type."','".$file_attachments."')";
    if (mysqli_query($conn, $sql)) 
    { 
        echo "successfull insertion";
        
  	}else 
    {
  	  echo "Error: ". mysqli_error($conn);
  	}
 }
 
?>