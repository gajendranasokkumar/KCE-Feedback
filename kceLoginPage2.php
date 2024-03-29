<?php 
    session_destroy();
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

       
        $rollno = $_POST['username'];//717821p215
        $password = $_POST['password'];
        if(($rollno == "principal" && $password == "12345") || ($rollno == "deen" && $password == "12345"))
        {
            echo "<script> window.location.assign('adminreport.php'); </script>";
        }
        else if($rollno == "admin" && $password == "12345"){
            echo "<script> window.location.assign('admin.php'); </script>";
        }
        else
        {

        //512p128717
        //0123456789
        $reversedRoll = str_split(strrev($rollno));
        $tableFirstName = "";
        $tableLastName = "";
        switch($reversedRoll[3])
        {
            case "P":
            case "p":
                $tableFirstName = "cse";
                break;
            case "T":
            case "t":
                $tableFirstName = "ete";
                break;
            case "C":
            case "c":
                $tableFirstName = "civil";
                break;
            case "F":
            case "f":
                $tableFirstName = "it";
                break;
            case "L":
            case "l":
                $tableFirstName = "ece";
                break;
            case "E":
            case "e":
                $tableFirstName = "eee";
                break;
            case "S":
            case "s":
                $tableFirstName = "cst";
                break;
            case "Y":
            case "y":
                $tableFirstName = "cyber";
                break;
            case "M":
            case "m":
                $tableFirstName = "mech";
                break;
            case "D":
            case "d":
                $tableFirstName = "csd";
                break;
            case "I":
            case "i":
                $tableFirstName = "ai";
                break;
        }


        $serverName = '127.0.0.1';
        $userName = 'root';
        $dbPassword = 'Gajendran@04';
        $databaseName = $tableFirstName.$reversedRoll[5].$reversedRoll[4];
        $serverPort = 3306;
        $connection =  new mysqli($serverName , $userName , $dbPassword , $databaseName , $serverPort);


        


        switch($reversedRoll[2])
        {
            case "1":
                $tableLastName = "a";
                break;
            case "2":
                $tableLastName = "b";
                break;
            case "3":
                $tableLastName = "c";
                break;
            case "4":
                $tableLastName = "d";
                break;
            case "5":
                $tableLastName = "e";
                break;
        }

        $tableName = $tableFirstName.$tableLastName;
        $_SESSION['tableName'] = $tableName;

        $sql_query = "SELECT * FROM $tableName WHERE rollno = '$rollno' AND password = '$password'";
        $result = mysqli_query($connection,$sql_query);
        $check = mysqli_fetch_array($result);
        if(isset($check)){
            if($check["session"] == 1)
            {
                // echo "You hace already submitted your feedback";
                echo "<script>window.location.assign('kceFeedbackAlreadySubmitted.html');</script>";
            }
            else
            {
                $_SESSION['username'] = $rollno;
                $_SESSION['password'] = $password;
                echo "<script> window.location.assign('kceFeedbackAllSubjectsPage.php'); </script>";
            }
        }
        else
        {
            echo "<script> alert('Invalid Username and password'); </script>";
            echo "<script> window.location.assign('kceLoginPage.php'); </script>";
        }
    }
    }
?>