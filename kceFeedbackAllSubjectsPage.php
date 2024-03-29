<?php

// include "connection.php";
session_start();
$rollno = $_SESSION['username'];
$password = $_SESSION['password'];
$_SESSION['number'] = 1;

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
$tableLastName = $reversedRoll[4].$reversedRoll[5];

$tableName = $tableFirstName.$tableLastName;


    $serverName = '127.0.0.1';
    $userName = 'root';
    $dbPassword = 'Gajendran@04';
    $databaseName = $tableFirstName.$reversedRoll[5].$reversedRoll[4];
    $serverPort = 3306;

    $connection =  new mysqli($serverName , $userName , $dbPassword , $databaseName , $serverPort);

if ($connection->connect_error) 
{
    die("Couldn't connect!!!" . $connection->connect_error);
}
else 
{
    
    
    
    $tableName = $_SESSION['tableName'];


    $sql_query = "SELECT * FROM $tableName WHERE rollno = '$rollno' AND password = '$password'";
    $result = $connection->query($sql_query);


    $sql_query_for_name = "SELECT  name , year , sem FROM $tableName WHERE rollno = '$rollno' AND password = '$password'";
    $name_result = $connection->query($sql_query);
    $student = $name_result->fetch_assoc();


    $_SESSION['name']  = $student['name'];
    $_SESSION['year']  = $student['year'];
    $_SESSION['sem'] = $student['sem'];

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KCE FEEDBACK COURSES</title>
    <!-- <script lang="Javascript" src="kceFeedbackAllSubjectsPage.js" defer></script> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- <link rel="stylesheet" href="kceFeedbackAllSubjectsPage.css"> -->
    <link rel="icon" href="https://res.cloudinary.com/dkbwdkthr/image/upload/v1694090918/KCE%20LOGO.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Finger+Paint&family=Roboto+Slab&display=swap");

.allTemplate {
  height: 460px;
}

.allTemplateCollegeNameMainContainer {
  display: flex;
  justify-content: center;
}

.allTemplateKceNameBox {
  padding: 20px;
  height: 270px;
  margin-top: 60px;
  backdrop-filter: blur(8px) saturate(140%);
  -webkit-backdrop-filter: blur(8px) saturate(140%);
  background-color: whitesmoke;
  border-radius: 13px;
  border: 2px solid rgba(162, 158, 154, 0.527);
  text-align: center;
}

.logoContainer {
  height: 120px;
  width: 120px;
  /* background-image: url("https://res.cloudinary.com/dkbwdkthr/image/upload/v1694090918/KCE%20LOGO.jpg"); */
  background-image: url("https://res.cloudinary.com/dkbwdkthr/image/upload/v1694825929/kce_logo_png.png");
  background-size: contain;
  background-repeat: no-repeat;
  background-position-x: center;
  background-position-y: bottom;
  background-color: white;
  background-blend-mode: darken;
  position: relative;
  top: -80px;
  margin-left: auto;
  margin-right: auto;
  border: 2px solid rgba(162, 158, 154, 0.527);
  border-radius: 100%;
}

.kceNameContainer {
  /* border: 1px solid red; */
  position: relative;
  top: -80px;
}

.kceName {
  font-size: 45px;
  letter-spacing: 5px;
  font-family: Cambria, Cochin, Georgia, Times, "Times New Roman", serif;
  font-weight: 900;
  color: #154f5d;
  margin-bottom: 0%;
}

.kceCollege {
  margin-top: -10px;
  margin-bottom: 0px;
  font-size: 20px;
  letter-spacing: 1px;
  color: #f25d01;
  font-weight: 600;
}

.kceCollegeQuotes {
  color: #154f5d;
  font-weight: 600;
  letter-spacing: 1px;
}

.discriptionContainer {
  /* border: 1px solid red; */
  width: fit-content;
  margin-right: auto;
  margin-left: auto;
  position: relative;
  top: -100px;
}

.kceCollegeQualifiedDetails {
  display: inline;
  font-size: 15px;
}

.hrLine {
  position: relative;
  top: -90px;
}

.kceCollegeCertificationDetails {
  display: inline;
  font-size: 12px;
  color: #f25d01;
  font-weight: 600;
  letter-spacing: 1px;
}

.allPageTemplateProfileMainContainer {
  height: 200px;
  display: flex;
  justify-content: center;
}

