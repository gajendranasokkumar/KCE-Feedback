<?php
$dbname = $_GET['dbname'];
$tablename = $_GET['tablename'];
 
$host = '127.0.0.1';
$dbuser = 'root';
$dbpass = 'Gajendran@04';
$mysqli = new mysqli($host, $dbuser, $dbpass);



$statusConn =  new mysqli($host, $dbuser, $dbpass, 'admin');

if ($statusConn->connect_error) {
    die("Connection failed: " . $statusConn->connect_error);
}
$retriveData = "DELETE FROM alldbname WHERE databasename = '$dbname' and tablename= '$tablename'";
$result_fetch = $statusConn->query($retriveData);



if ($mysqli->connect_errno) {
    printf("Connect failed: %s<br />", $mysqli->connect_error);
    exit();
}

if ($mysqli->query("Drop DATABASE $dbname")) {
    printf("Database $dbname => $tablename dropped successfully.<br />");
}
if ($mysqli->errno) {
    printf("Could not drop database: %s<br />", $mysqli->error);
}
$mysqli->close();
?>
<html>
<head>
    <style>
        .mainBody{
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .mainBox{
            height: 300px;
            width: 300px;
            color: white;
            background-color: green;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

        }
        .backButtonContainer{
            height: 70px;
            width: auto;
            margin: 15px;
            border-radius: 100%;
            border: 5px solid orange;
            display: flex;
            background-color: white;
            justify-content: center;
            align-items: center;
            font-weight: 900;
            font-size: 25px;
        }
    </style>
</head>
<body class="mainBody">
<div class="mainBox">
    <a href="viewstatus.php"><div class="backButtonContainer">GO BACK</div></a>
</div>
</body>

</html>