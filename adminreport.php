<?php 
    // if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    //     $newtablename = $_POST['DeptNo'] . "_" .
    //                     $_POST['batchNO']. "_" . 
    //                     $_POST['semNo']. "_" . 
    //                     $_POST['SectionName']. "_" . 
    //                     $_POST['whatFeedback'];
    //     $dept = $_POST['DeptNo'];
    //     $batch = $_POST['batchNO'];
    //     $sem = $_POST['semNo'];
    //     $class = $_POST['SectionName'];
    //     $feedbackname = $_POST['whatFeedback'];

    //     echo $newtablename."<br>";
    
    //     $serverName = 'localhost';
    //     $userName = 'root';
    //     $dbPassword = 'Gajendran@04';
    //     $databaseName = "feedbackhistory";
    //     $serverPort = 3307;
    
    //     $connection =  new mysqli($serverName , $userName , $dbPassword , $databaseName , $serverPort);

    //     $countQuery = "SELECT COUNT(DISTINCT name) FROM $newtablename";
    //     $newtablename_query = $connection->query($countQuery);
    //     $totalstudents = ($newtablename_query->fetch_row())[0];
    //     // print_r($totalstudents);

    //     $resultquery = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$newtablename'";
    //     $resultquery_fetch = $connection->query($resultquery);
    //     $lastcolumn = "";
    //     while($result = $resultquery_fetch->fetch_row())
    //     {
    //         $lastcolumn = $result;
    //     }
    //     $lastcolumn = substr($lastcolumn[0],-2);
    //     echo $lastcolumn."<br>";


    //     $staffsQuery = "SELECT DISTINCT facultyName , coursename FROM $newtablename";
    //     $staffsQuery_fetch = $connection->query($staffsQuery);
    //     $staffsArr = [];
    //     while($staffs = $staffsQuery_fetch->fetch_assoc())
    //     {
    //         array_push($staffsArr , $staffs);
    //         print_r($staffs);
    //         echo "<br>";
    //     }

    //     $summ = "";
    //     for($i = 1;$i<=$lastcolumn;$i++)
    //     {
    //         $summ .= "(SUM(q$i) / $totalstudents) ,";
    //     }

    //     $summ = rtrim($summ,",");
    //     $flag = 1;
    //     // foreach($staffsArr as $staff)
    //     // {
    //     //     $name = $staff['facultyName'];
    //     //     $course = $staff['coursename'];
    //     //     // $code = $staff['coursecode'];
    //     //     $query = "SELECT DISTINCT  coursecode,coursename,facultyName, $summ FROM $newtablename WHERE facultyName = '$name' AND coursename = '$course'";
    //     //     $query_fetch = $connection->query($query);
    //     //     while($output = $query_fetch->fetch_row())
    //     //     {
    //     //         print_r($output);
    //     //         echo "<br>";
    //     //     }
    //     // }




    //     $eachStaffData = [];
    
    // foreach ($staffsArr as $staff) {
    //     $name = $staff['facultyName'];
    //     $course = $staff['coursename'];
    //     $query = "SELECT DISTINCT  coursecode,coursename,facultyName, $summ FROM $newtablename WHERE facultyName = '$name' AND coursename = '$course'";
    //     $query_fetch = $connection->query($query);
        
    //     // Fetch all rows for the current $staff and store them in an array
    //     $staffData = [];
    //     while ($output = $query_fetch->fetch_row()) {
    //         $staffData[] = $output;
    //     }

    //     $eachStaffData[$name][$course] = $staffData;
    // }

    // $eachStaffDataJSON = json_encode($eachStaffData);
    // // echo "<script>let eachStaffData = $eachStaffDataJSON;</script>";
    // echo "<script>console.log('Debug: eachStaffData = ', $eachStaffDataJSON); let eachStaffData = $eachStaffDataJSON;</script>";

    // }

    $serverName = '127.0.0.1';
    $userName = 'root';
    $dbPassword = 'Gajendran@04';
    $databaseName = "feedbackhistory";
    $serverPort = 3306;

    $conn =  new mysqli($serverName , $userName , $dbPassword , $databaseName , $serverPort);

    $alltablename = "feedbacks";
    $optionsQuery = "SELECT DISTINCT * FROM $alltablename";
    $optionsQuery_fetch = $conn->query($optionsQuery);

    $deptarr = []; 
    $batcharr = [];
    $semarr = [];
    $classarr = [];
    $wfarr = [];
    $flag = 0;
    while($options =  $optionsQuery_fetch->fetch_row())
    {
        array_push($deptarr , $options[0]);
        array_push($batcharr , $options[1]);
        array_push($semarr , $options[2]);
        array_push($classarr , $options[3]);
        array_push($wfarr , $options[4]);
    }

    $questionFlag = 0;
