<?php 
    // include ("connection.php");
    session_start();
$rollno = $_SESSION['username'];
    //512p128717
    //0123456789
$reversedRoll = str_split(strrev($rollno));
$tableFirstName = "";
$tableLastName = "";
$tableSection = "";

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

switch($reversedRoll[2])
{
    case "1":
        $tableSection = "a";
        break;
    case "2":
        $tableSection = "b";
        break;
    case "3":
      $tableSection = "c";
      break;
    case "4":
      $tableSection = "d";
      break;
    case "5":
      $tableSection = "e";
      break;
    case "6":
      $tableSection = "f";
      break;
    case "7":
      $tableSection = "g";
      break;
}

$tableLastName = $reversedRoll[4].$reversedRoll[5];

$tableName = $tableFirstName.$tableLastName;

    $serverName = '127.0.0.1';
    $userName = 'root';
    $dbPassword = 'Gajendran@04';
    $databaseName = $tableFirstName.$reversedRoll[5].$reversedRoll[4];
    $serverPort = 3306;
  $batchno = substr($_SESSION['year'],-2);
    $connection =  new mysqli($serverName , $userName , $dbPassword , $databaseName , $serverPort);
    if($_SESSION['number'] === 1)
    {
        $tablesQuery = "SHOW TABLES";
        $resultRowOfAlltable = $connection->query($tablesQuery);

        $questionTable = "";
        if ($resultRowOfAlltable) {
            while ($row = $resultRowOfAlltable->fetch_row()) {
                if(str_ends_with($row[0] , "question"))
                {
                    $questionTable = $row[0];
                }
                if(str_ends_with($row[0] , "result") && str_starts_with($row[0] , $tableFirstName.$tableSection))
                {
                    $_SESSION['resultTable'] = $row[0];
                }
            }
            $resultRowOfAlltable->free(); 
        } else {
            echo "Error fetching tables: " . $connection->error;
        }

        // echo "-------------------------$questionTable";

        $questionSelectQuery = "SELECT * FROM $questionTable";
        $allQuestionsFetch = $connection->query($questionSelectQuery);
        $allQuestions = $allQuestionsFetch->fetch_assoc();
        // $_SESSION['$allQuestions'] = $allQuestions;
        $_SESSION['$allQuestions'] = array_filter($allQuestions, function($x) { return !empty($x); });
        // print_r($_SESSION['$allQuestions']);
        // $_SESSION['allQuestions'] = $allQuestionsFetch->fetch_all(MYSQLI_ASSOC);

        $value = "";
        // for( $i = 1; $i <= count($_SESSION['$allQuestions']);$i++)
        // {
        //     echo $_SESSION['$allQuestions']["q$i"].$value."<br>";
        // }
        // echo  count($_SESSION['$allQuestions']);
        // if($allQuestions){
            // foreach($_SESSION['$allQuestions'] as $question){
            //     echo $question."<br/>";
            // }
        // }

    }
    try{
        $rollno = $_SESSION["username"];
        $coursecode = $_SESSION['coursecode' . $_SESSION['number']];
        $coursename = $_SESSION['coursename' . $_SESSION['number']];
        $facultyname = $_SESSION['facultyName' . $_SESSION['number']];
        if($_SESSION['number'] != 1)
        {
            $starResult = array();
            $cc = 'coursecode'. ($_SESSION['number'] - 1);
            $starResult[$cc] = array();
            $c = count(array_filter($_SESSION['$allQuestions'], function($x) { return !empty($x); }));
            for($i = 1;$i<=$c;$i++)
            {
                array_push($starResult[$cc] , $_POST['rate' . $i]);
            }
            $_SESSION[$_SESSION[$cc]] = $starResult[$cc];
            
            // echo "<pre>";
            //     print_r($_SESSION);
            // echo "</pre>";


            // if(isset($_SESSION[$_SESSION[$cc]]))
            // {
            //     echo "settt!!!!<br>";
            // }
            // foreach($_SESSION[$_SESSION[$cc]] as $val)
            // {
            //     echo $val;
            // }
        }
    }

      catch (Exception $e) {
        // Handle the exception.
        // echo 'Caught exception: ',  $e->getMessage(), "\n";
        echo " ";
    }


    if($_SESSION['totalsubcount'] < $_SESSION['number'])
    {
        $rollno = $_SESSION["username"];
        $name = $_SESSION['name'];
        $insertCount = 0;
        $resultTable = $_SESSION['resultTable'];
        for($i= 1; $i <= $_SESSION['totalsubcount'] ; $i++)
        {
            $insertSql = "INSERT INTO $resultTable (rollno, name, dept, batch, sem, coursecode, coursename, facultyName"; 
            $c = count(array_filter($_SESSION['$allQuestions'], function($x) { return !empty($x); }));
            for($k=1;$k<=$c;$k++)
            {
                $insertSql .= ",Q$k";
            }

            $insertSql = rtrim($insertSql,",") . ")";

            $insertSql  .= "VALUES ('$rollno', '$name', 'CSE', $batchno, 5,";
            $code =  $_SESSION['coursecode' . $i];
            $course = $_SESSION['coursename' . $i];
            $facultyname = $_SESSION['facultyName' . $i];
            $insertSql .= "'$code', '$course', '$facultyname'";

            foreach ($_SESSION[$_SESSION['coursecode' . $i]] as $val) {
                $insertSql .= ", '$val'";
            }

            $insertSql .= ")";
            if ($connection->query($insertSql) === TRUE) {
               $insertCount++;
            } else {
                echo "Error creating table: " . $connection->error;
            }
        }

        if($insertCount == $_SESSION['totalsubcount'])
        {
            $rollno = $_SESSION["username"];
            $updateTable = $tableFirstName.$tableSection;
            $update_session = "UPDATE $updateTable SET session = 1 WHERE rollno = '$rollno'";
            if ($connection->query($update_session) === TRUE)
            {
                session_destroy();
                echo "<script>window.location.assign('kceFeedbackThankYouPage.html');</script>";
            }
        }
        else
        {
            echo "cannot Submit your feedback!!";
        }
    }
    $_SESSION['number']++; 
    $value = "";                  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" >
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>KCE STUDENT RATINGS</title>
    <link rel="icon" href="https://res.cloudinary.com/dkbwdkthr/image/upload/v1694090918/KCE%20LOGO.jpg">
    <link rel="stylesheet" href="kceStudentStarPage.css">
    <!-- <script src="kceStudentStarPagenew.js" defer></script> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
        crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,300,1,0" />
    </head>
    <!-- <script src="kceFeedbackStarPAge.js" defer></script> -->
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Finger+Paint&family=Roboto+Slab&display=swap");

