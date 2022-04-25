<?php
// this php script is for connecting with database
// data have to fetched from local server
$servername = 'localhost';

// user name is root
$username = 'root';
$password = 'root';
$database = 'library';
$conn = new mysqli( $servername, $username, $password, $database );
if ( $conn-> connect_error ) {
    die( 'connection failed :' .$conn-> $connect_error );
} else {

}

?>