.studentProfileMainContainer {
  padding-right: 20px;
  padding-left: 20px;
  height: fit-content;
  margin-top: 2px;
  backdrop-filter: blur(8px) saturate(140%);
  -webkit-backdrop-filter: blur(8px) saturate(140%);
  background-color: whitesmoke;
  border-radius: 13px;
  border: 2px solid rgba(162, 158, 154, 0.527);
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
}

.studentProfileLogoContainer {
  background-color: transparent;
  height: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  /* border: 2px solid red; */
  margin: 2px;
}

.profileAndDetailsContainer {
  display: flex;
  justify-content: center;
}

.profileLogo {
  height: 65px;
  width: 65px;
  border-radius: 100%;
  background-color: gray;
  background-image: url("https://res.cloudinary.com/dkbwdkthr/image/upload/v1694826406/profile_wjw3og.png");
  background-size: cover;
  border: 1px solid black;
  margin: 0;
}

.profileNameContainer {
  height: 65px;
  width: 70%;
  margin-left: -25px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding-top: 5px;
  padding-left: 5px;
}

.studentName {
  font-size: 16px;
  color: #f25d01;
}

.studentRollNo {
  font-size: 15px;
}

.studentAcademyDetailsContainer {
  height: 50px;
  width: 250px;
  border: 2px solid rgba(162, 158, 154, 0.527);
  border-radius: 8px;
}

.studentAcademyDetails {
  width: 100%;
  height: 100%;
  color: #154f5d;
  font-weight: 700;
  display: flex;
  justify-content: center;
  align-items: center;
  letter-spacing: 3px;
}

/*This page design starts*/

#courses_info {
  width: 100%;
  border-collapse: collapse;
  border-radius: 7px;
  padding: 10px;
  border-style: hidden;
  box-shadow: 0 0 0 1px rgb(222, 221, 221);
  margin-top: 15px;
  border: 2px solid #154f5d;
}

.coursesTable {
  display: flex;
  justify-content: center;
}



td,tr,
th {
  border: 1px solid #393838;
  text-align: center;
  padding: 5px;
}
th {
  background-color: #154f5d;
  color: white;
  font-weight: 700;
  font-family: "Times New Roman", Times, serif;
}

.rowBottom{
    border: 2px solid #154f5d;
}
 /* td{
    border: 1px solid rgb(222, 221, 221);
} */
/*
.serial_no {
  border-top-left-radius: 7px;
}
.course_Title {
  border-top-right-radius: 7px;
} */
.table1 {
  display: flex;
  justify-content: center;
}
.table_heading {
  text-align: center;
}

.tutorTable {
  display: flex;
  justify-content: center;
  margin-top: 10px;
}

.tutor_info {
  width: auto;
  margin-right: auto !important;
  margin-left: auto !important;
}

.allSubjectsTeachersPage {
  margin-bottom: 20px;
}

.nextbtn_class {
  display: flex;
  justify-content: end;
  margin-top: 10px;
  margin-bottom: 30px;
  width: 90vw;
  .nextbtn {
    border-radius: 10px;
    background-color: #0d5b99;
    border: none;
    color: #ffffff;
    text-align: center;
    font-size: 1.2rem;
    padding: 0.5rem;
    width: 8.5rem;
    transition: all 0.5s;
    cursor: pointer;
    margin: 5px;
  }
  .nextbtn span {
    cursor: pointer;
    display: inline-block;
    position: relative;
    transition: 0.5s;
  }
  .nextbtn span:after {
    content: "\00bb";
    position: absolute;
    opacity: 0;
    top: 0;
    right: -20px;
    transition: 0.5s;
  }
  .nextbtn:hover span {
    padding-right: 25px;
  }

  .nextbtn:hover span:after {
    opacity: 1;
    right: 0;
  }
}
.footerScetion{
  height: 30px;
  width: 100%;
  background-color: #cac5c5;
  color: black;
  display: flex;
  justify-content: center;
  font-weight: 600;
  position: fixed;
  bottom: 0;
}

    </style>
</head>

