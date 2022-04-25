<?php
ob_start();
session_start();
if ( isset( $_COOKIE[ 'name' ] ) ) {
    if ( isset( $_SESSION[ 'adminID' ] ) ) {
        session_destroy();
        unset( $_SESSION[ 'adminID' ] );
        unset( $_SESSION[ 'First_name' ] );
        unset( $_SESSION[ 'Sir_name' ] );
        unset( $_SESSION[ 'Last_name' ] );
        unset( $_SESSION[ 'RegNumber' ] );
        unset( $_SESSION[ 'ID_Number' ] );
        unset( $_SESSION[ 'Phone_Number' ] );
        unset( $_SESSION[ 'Email' ] );
        unset( $_SESSION[ 'Gender' ] );
        unset( $_SESSION[ 'Faculty' ] );
        header( 'Location: index.html' );
        setcookie( 'name', '', time()-3600 );
    }
    if ( isset( $_SESSION[ 'user_id' ] ) ) {
        session_destroy();
        unset( $_SESSION[ 'user_id' ] );
        unset( $_SESSION[ 'First_name' ] );
        unset( $_SESSION[ 'Sir_name' ] );
        unset( $_SESSION[ 'Last_name' ] );
        unset( $_SESSION[ 'RegNumber' ] );
        unset( $_SESSION[ 'ID_Number' ] );
        unset( $_SESSION[ 'Phone_Number' ] );
        unset( $_SESSION[ 'Email' ] );
        unset( $_SESSION[ 'Gender' ] );
        unset( $_SESSION[ 'Faculty' ] );
        header( 'Location: index.html' );
        setcookie( 'name', '', time()-3600 );
    }
} else {
    header( 'Location: dashboard/index.php' );
}
header( 'Location: ./login.php' );
?>