?>


<!DOCTYPE html>
<html>
<head>
    <title>KCE Feedback Report</title>
    <link rel="stylesheet" href="adminreport.css">
    <link rel = "icon" href = "https://res.cloudinary.com/dkbwdkthr/image/upload/v1694090918/KCE%20LOGO.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js" integrity="sha512-1g3IT1FdbHZKcBVZzlk4a4m5zLRuBjMFMxub1FeIRvR+rhfqHFld9VFXXBYe66ldBWf+syHHxoZEbZyunH6Idg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
    <style>
        .createDbMainHeading{
    font-size: 30px;
    color: #154f5d;
    font-weight: 600
}

.uploadMainContainer{
    height: fit-content;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
background: linear-gradient(135deg, rgba(0,86,86,0.9332983193277311) 0%, rgba(216,143,65,0.9445028011204482) 52%, rgba(181,104,36,0.9108893557422969) 100%);
}

.backButtonContainer{
    height: 70px;
    width: 70px;
    margin: 15px;
    border-radius: 100%;
    border: 5px solid orange;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: 900;
}
  
.reportMainContainer{
    background-color: whitesmoke;
    border: 2px solid rgba(162, 158, 154, 0.527);
    border-radius: 22px;
    height: auto;
    width: 100%;
    /* background-color: #154f5d; */
    padding-bottom: 50px;
}

.headingContainer{
    margin-top: 28px;
}

.mainTopcontainer{
    display: flex;
}

.feedbackHeading{
    font-size: 30px;
    color: rgb(0,86,86);
    margin-left: 20px;
}

.reportSelectionContainer{
    height: auto;
    padding-top: 5px;
    display: flex;
    justify-content: center;
}

.inputBox{
    margin: 5px;
}

select {
    /* styling */
    width: 100%;
    background-color: white;
    border: 2px solid rgba(162, 158, 154, 0.527);
    border-radius: 4px;
    display: inline-block;
    font: inherit;
    line-height: 1.5em;
    padding: 0.5em 3.5em 0.5em 1em;
  
    /* reset */

    margin: 0;      
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-appearance: none;
    -moz-appearance: none;
}

.selectionContainer{
  display: flex;
  flex-direction: column;
  justify-content: center;
}

