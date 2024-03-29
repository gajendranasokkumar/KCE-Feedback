<!DOCTYPE html>
<html lang="en">
<head>
    <title>KCE FEEDBACK FORM</title>
    <link rel="stylesheet" href="admin.css">
    <script src="kceFeedbackAdminMainPage.js" defer></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/2c47716a54.js" crossorigin="anonymous"></script>
    <link rel = "icon" href = "https://res.cloudinary.com/dkbwdkthr/image/upload/v1694090918/KCE%20LOGO.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <style>
        body{
            padding-bottom: 50px;
        }
      .questionAddContainer{
        text-align: center;
      }
      .questionAddContainer:hover{
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    background: linear-gradient(135deg, rgba(0,86,86,0.9332983193277311) 0%, rgba(216,143,65,0.9445028011204482) 52%, rgba(181,104,36,0.9108893557422969) 100%);
    backdrop-filter: blur(80px);
    color: aliceblue;
    border: 2px solid white;
  cursor: pointer;
  text-align: center;
  .disc{
    color: rgb(8, 113, 22);
    text-decoration: underline;
    text-align: center;
    word-wrap: break-word;
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
  margin-top: 15px;
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

    <div class="container-fluid">
        <div class="row adminPageMainContainer">
            <div class="col-12">
                <h1 class="kceName" style="text-align: center;">…ADMIN…</h1>
            </div>
            <div class="col-6 col-lg-4 optionsMainContainer">
                <div class="questionAddContainer" id="uploadButton">
                    <h1 class="iconLogo"><i class="fa-solid fa-upload"></i></h1>
                    <p class="disc">Upload DataBase</p>
                </div>
            </div>
            <div class="col-6 col-lg-4 optionsMainContainer">
                <div class="questionAddContainer" id="viewStatusButton">
                    <h1 class="iconLogo"><i class="fa-solid fa-chart-pie"></i></h1>
                    <p class="disc">View Status</p>
                </div>
            </div>
            <div class="col-6 col-lg-4 optionsMainContainer">
                <div class="questionAddContainer" id="reportButton">
                    <h1 class="iconLogo"><i class="fa-solid fa-file"></i></h1>
                    <p class="disc">View Report</p>
                </div>
            </div>
            <div class="col-6 col-lg-4 optionsMainContainer">
                <div class="questionAddContainer" id="loginToFeedbackButton">
                    <h1 class="iconLogo"><i class="fa-solid fa-right-to-bracket"></i></i></h1>
                    <p class="disc">Login To Feedback</p>
                </div>
            </div>
            <div class="col-6 col-lg-4 optionsMainContainer">
                <div class="questionAddContainer" id="addqsButton">
                    <h1 class="iconLogo"><i class="fa-solid fa-question"></i></h1>
                    <p class="disc">Add Questions</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footerScetion">
      Made with ❤️ by Gajendran 717822P215
    </div>
    <script>
        let uploadButton = document.getElementById('uploadButton');
        let viewStatusButton = document.getElementById('viewStatusButton');
        let reportButton = document.getElementById('reportButton');
        let loginToFeedbackButton = document.getElementById('loginToFeedbackButton');
        let addqsButton = document.getElementById('addqsButton');

        uploadButton.addEventListener('click' , ()=>{
          window.location.assign('upload.php');
        });
        viewStatusButton.addEventListener('click' , ()=>{
          window.location.assign('viewstatus.php');
        });
        reportButton.addEventListener('click' , ()=>{
          window.open('adminreport.php' , '_blank');
        });
        loginToFeedbackButton.addEventListener('click' , ()=>{
          window.open('kcelogin.php' , '_blank');
        });
        addqsButton.addEventListener('click' , ()=>{
          window.location.assign('kceFeedbackAddQuestion.php');
        });
    </script>
</body>
</html>