<?php
session_start();
require_once 'connect.php';
if ( isset( $_SESSION[ 'adminID' ] ) != '' ) {
    header( 'Location: admin/' );
} elseif ( isset( $_SESSION[ 'user_id' ] ) != '' ) {
    header( 'Location: dashboard/' );
}
if ( isset( $_POST[ 'login' ] ) ) {
    $email = mysqli_real_escape_string( $conn, $_POST[ 'email' ] );
    $password = mysqli_real_escape_string( $conn, $_POST[ 'password' ] );
    if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
        $email_error = 'Please Enter Valid Email ID';
    } else {
        if ( strlen( $password ) < 8 ) {
            $password_error = 'Password must be minimum of 8 characters';
        } else {

            $em = mysqli_query( $conn, "SELECT * FROM users1 WHERE email = '" . $email. "'" );
            if ( empty( $em ) ) {
                $error_message = 'Incorrect Email or Password!!!';
            } else {
                $result = mysqli_query( $conn, "SELECT * FROM users1 WHERE email = '" . $email. "' and password = '" . md5( $password ). "'" );
                if ( !empty( $result ) ) {
                    $perror_message = 'Incorrect Email or Password Try Again!!!';
                    if ( $row = mysqli_fetch_array( $result ) ) {
                        $_SESSION[ 'user_id' ] = $row[ 's_id' ];
                        $_SESSION[ 'First_name' ] = $row[ 'Firstname' ];
                        $_SESSION[ 'Sir_name' ] = $row[ 'Sirname' ];
                        $_SESSION[ 'Last_name' ] = $row[ 'Lastname' ];
                        $_SESSION[ 'RegNumber' ] = $row[ 'RegNumber' ];
                        $_SESSION[ 'ID_Number' ] = $row[ 'IDNumber' ];
                        $_SESSION[ 'Phone_Number' ] = $row[ 'PhoneNumber' ];
                        $_SESSION[ 'Email' ] = $row[ 'email' ];
                        $_SESSION[ 'Gender' ] = $row[ 'Gender' ];
                        $_SESSION[ 'Faculty' ] = $row[ 'Faculty' ];
                        // cookie
                        // Setting a cookie
                        setcookie( 'name', ''.md5( $_SESSION[ 'First_name' ] ).'', time()+30*24*60*60 );

                        // get my image
                        $image = mysqli_query( $conn, "SELECT * FROM images1 WHERE Username = '".$_SESSION[ 'First_name' ]."' and ID_NUMBER = '".$_SESSION[ 'ID_Number' ]."'" );
                        if ( $image->num_rows > 0 ) {
                            if ( $row = mysqli_fetch_array( $image ) ) {
                                $_SESSION[ 'realimage' ] = $row[ 'name' ];
                                $_SESSION[ 'uploadok' ] = 0;
                            }
                        } else {
                            $_SESSION[ 'uploadok' ] = 1;
                            $_SESSION[ 'realimage' ] = 'index.jpeg';
                            $_SESSION[ 'image_error' ] = 'No Image Found In Our Database';
                        }
                        $admin = mysqli_query( $conn, "SELECT * FROM staff1 WHERE Firstname = '".$_SESSION[ 'First_name' ]."' and IDNumber = '".$_SESSION[ 'ID_Number' ]."' and password = '". md5( $password )."'" );
                        if ( $admin->num_rows <= 0 ) {
                            if (isset($_SERVER['HTTP_REFERER'])){
                                header('location: '.$_SERVER['HTTP_REFERER'].'');
                            }
                            header( 'Location: dashboard/' );
                        } else {
                            if ( $row = mysqli_fetch_array( $admin ) ) {
                                $_SESSION[ 'adminID' ] = $row[ 'A_ID' ];
                                unset( $_SESSION[ 'user_id' ] );
                                if (isset($_SERVER['HTTP_REFERER'])){
                                    header('location: '.$_SERVER['HTTP_REFERER'].'');
                                }
                                header( 'Location: ./admin' );
                            }

                        }
                    }
                } else {
                    $error_message = 'Incorrect Email or Password!!!';
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang = 'en'>

<head>
<meta charset = 'UTF-8'>
<meta http-equiv = 'X-UA-Compatible' content = 'IE=edge'>
<meta name = 'viewport' content = 'width=device-width, initial-scale=1.0'>
<link rel = 'stylesheet' type = 'text/css' href = 'style.css' media = 'screen' />
<title>Login Page</title>
</head>

<body>
<form class = 'box' action = '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method = 'post'>

<h1>Login</h1>
<input type = 'email' name = 'email' placeholder = 'Email'>
<span class = 'text-danger'><?php if ( isset( $email_error ) ) echo $email_error;
?></span>
<input type = 'password' name = 'password' placeholder = 'Password'>
<span class = 'text-danger'><?php if ( isset( $password_error ) ) echo $password_error;
?></span>
<span class = 'text-danger'><?php if ( isset( $perror_message ) ) echo $perror_message;
?></span>
<span class = 'text-danger'><?php if ( isset( $error_message ) ) echo $error_message;
?></span>
<input name = 'login' value = 'submit' type = 'submit'>
<h3 style = 'color: blue;'>You don't have an account?</h3><a style = 'width: 30%;
color: pink;
background: darkcyan;
' href = 'registration.php'>Click Here</a>
</form>

<div class = 'lines'>
<div class = 'line'></div>
<div class = 'line'></div>
<div class = 'line'></div>
<div class = 'line'></div>
<div class = 'line'></div>
<div class = 'line'></div>
<div class = 'line'></div>
<div class = 'line'></div>
<div class = 'line'></div>
<div class = 'line'></div>
<div class = 'line'></div>
<div class = 'line'></div>
<div class = 'line'></div>
<div class = 'line'></div>
<div class = 'line'></div>
<div class = 'line'></div>
<div class = 'line'></div>
<div class = 'line'></div>
<div class = 'line'></div>
</div>
</body>

</html>