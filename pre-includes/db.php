<?php
// DATABASE CONNECTION //
@session_start();
$con = mysqli_connect( '127.0.0.1', 'clinic', '12Aguacate34', 'clinic');
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>