select {
    background-image:
      linear-gradient(45deg, transparent 50%, gray 50%),
      linear-gradient(135deg, gray 50%, transparent 50%),
      radial-gradient(#ddd 70%, transparent 72%);
    background-position:
      calc(100% - 20px) calc(1em + 2px),
      calc(100% - 15px) calc(1em + 2px),
      calc(100% - .5em) .5em;
    background-size:
      5px 5px,
      5px 5px,
      1.5em 1.5em;
    background-repeat: no-repeat;
}
  
select:focus {
    background-image:
      linear-gradient(45deg, white 50%, transparent 50%),
      linear-gradient(135deg, transparent 50%, white 50%),
      radial-gradient(gray 70%, transparent 72%);
    background-position:
      calc(100% - 15px) 1em,
      calc(100% - 20px) 1em,
      calc(100% - .5em) .5em;
    background-size:
      5px 5px,
      5px 5px,
      1.5em 1.5em;
    background-repeat: no-repeat;
    border-color: black;
    outline: 0;
}


.submitButton{
    background-color: rgba(181,104,36);
    color: white;
    font-weight: 600;
    width: 230px;
    padding: 0.5em;
    border:0;
    margin-top: 15px;
    border-radius: 7px;
    margin-left: auto;
    margin-right: auto;
}

.buttonContainer{
 width: 100%;
 display: flex;
 justify-content: center;
}

tr,th,td{
  text-align: center;
}

.questonHeading{
  font-size: 23px;
  margin-top: 15px;
 color: #154f5d;
}



.questionHeadingName{
    font-size: 18px;
    color: teal;
    font-weight: 700;
}
.listQuestions{
    text-align: left;
    font-size: 17px;
}
.print{
    background-color: rgba(181,104,36);
        color: white;
        font-weight: 600;
        width: 230px;
        padding: 0.5em;
        border:0;
        margin-top: 15px;
        border-radius: 7px;
}

.listMainContainer{
    display: flex;
    justify-content: center;
}
#reportPrintingContainer{
    font-weight: 600;
    margin-top: 30px;
}
        table{
            width: 100%;
            margin-top: 15px;
        }
        .mainTableHead{
            background-color: #154f5d;
            color: white;
        }
        .tableDetails{
            width: 80%;
            margin-right: auto;
            margin-left: auto;
            margin-top: 20px;
            font-weight: 600;
        }
        .downloadButton{
            background-color: rgb(0,86,86);
            color: white;
            font-weight: 600;
            width: 230px;
            padding: 0.5em;
            border:0;
            margin-top: 15px;
            border-radius: 7px;
            margin-left: 5px;
        }
        .submitButton{
            background-color: rgba(181,104,36);
            color: white;
            font-weight: 600;
            width: 230px;
            padding: 0.5em;
            border:0;
            margin-top: 15px;
            border-radius: 7px;
        }
        /*----------------------------------------------------------------*/
        

        .signatureContainer{
            display: flex;
            justify-content: end;
            padding-right: 100px;
            margin-top: 50px;
            display: none;
        }

        @media print {
            .buttonContainer{
                display: none;
            }
            .signatureContainer{
                display: block;
                display: flex;
            justify-content: end;
            padding-right: 100px;
            margin-top: 100px;
            }
        }
