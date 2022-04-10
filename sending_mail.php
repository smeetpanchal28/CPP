<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
include_once('connection.php');
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer();
$email = array();
 //Server setting
$mail->SMTPDebug =  SMTP::DEBUG_SERVER;                      // Enable verbose debug output
$mail->isSMTP();                                            // Send using SMTP
$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
$mail->Username   = 'cpp.tpo@gmail.com';                     // SMTP username
$mail->Password   = 'cpptpo@123';                               // SMTP password
$mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
$mail->Port       = 465;                                    // TCP port to connect to
$mail->setFrom('cpp.tpo@gmail.com', 'tpo_engg');

if($_POST['send_mail'])
{
    $comman_department = array();
    $program = array();
    $cgpi = $_POST['cgpi'];
    $UG = $_POST['UG'];
    $id = $_POST['id'];
    $name = $_POST['name'];
    $status = $_POST['status'];
    $k=0;
    $n=0;
    $sql = "";
    if(count($UG) > 0)
    {
        $program[$n]='UG';
        $n++;
        for($i=0;$i<count($UG);$i++)
        {
            $comman_department[$k] = $UG[$i];
            $k++;
        }
        if(isset($_POST['PG']))
        {
            $PG = $_POST['PG'];
            $program[$n]='PG';
             for($i=0;$i<count($PG);$i++)
            {
                if(!in_array($PG[$i],$comman_department,true))
                {
                    $comman_department[$k] = $PG[$i];
                    $k++;
                }
            }
        }
    }
        $pg = "'" . implode ( "', '", $program ) . "'";
         $cd = "'" . implode ( "', '", $comman_department ) . "'";
          
        //echo implode(' ',$comman_department);
        //company status non-dream  so the mail will be sent to those who has not yet been placed till no
        if($status=='non-dream')
        {
            $sql = "SELECT * FROM student_grade WHERE program IN(".$pg.") and department IN(".$cd.") and status='none' and placed=0 and cgpi >= ".$cgpi;
        }
        //company status dream  so the mail will be sent to those who has not yet been placed till no and also the non-dreamer's
        else if($status=='dream')
        {
            $sql = "SELECT * FROM student_grade WHERE program IN(".$pg.") and department IN(".$cd.") and status IN('none','non-dream') and placed IN(0,1) and cgpi >= ".$cgpi;
        }
        //company status super-dream  so the mail will be sent to those who has not yet been placed till no and also for the non-dreamr's and dreamr's
        else if($status=='super-dream')
        {
            $sql = "SELECT * FROM student_grade WHERE program IN(".$pg.") and department IN(".$cd.") and status IN('none','non-dream','dream') and placed IN(0,1) and cgpi >= ".$cgpi;
        }
        //company status dream and non-dream  so the mail will be sent to those who has not yet been placed till no, and also for non-dreamer's
        else
        {
            $sql = "SELECT * FROM student_grade WHERE program IN(".$pg.") and department IN(".$cd.") and status IN('none','non-dream') and placed IN(0,1) and cgpi >= ".$cgpi;
        }
        
        ///getting mail list ready for the first annuncement, later on this mail list will be stored in the database for further announcement of this company activity.
        $m=0;
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) 
        { 
            while($row = mysqli_fetch_array($result))
            {
                $email[$m] = $row['email'];
                $m++;
            }
        }
        else 
        {
             echo "Error: ".mysqli_error();
        }    
    
        //now sending the mail_list to the announcement table  for the future announcements
        $mail_list_sql = "INSERT INTO announcement (company_id,announce,mail_list,attach) VALUES ($id,'','".implode(',',$email)."','')";
        if (mysqli_query($conn, $mail_list_sql)) 
        { 
            echo "successfull insertion";

        }else 
        {
          echo "Error: ". mysqli_error($conn);
        }
    
        $data = array();
    
        //getting the company_details from the database
        $company_details = "select * from company_d where deleted=0 and id=".$id;
        $company_result = mysqli_query($conn, $company_details);
        if(mysqli_num_rows($company_result) == 1) 
        { 
            while($row = mysqli_fetch_array($company_result))
            {
                $data['json_type'] = $row['json_type'];
                $data['attach'] = $row['attach'];
            }
        } 
        $company = json_decode($data['json_type']);
        $attach = json_decode($data['attach'],1);
        
    try 
    {
            //Recipients
           // echo "<script type='text/javascript'>alert('1');</script>";
            for($i=0;$i<count($email);$i++)
            {
                $mail->addAddress($email[$i]);     // Add a recipient
            }
            //$mail->addAddress('gaurav.hiran@somaiya.edu');    
            //$mail->addReplyTo('gaurav.hiran@somaiya.edu');
            //echo "<script type='text/javascript'>alert('2');</script>";
            // $mail->addAddress('ellen@example.com');               // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            
            $mail->addCC('');
            
            //echo "<script type='text/javascript'>alert('3');</script>";
            //$mail->addBCC('bcc@example.com');
            // Attachments
            foreach ($attach as $key => $value) 
            {
                $mail->addAttachment('./uploaded/'.$value.'');         // Add attachments
            }
            
           // echo "<script type='text/javascript'>alert('4');</script>";
           // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            echo $company->noc;
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $name;
            $companyDetailTable = '<!DOCTYPE html>
                                    <html lang="en">
                                    <head>
                                      <title>Bootstrap Example</title>
                                      <style>
                                          .mine
                                          {
                                            width: 450.65pt; 
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
                                            <tr class="active">
                                                <td>Ref No.</td>
                                                <td class="mine">'.$company->ref_no.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Date of Announcement</td>
                                                <td class="mine">'.$company->doa.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Date of Campus Placement</td>
                                                <td class="mine">'.$company->doc.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Name of the Companys</td>
                                                <td class="mine">'.$company->noc.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Type of company as per KJSCE placement policy</td>
                                                <td class="mine">'.$company->policy.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Salary pm/pa</td>
                                                <td class="mine">'.$company->salary.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Brief Job Description (JD) :</td>
                                                <td class="mine">'.$company->description.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Address of corporate office of company</td>
                                                <td class="mine">'.$company->address.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Placement for UG/PG/UG and PG both</td>
                                                <td class="mine">'.$company->placement_for.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Eligibility: CGPI / Live KT criteria etc</td>
                                                <td class="mine">'.$company->eligible.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Branches eligible to apply :</td>
                                                <td class="mine">'.$company->branches.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Google Link to register</td>
                                                <td class="mine">'.$company->register.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Last date to register</td>
                                                <td class="mine">'.$company->ldr.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Mode of selection</td>
                                                <td class="mine">'.$company->selection.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Date of PPT / Test / Interview</td>
                                                <td class="mine">'.$company->dop.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Time to report for written test / campus placement</td>
                                                <td class="mine">'.$company->tor.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Venue to report</td>
                                                <td class="mine">'.$company->vtr.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Is the company visiting for the first time? Yes/No</td>
                                                <td class="mine">'.$company->visiting.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>If No, then details of past how many times visited in past for campus placement at KJSCE</td>
                                                <td class="mine">'.$company->count_visiting.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Is it a campus placement or Pool Campus placement?</td>
                                                <td class="mine">'.$company->cp.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Is it a campus placement for KJSIT also? Yes/No</td>
                                                <td class="mine">'.$company->p_for_kjscit.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Location of Placement / Venue of Training of Selected students</td>
                                                <td class="mine">'.$company->place_location.'</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Any specific Instructions</td>
                                                <td class="mine">'.$company->instruction.'</td>
                                            </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                    </body>
                                    </html>';
            $mail->Body = $companyDetailTable;
        
            // echo "<script type='text/javascript'>alert('5');</script>";
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            // echo "<script type='text/javascript'>alert('6');</script>";
            echo 'Message has been sent';
            $mail->ClearAddresses();  // each AddAddress add to list
            $mail->ClearCCs();
            return;
            //$mail->ClearBCCs();
    }
    catch (Exception $e) 
    {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
else
{
    /*try 
    {
            //Recipients

           // echo "<script type='text/javascript'>alert('1');</script>";
            for($i=0;$i<count($email);$i++)
            {
                $mail->addAddress($email[$i]);     // Add a recipient
            }

        //echo "<script type='text/javascript'>alert('2');</script>";
           // $mail->addAddress('ellen@example.com');               // Name is optional
           // $mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('');
            //echo "<script type='text/javascript'>alert('3');</script>";
            //$mail->addBCC('bcc@example.com');

            // Attachments
            $mail->addAttachment('./uploaded/Somaiya_logo.png');         // Add attachments
           // echo "<script type='text/javascript'>alert('4');</script>";
           // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'HELLO CODERS GETTING READY TO ROCK WE ARE BACK AGAIN WITH A BOOM';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
           // echo "<script type='text/javascript'>alert('5');</script>";
            ///$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
           // echo "<script type='text/javascript'>alert('6');</script>";
           echo 'Message has been sent';
            $mail->ClearAddresses();  // each AddAddress add to list
            $mail->ClearCCs();
            //$mail->ClearBCCs();
    } 
    catch (Exception $e) 
    {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }*/
}

?>