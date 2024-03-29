<?php      
//   if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
//       echo 'We don\'t have mysqli!!!';
//   } else {
//       echo 'Phew we have it!';
//   }

    $serverName = '127.0.0.1';
    $userName = 'root';
    $dbPassword = 'Gajendran@04';
    $databaseName = 'student';
    $serverPort = 3306;

    $connection =  new mysqli($serverName , $userName , $dbPassword , $databaseName , $serverPort);

?>