.allTemplate{
  height: 460px;
  margin-bottom: -50px;
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
  /* background-image: url("https://res.cloudinary.com/dkbwdkthr/image/upload/v1694825929/kce_logo_png.png"); */
  background: url('data:image/png;base64,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5FbrL3j8kTMfvlrtP3FrWud8dOA+U3NzU+v11l137p34w2m9+p5PfOEdLx69CwAA4OFajR4AAADAcq2m+adv2z35rD85/4SvPL977Ib9Vrtzk3wOh9x9t2ufW6339o7c+YbzV3/nbTunPmua5peN3gYAAPBIuAIdAACAd+jfPvvdjz9x++4POtf2333s1rnnn9w+/7i1ig6H1lZzF/aP7J/ePfmTJ6bd77ll78rffMZL3njb6F0AAACPlIAOAADAg/bvnvOu7/LEI3d/WM2f3tTfu2r73MlW69azmg4H3dTc9lTn9450x97JV53ZP/biae61//tL3vQ7o7cBAABcKgI6AAAAD9lPPffx77u9Wv/tq7bPffD5eevpJ7YuvPORrf3mEtPhgNma5qa5zu4f7cz+FT+zv976tTP7V/ziZ7zkpleP3gYAAHCpCegAAAA8bL/0eaeuvnPvxPPe6chdH7G/6v1Xze9/bGu31TS3rmYxHTbSapprrv31Vhfm7Tt319v/dWd95HW37F754mde8yf/dfQ+AACAy0VABwAA4BH71c8/Pr1578pPu2La/dyrts/9pXm1fuetaf2ErdatVnNzYjos29xqquZaz6t25631VvON6/2tW27evernb98//m3Pvfb6N45eCQAAcLkJ6AAAAFwSP/a8d946OV04sbPeesKZ+dgznnjk7mddtXXu3der+Yq5rlhNF89Qrrn7fgWM85Y/hVPrpua5dfN0z/7+9rnb9k791rHV7vc+Zuvcq2/aufrCp7345nNDxwIAADxKBHQAAAAuuZc96z2ufLejd77Lia0Lp27dO/WUrdafefX2ub98ZGt3a548D4WlmJprver8/rF7bt878Qtn10e//wlbZ153bn30riNb+2/4299/x/7ojQAAAI8mAR0AAIDL6uXPeZfHHWnv/Z509O4nXGjrsaf3jn/Mya2dp5xY7bzr0dVuq9W6ebp4XXpzzbnVO1xKU3NNNXXxx/7+qp39o92zPvpHZ9ZHf+LEave/nJz2zr9p96rrn/GSm35n9F4AAICRBHQAAAAeVdc+88+9z+O2z/71x26fe9KJrQtH714ffbdz89G/dnzafb8j0/6VR1b7raZ18zS3uvdc5kf6zNUzX96RTXvbxr3Hlbc/v+3yqXs/OE/tz6v25q125q07z62P/Pb2tP6Nx67O3XF+/9jZ2/dO/smt+yd+9QUvve6WR3c9AADAcgnoAAAADPWK5z/+qtO7Jz/m8VtnP/jE1s6TTmxdOLW92t9qte7s+sjq7P6xE6vWx+/7/VMdm6b5imqri5lwNdXJavvPfu6peVVdMV382Nt7AjxPdaTmo9Ola6gXD3mf5u17v+59rfMgm6p5rr3maa/7/hlcJnPtzU071foSfZ15rgv3fs6H8/nmameu8w910zxPO9W5uR7KrdKndaudo6u9s6e2zu+8zQeraa55vZp319t759bHzpzZO/qm2/dP/NoVq51f/sxr3ui27AAAAPdDQAcAAGC4H3j2exy5euvssZOrna3jWzur7a29Vqt1b7xw1dYbL1z9hCPT/uPv/a3zqvmqrWl99VRHuxgdt6dp/cTqiv5MqF41H13VY6Y61sWw+WfNq+bjq2k+NdXqEn07c7VaTetjU/MV937eg/7ke5prPTddWM+rhxyRH8rXqeZ1XVjP05m5ae8SfZ31ft21brrnYXy+qYvf+93N013Vbg/u36Wpmvfn6cy61R1zXXgIX3vanbfuecyRc7f++StuvWdqfqujD/5UQG93vT2fXx+dz+wf3btj/8SFZ177J3sP8fsDAAA4VAR0AAAAAAAAAOjSvbseAAAAAAAAADaagA4AAAAAAAAACegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFAJ6AAAAAAAAABQCegAAAAAAAAAUAnoAAAAAAAAAFDV/w9vIlt50le+bAAAAABJRU5ErkJggg==');

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
    </style>
</head>
<body>
    <div class="container-fluid ">
        <div class="row ">
            <div class="col-12 uploadMainContainer">
                <div class="reportMainContainer">
                    <div class="mainTopcontainer">
                        <div class="headingContainer">
                            <h1 class="feedbackHeading">Feedback Report ...</h1>
                        </div>
                    </div>
                    <div class="reportSelectionContainer">
                        <form action="adminreport.php" method="post" class="selectionContainer">
                            <select class="inputBox" name="batchNO" id="batchNO">
                                <option>Batch</option>
                                <?php 
                                    foreach(array_unique($batcharr) as $batch){?>
                                    <option value="<?php echo $batch ?>"><?php echo $batch ?></option>

                                <?php    } ?>
                            </select>
                            <select class="inputBox" name="semNo" id="semNo">
                                <option>Semester</option>
                                <?php 
                                    foreach(array_unique($semarr) as $sem){?>
                                    <option value="<?php echo $sem ?>"><?php echo $sem ?></option>

                                <?php    } ?>
                            </select>
                            <select class="inputBox" name="DeptNo" id="DeptNo">
                                <option>Department</option>
                                <?php 
                                    foreach(array_unique($deptarr) as $dept){?>
                                    <option value="<?php echo $dept ?>"><?php echo $dept ?></option>

                                <?php    } ?>
                            </select>
                            <select class="inputBox" name="SectionName" id="SectionName">
                                <option>Class</option>
                                <?php 
                                    foreach(array_unique($classarr) as $class){?>
                                    <option value="<?php echo $class ?>"><?php echo $class ?></option>
                                <?php    } ?>
                            </select>
                            <select class="inputBox" name="whatFeedback" id="whatFeedback">
                                <option>Feedback</option>
                                <?php 
                                    foreach($wfarr as $wf){?>
                                    <option value="<?php echo $wf ?>"><?php echo $wf ?></option>

                                <?php    } ?>
                            </select>
                            <br/>
                            <div class="buttonContainer">
                                <button type="submit" class="submitButton">Load Report</button>
                            </div>
                        </form>
                    </div>
                    <!-- ... Your HTML code ... -->
                    <div id="reportPrintingContainer" class="col-12" >
                        <div class="container-fluid allTemplate">
                            <div class="row allTemplateCollegeNameMainContainer">
                                <div class="col-11 col-md-10 col-lg-7  allTemplateKceNameBox">
                                    <div class="logoContainer"></div>
                                    <div class="kceNameContainer">
                                        <h1 class="kceName">KARPAGAM</h1>
                                        <p class="kceCollege">COLLEGE OF ENGINEERING</p>
                                        <p class="kceCollegeQuotes">Rediscover  |  Refine  |  Redefine</p>
                                    </div>
                                    <hr class="hrLine"/>
                                    <div class="discriptionContainer">
                                        
                                        <p class="kceCollegeQualifiedDetails">Autonomous  |  Affiliated to Anna University</p>
                                        <br />
                                        <p class="kceCollegeQualifiedDetails">Coimbatore 641032</p>
                                        <br />
                                        <p class="kceCollegeCertificationDetails">(An ISO 9001:2015 and ISO 14001:2015 Certified Institution)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php 
                        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                            $questionFlag = 1;
                            $newtablename = $_POST['DeptNo'] . "_" .
                                            $_POST['batchNO']. "_" . 
                                            $_POST['semNo']. "_" . 
                                            $_POST['SectionName']. "_" . 
                                            $_POST['whatFeedback'];
                            $dept = $_POST['DeptNo'];
                            $batch = $_POST['batchNO'];
                            $sem = $_POST['semNo'];
                            $class = $_POST['SectionName'];
                            $feedbackname = ucfirst($_POST['whatFeedback']);

                            echo "
                            <table class='tableDetails'  border='2px solid black' style='table-layout: auto;'>
                            <tr class='mainTableHead' style='height: 40px;'>
                                <th>Department</th>
                                <th>Batch</th>
                                <th>Semester</th>
                                <th>Class</th>
                                <th>Feedback</th>
                            </tr>
                            <tr style='height: 40px;'>
                                <td>$dept</td>
                                <td>$batch</td>
                                <td>$sem</td>
                                <td>$class</td>
                                <td>$feedbackname</td>
                            </tr>
                            </table>
                            ";
                    
                            // echo "<br /><h1>$newtablename</h1>"."<br>";
                        
                            $serverName = '127.0.0.1';
                            $userName = 'root';
                            $dbPassword = 'Gajendran@04';
                            $databaseName = "feedbackhistory";
                            $serverPort = 3306;
                        
                            $connection =  new mysqli($serverName , $userName , $dbPassword , $databaseName , $serverPort);

                            $questionCountQuery = "SELECT * FROM $newtablename";
                            $questionCountQuery_fetch = $connection->query($questionCountQuery);
                            $questionCount_rows = $questionCountQuery_fetch->fetch_row();

                            $lastcolumn = 0;
                            for($i=0;$i<count($questionCount_rows);$i++)
                            {
                                if(is_null($questionCount_rows[$i]))
                                {
                                    break;
                                }
                                $lastcolumn++;
                            }
                            $lastcolumn -= 8;
                    
                            $countQuery = "SELECT COUNT(DISTINCT name) FROM $newtablename";
                            $newtablename_query = $connection->query($countQuery);
                            $totalstudents = ($newtablename_query->fetch_row())[0];

                    
                            // $resultquery = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$newtablename'";
                            // $resultquery_fetch = $connection->query($resultquery);
                            // $lastcolumn = "";
                            // while($result = $resultquery_fetch->fetch_row())
                            // {
                            //         $lastcolumn = $result;
                            // }
                            // $lastcolumn = substr($lastcolumn[0],-2);
                            // echo $lastcolumn."<br>";
                    
                            // $staffsQuery = "SELECT DISTINCT facultyName , coursename FROM $newtablename";
                            $staffsQuery = "SELECT DISTINCT facultyName, coursename, coursecode FROM $newtablename";
                            $staffsQuery_fetch = $connection->query($staffsQuery);
                            $staffsArr = [];
                            while($staffs = $staffsQuery_fetch->fetch_assoc())
                            {
                                array_push($staffsArr , $staffs);
                                // print_r($staffs);
                                // echo "<br>";
                            }
                    
                            $summ = "";
                            for($i = 1;$i<=$lastcolumn;$i++)
                            {
                                $summ .= "(SUM(q$i) / $totalstudents) ,";
                            }
                    
                            $summ = rtrim($summ,",");
                            $flag = 1;
                    
                            $eachStaffData = [];
                            echo "<table border='2px solid black' style='table-layout: auto;'>";
                            echo "<tr class='mainTableHead'>";
                            echo "<th>Code</th>
                                <th>Course</th>
                                <th>Staff Name</th>";
                            for($i=1;$i<=$lastcolumn;$i++)
                            {
                                echo "<th>Q$i</th>";
                            }
                            echo "<th>Count</th>";
                            echo "</tr>";
                            foreach ($staffsArr as $staff) {
                                $name = $staff['facultyName'];
                                $course = $staff['coursename'];
                                $query = "SELECT DISTINCT  coursecode,coursename,facultyName, $summ FROM $newtablename WHERE facultyName = '$name' AND coursename = '$course' GROUP BY coursecode,coursename,facultyName";
                                $query_fetch = $connection->query($query);
                                
                                $staffData = [];
                                
                                while ($output = $query_fetch->fetch_row()) {
                                    echo "<tr style='height: 50px;'>";
                                    foreach($output as $singledata)
                                    {
                                        if (is_numeric($singledata)) {
                                            $singledata = number_format($singledata, 2);
                                        }
                                        echo "<td>".htmlspecialchars($singledata)."</td>";
                                    }
                                    echo "<td>$totalstudents</td>";
                                    echo "</tr>";
                                }
                            }
                            echo "</table>";
                        }
                    ?>
                    
                    <div class="editor">
                    <?php
                    if($questionFlag == 1)
                    {    
                        echo "<h1 class='questonHeading'>***** Questions *****</h1>";
                        $serverName = '127.0.0.1';
                        $userName = 'root';
                        $dbPassword = 'Gajendran@04';
                        $databaseName = 'admin';
                        $serverPort = 3306;

                        $questionTable = 'questions';
                        $setName = $feedbackname;

                        $connection =  new mysqli($serverName , $userName , $dbPassword , $databaseName , $serverPort);
                        $questionSelectQuery = "SELECT * FROM $questionTable WHERE setname = '$setName'";
                        $allQuestionsFetch = $connection->query($questionSelectQuery);
                        $allQuestions = $allQuestionsFetch->fetch_row();
                        // $_SESSION['allQuestions'] = $allQuestionsFetch->fetch_all(MYSQLI_ASSOC);

                        $qsName = ucfirst($allQuestions[0]);
                        echo "<p class='questionHeadingName'>$qsName</p>";
                        echo "<div class='listMainContainer'>";
                        echo "<ol class='listQuestions'>";
                        for($i=1;$i<=$lastcolumn;$i++)
                        {
                            echo "<li>$allQuestions[$i]</li>";
                        }
                        echo "</ol>";
                        echo "</div>";
                        
                    }
                    ?>
                    </div>
                    <div class="buttonContainer">
                        <button class="print" id="printButton" onclick="printdiv('reportPrintingContainer')">Print Report</button>
                        <button class="downloadButton" id="downloadButton">Download Report</button>
                    </div>
                    <div class="signatureContainer" id="signatureContainer">
                    Principal's Signature
                </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
  <script>

        function printdiv(elem) {
        var header_str = '<html><head><title>' + document.title  + '</title></head><body>';
        var footer_str = '</body></html>';
        var new_str = document.getElementById(elem).innerHTML;
        var old_str = document.body.innerHTML;
        document.body.innerHTML = header_str + new_str + footer_str;
        window.print();
        document.body.innerHTML = old_str;
        return false;
        }

        $('#downloadButton').click(function(){
            html2canvas(document.querySelector('#reportPrintingContainer')).then((canvas) => {
                let base64image = canvas.toDataURL('image/png');
                // console.log(base64image);

                let pdf = new jsPDF('p' , 'px' ,[1200,1140]);
                pdf.addImage(base64image, 'PNG', 0 , 5 , 1110, 1100);
                pdf.save('<?php echo $newtablename ?>.pdf');
            })
        })
   </script>
</body>
</html>