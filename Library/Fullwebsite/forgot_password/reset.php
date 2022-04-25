<?php
$to = 'cyb37v3n0m@gmail.com';
$subject = 'Hello from XAMPP!';
$message = 'This is a test';
$headers = "From: morganokumu8@gmail.com\r\n";
if (mail($to, $subject, $message, $headers)) {
   echo "SUCCESS";
} else {
   echo "ERROR";
}