<body>
    <div class="container-fluid allTemplate">
        <div class="row allTemplateCollegeNameMainContainer">
            <div class="col-11 col-md-10 col-lg-7  allTemplateKceNameBox">
                <div class="logoContainer"></div>
                <div class="kceNameContainer">
                    <h1 class="kceName">KARPAGAM</h1>
                    <p class="kceCollege">COLLEGE OF ENGINEERING</p>
                    <p class="kceCollegeQuotes">Rediscover | Refine | Redefine</p>
                </div>
                <hr class="hrLine" />
                <div class="discriptionContainer">
                    
                    <p class="kceCollegeQualifiedDetails">Autonomous | Affiliated to Anna University</p>
                    <br />
                    <p class="kceCollegeQualifiedDetails">Coimbatore 641032</p>
                    <br />
                    <p class="kceCollegeCertificationDetails">(An ISO 9001:2015 and ISO 14001:2015 Certified
                        Institution)</p>
                </div>
            </div>
        </div>
        <div class="row allPageTemplateProfileMainContainer">
            <div class="col-11 col-md-10 col-lg-7  studentProfileMainContainer">
                <div class="container-fluid">
                    <div class="row profileAndDetailsContainer">
                        <div class="col-12 col-md-5 col-lg-5 studentProfileLogoContainer">
                            <!-- <div class="profileLogo"></div> -->
                            <div class="profileNameContainer">
                                <h1 class="studentName"><?php echo $student['name']; ?></h1>
                                <h2 class="studentRollNo"><?php echo $rollno ?></h2>
                            </div>
                        </div>
                        <div class="col-12 col-md-5 col-lg-5 studentProfileLogoContainer">
                            <div class="studentAcademyDetailsContainer">
                                <p class="studentAcademyDetails">
                                    <!-- <span id="batchNo">22</span>| -->
                                    <span id="academyYear"><?php echo $student['year'] ?></span>|
                                    <span id="monthOfFeedback">Sem: <?php echo $_SESSION['sem'] ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="container-fluid allSubjectsTeachersPage">
        <div class="row tutorTable">
            <div class="col-11 col-md-11 col-lg-6">
                <table class="tutor_info">
                    <tr>
                        <th style="text-align: center; border: 1px solid #154f5d;">Tutor Name :</th>
                        <td style="text-align: center; border: 1px solid #154f5d;">Shamadhani Begum</td>
                    </tr>
                </table>
            </div>
        </div>
    </div> -->
    <div class="container-fluid">
        <div class="row coursesTable">
            <div class="col-12 col-md-8 col-lg-8">
                <table id="courses_info">
                    <!-- <tr>
                        <th class="serial_no table_heading">S.No</th>
                        <th class="table_heading">Course Code</th>
                        <th class="table_heading">Course Name</th>
                        <th class="staff_name table_heading">Staff Name</th>
                    </tr> -->
                    <tr>
                        <th class="serial_no table_heading" rowspan="2">S.No</th>
                        <th class="table_heading">Course Code</th>
                        <th class="course_Title table_heading">Course Title</th>
                    </tr>
                    <tr>
                        <th class="staff_name table_heading" colspan="2">Staff Name</th>
                    </tr>
                    <?php
                        if ($result->num_rows > 0) {
                            $sno = 1;
                            $number = 1;
                            $totalSubCount = 0;
                            while ($row = $result->fetch_assoc()) {
                                $coursecode = $row['coursecode'];
                                $coursename = $row['coursename'];
                                $facultyName = $row['facultyName'];
                                $_SESSION['coursecode'.$number] = $coursecode;
                                $_SESSION['coursename'.$number] = $coursename;
                                $_SESSION['facultyName'.$number] = $facultyName;
                                echo "<tr class='rowBottom'><tr>
                                        <td rowspan='2'>$sno .</td>
                                        <td>$coursecode</td>
                                        <td>$coursename</td>
                                    </tr>
                                    <tr >
                                        <td colspan='2'>$facultyName</td>
                                    </tr></tr>";

                                

                                $sno++;
                                $number++;
                                $totalSubCount++;
                            }
                            $_SESSION['totalsubcount'] = $totalSubCount;
                        } else {
                            echo "No results found.";
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div class="nextbtn_class">
        <button class="nextbtn" onclick="changePage()"><span>Continue</span></button>
    </div>
    <div class="footerScetion">
      Made with ❤️ by Gajendran 717822P215
    </div>
    <script>
        function changePage()
        {
            window.location.assign('kceStudentStarPage.php');
        }
        
    </script>
</body>

</html>