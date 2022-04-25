<?php
session_start();
require_once "../connect.php";
if(isset($_SESSION['user_id'])) {
header("Location: ../dashboard/");
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if (isset($_POST['login'])) {
    $Email = mysqli_real_escape_string($conn, $_POST['email']);
    $idnumber = mysqli_real_escape_string($conn, $_POST['idnumber']);
    $em = mysqli_query($conn,"SELECT * FROM reg_members WHERE email = '" . $Email. "'");
    if(!filter_var($Email,FILTER_VALIDATE_EMAIL)) {
    $email_error = "Please Enter Valid Email ID";
    }else{
    if(strlen($idnumber) < 7) {
    $idnumber_error = "ID number must be minimum of 7 characters";
}else{
    if(!empty($em)){
        $error_message = "The email or id number provided is not registered yet!!!";
        $result = mysqli_query($conn, "SELECT * FROM reg_members WHERE email = '" . $Email. "' and IDNumber = '" . $idnumber. "'");
        if ($row = mysqli_fetch_array($result)) {
        $_SESSION['First_name'] = $row['Firstname'];
        $_SESSION['Sir_name'] = $row['Sirname'];
        $_SESSION['Last_name'] = $row['Lastname'];
        $_SESSION['OTP'] = rand(1000,9999);
        $name1 = $_SESSION['First_name'];
        $name3 = $_SESSION['Last_name'];
        $otp = $_SESSION['OTP'];

        require_once('../PHPMailer-master/src/PHPMailer.php');
        require_once('../PHPMailer-master/src/Exception.php');
        require_once('../PHPMailer-master/src/SMTP.php');
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    //Set the SMTP server to send through
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = "tls";
            $mail->Fullname   = 'MORGAN OKUMU'.                                   //Enable SMTP authentication
            $mail->Username   = 'morganokumu8@gmail.com';                     //SMTP username
            $mail->Password   = '*123*vybz';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('morganokumu@gmail.com', 'FRIENDS SACCO');
            $mail->addAddress($Email, $name1);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "FRIENDS SACCO PASSWORD RESET CODE";
            $mail->Body    = $name1. " ". $name3. " ". $otp. "is your password rest code.";
            $mail->AltBody = 'Do not share the code.';
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    }
    }
    }
}
?>
<!DOCTYPE html>
<!-- Created By CodingNepal and V3N0M- www.codingnepalweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!-- <title> Responsive Drop Down Navigation Menu | CodingLab </title>-->
    <link rel="stylesheet" href="../style1.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="index.css" media="screen" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> RESET PASSWORD | FRIENDS SACCO</title>
</head>
<form class="box" action='reset.php' method="post">
        
        <h1>INPUT YOUR EMAIL AND ID NUMBER</h1>
        <input type="email" name="email" placeholder="Email">
        <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
        <input type="text" name="idnumber" placeholder="id number">
        <span class="text-danger"><?php if (isset($idnumber_error)) echo $idnumber_error; ?></span>
        <span class="text-danger"><?php if (isset($error_message)) echo $error_message; ?></span>
        <input name="login" value="submit" type="submit">
        <h3 style="color: blue;">You don't have an account?</h3><a style="width: 30%; color: pink; background: darkcyan;" href="registration.php">Click Here</a>


    <div class="lines">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
<body>
</body>

</html>