body {
  overflow-x: hidden;
}

.allTemplate {
  height: 460px;
}

.allTemplateCollegeNameMainContainer {
  display: flex;
  justify-content: center;
  margin-bottom: 5px;
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
  height: 85px;
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

::-webkit-scrollbar {
  width: 4px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 5px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555;
}

.page {
  display: flex;
  justify-content: center;
  align-items: center;
  height: auto;
}

.main-feedback-page {
  height: 100%;
}

.head {
  height: 25%;
  width: 100%;
  background-color: rgba(255, 0, 0, 0.577);
  border-radius: 2rem;
  margin-top: 0.5rem;
}

.User-details {
  height: 10%;
  background-color: rgba(0, 0, 255, 0.56);
  border-radius: 2rem;
}

.feedback-content {
  height: 65%;
  margin-right: auto;
  margin-left: auto;
}

.staff-details {
  height: 10%;
  display: grid;
  grid-template-columns: 1fr 2fr 2fr;
  grid-template-rows: 100%;
  margin-top: 1rem;
  margin-bottom: 1rem;
}

.staff-details p {
  border: 2px solid rgba(162, 158, 154, 0.527);
  display: grid;
  place-content: center;
  font-weight: bold;
  font-size: 14px;
  text-align: center;
  line-height: 16px;
  padding: 5px;
}

.staff-details :nth-child(1) {
  color: black;
}

.staff-details :nth-child(2) {
  color: #154f5d;
}

.staff-details :nth-child(3) {
  color: #f25d01;
}

.staff-feedback {
  height: 90%;
  padding-bottom: 20px;
}

.table-content {
  height: auto;
  border: 2px solid rgba(162, 158, 154, 0.527);
  border-radius: 5px;
  display: grid;
  grid-template-columns: 10% 60% 30%;
  grid-template-rows: 70% 30%;
  margin-top: 5px;
}

.table-content :nth-child(1) {
  grid-row: 1/3;
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
  font-weight: 500;
}

.table-content :nth-child(2) {
  grid-row: 1/3;
  font-weight: 600;
}

.table-content :nth-child(3) {
  grid-row: 1/3;
}

.table-content div p {
  padding: 0;
  margin: 0;
}

.table-content div {
  width: 100%;
}

.sno-block {
  border-right: 2px solid rgba(162, 158, 154, 0.527);
  display: grid;
  place-content: center;
  color: #f25d01;
}

.sNo {
  font-size: 20px;
}

.question-block {
  border-right: 2px solid rgba(162, 158, 154, 0.527);
  display: grid;
  place-content: left;
  height: 100%;
  padding: 7px;
  text-align: left;
}

.qusetionPara {
  line-height: 20px;
  letter-spacing: 0.5px;
  text-align: left;
  height: 100%;
}

.star-container {
  height: auto;
  display: flex;
  justify-content: center;
  align-items: center;
}

@media screen and (max-width: 800px) {
  .allPageTemplateProfileMainContainer {
    height: 130px;
  }

  .staff-details{
    font-size: 12px;
  }

  .table-content :nth-child(2) {
    grid-column: 2/4;
    grid-row: 1/2;
    border-right: none;
  }

  .star-block {
    padding-left: 45px;
    padding-right: 45px;
  }

  .question-block {
    border-bottom: 2px solid rgba(162, 158, 154, 0.527);
    height: fit-content;
    margin-bottom: 0px;
  }

  label{
    margin-top: -15px;
    margin-bottom: 15px;
  }

  .qusetionPara {
    letter-spacing: 0.5px;
    text-align: left;
  }

  .table-content :nth-child(3) {
    grid-column: 2/4;
    grid-row: 2/3;
  }
}

.rate {
  height: 100%;
  width: 100%;
  display: flex;
  flex-direction: row-reverse;
  justify-content: center;
}
.rate:not(:checked) > input {
  display: none;
  width: 65px;
}
.rate:not(:checked) > label {
  width: 1em;
  overflow: hidden;
  letter-spacing: 50px;
  white-space: nowrap;
  cursor: pointer;
  font-size: 40px;
  color: #ccc;
}
.rate:not(:checked) > label:before {
  content: "★ ";
}
.rate > input:checked ~ label {
  color: #ffc700;
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
  color: #ffc700;
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
  color: #c59b08;
}



.nextbtn_class{
  display: flex;
  justify-content: end;
  margin-top: 10px;
  margin-bottom: 30px;
  width: 90vw;
  .nextbtn{
      border-radius: 10px;
      background-color: #0D5B99;
      border: none;
      color: #FFFFFF;
      text-align: center;
      font-size: 1.2rem;
      padding: 0.5rem;
      width: 8.5rem;
      transition: all 0.5s;
      cursor: pointer;
      margin: 5px;
  }
  .nextbtn span{
      cursor: pointer;
      display: inline-block;
      position: relative;
      transition: 0.5s;
  }
  .nextbtn span:after {
      content: '\00bb';
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

.notselectedMaincontainer{
  display: flex;
  justify-content: center;
}


.notselectedmessage{
  height: 60px;
  width: 260px;
  margin: 10px;
  background-color: rgba(245, 45, 45);
  /* box-shadow: 0 4px 5px 0 rgba(255, 0, 89, 0.537), 0 6px 20px 0 rgba(255, 0, 89, 0.636); */
  box-shadow: rgba(33, 72, 37, 0.384) 0px 13px 27px -5px, rgba(34, 65, 31, 0.3) 0px 8px 16px -8px;
  margin-right: auto;
  margin-left: auto;
  position: fixed;
  right: auto;
  left: auto;
  z-index: 2;
  display: flex;
  justify-content: center;
  align-items: center;
  color: white;
  font-size: 16px;
  font-weight: 600;
  border-radius: 7px;
  /* top: -100px; */
  /* animation: fadeIn 1.4s 1; */
}

.top{
  top: -100px;
}

.fadeins{
  animation: fadeIn 0.5s 1; 
  /* color: #0D5B99; */
}

.fadeout{
  animation: fadeOut 0.5s 1; 
}

@keyframes fadeIn {
  0% { opacity: 0; top: -100px;}
  100% { opacity: 1; top: 0px;}
}

@keyframes fadeOut {
  0% { opacity: 1; top: 0px;}
  100% { opacity: 0; top: -100px;}
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
<body>                    
<div class="notselectedMaincontainer" >
        <div class="notselectedmessage top" id="alertPopUp">
            Give Answer For All Questions
        </div>
    </div>
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
                                <h1 class="studentName"><?php echo $_SESSION['name']  ?></h1>
                                <h2 class="studentRollNo"><?php echo $rollno  ?></h2>
                            </div>
                        </div>
                        <div class="col-12 col-md-5 col-lg-5 studentProfileLogoContainer">
                            <div class="studentAcademyDetailsContainer">
                                <p class="studentAcademyDetails">
                                    <!-- <span id="batchNo">22</span>| -->
                                    <span id="academyYear"><?php echo $_SESSION['year']; ?></span>|
                                    <span id="monthOfFeedback">Sem: <?php echo $_SESSION['sem'] ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
            <div class="row page">
                <div class="col-12 col-md-10 col-lg-8  feedback-content">
                    <div class=" staff-details">
                        <p><?php echo $coursecode; ?></p>
                        <p><?php echo $coursename; ?></p>
                        <p><?php echo $facultyname; ?></p>
                    </div>

                </div>
                <form action="kceStudentStarPage.php" method="post" id="starform">
                    <div class="staff-feedback" id="studentFeedbackStarContainer">
                        
                    </div>
                </form>
            </div>
            <div class="nextbtn_class">
                <!-- <input class="nextbtn" type="submit" onclick="changePage()" value="Submit" /> -->
                <button class="nextbtn" onclick="checkRadioButtons(event)" type="submit">Submit</button>
            </div>
    </div>
    <div class="footerScetion">
      Made with ❤️ by Gajendran 717822P215
    </div>
   <script>
        let starRatingMainContainer = document.getElementById('studentFeedbackStarContainer');

        let fragment = document.createDocumentFragment();
        let questionsArray = ["summa"];
        <?php 
            for($i = 1; $i <= count($_SESSION['$allQuestions']); $i++) {
                $question = htmlspecialchars($_SESSION['$allQuestions']["q$i"] . $value);
                if(empty($question))
                {
                  break;  
                }
        ?>
        questionsArray.push(<?php echo json_encode($question); ?>);
        <?php } ?>

        for (let i = 1; i < questionsArray.length; i++){
            let starBlock = document.createElement('div');
            starBlock.classList.add('table-content');
            starBlock.innerHTML = `
                <div class="sno-block">
                    <p class="sNo">${i}.</p>
                </div>
                <div class="question-block">
                    <p class="qusetionPara">${questionsArray[i]}</p>
                </div>
                <div class="star-container">
                    <div class="star-block" id="starContainer">
                        <div class="rate">
                            <input type="radio" id="star5${i}" name="rate${i}" value="5" />
                            <label for="star5${i}" title="5 Stars">5 stars</label>
                            <input type="radio" id="star4${i}" name="rate${i}" value="4" />
                            <label for="star4${i}" title="4 Stars">4 stars</label>
                            <input type="radio" id="star3${i}" name="rate${i}" value="3" />
                            <label for="star3${i}" title="3 Stars">3 stars</label>
                            <input type="radio" id="star2${i}" name="rate${i}" value="2" />
                            <label for="star2${i}" title="2 Stars">2 stars</label>
                            <input type="radio" id="star1${i}" name="rate${i}" value="1" />
                            <label for="star1${i}" title="1 Star">1 star</label>
                        </div>
                    </div>
                </div>
            `;

            fragment.appendChild(starBlock);
        }

        starRatingMainContainer.appendChild(fragment);

        
        
          
      let alertPopUp = document.getElementById('alertPopUp');

      function hidePopup(){
          document.getElementById('alertPopUp').classList.remove('fadeins');
          document.getElementById('alertPopUp').classList.add('fadeout' , 'top');
      }

      function checkRadioButtons(event) {
        event.preventDefault();
          // Loop through each radio group
          let allselected = 1;
          for (let i = 1; i < questionsArray.length; i++) {
            allselected = 1;
              const groupName = 'rate' + i;
              const radioButtons = document.getElementsByName(groupName);

              // Check if any radio button in the group is selected
              let isSelected = false;
              for (let j = 0; j < radioButtons.length; j++) {
                  if (radioButtons[j].checked) {
                      isSelected = true;
                      break;
                  }
              }

              // If no radio button in the group is selected, show the popup and return false
              if (!isSelected) {
                  allselected = 0;
                  break;
              }
          }
          // If all radio groups have at least one selected option, alert success
          if(allselected === 0)
          {
              document.getElementById('alertPopUp').classList.remove('fadeout');
              document.getElementById('alertPopUp').classList.add('fadeins');
              document.getElementById('alertPopUp').classList.remove('top');
          }
          else
          {
            document.getElementById('starform').submit();
          }
          setTimeout("hidePopup()", 1400);
      }
    </script>
</body>

</html>