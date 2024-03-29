<?php 
    
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>KCE FEEDBACK LOGIN</title>
    <link rel="stylesheet" href="KCEfeedbackLoginPage.css">
    <script src="KCEfeedbackLoginPage.js" defer></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://res.cloudinary.com/dkbwdkthr/image/upload/v1694090918/KCE%20LOGO.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Finger+Paint&family=Roboto+Slab&display=swap");

        .loginPageMainContainer {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loginBox {
            height: 500px;
            width: 300px;
            padding: 20px;
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
            background-position: bottom;
            background-color: whitesmoke;
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
            letter-spacing: 4px;
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

        .hrLine {
            position: relative;
            top: -80px;
            width: auto;
        }

        .loginInputContainer {
            position: relative;
            top: -70px;
        }

        .loginHeading {
            color: #1363a4;
            font-weight: 600;
            margin-bottom: 30px;
            text-shadow: 2px 2px 5px rgb(203, 203, 203);
        }

        .inputBox {
            padding: 3px;
            width: 250px;
            font-size: 15px;
            border-width: 2px;
            border-color: #cccccc;
            background-color: #ffffff;
            color: rgb(32, 30, 30);
            font-weight: 600;
            border-style: solid;
            border-radius: 3px;
            letter-spacing: 2px;
            /* box-shadow: 0px 0px 5px rgba(79, 79, 79, 0.75); */
            /* text-shadow: 0px 0px 5px rgba(66,66,66,.75); */
            margin-bottom: 15px;
            text-align: center;
            font-family: "Finger Paint", cursive;
            font-family: "Roboto Slab", serif;
        }

        ::placeholder {
            color: rgba(54, 49, 49, 0.593);
            font-weight: 600;
        }

        .buttonContainer {
            text-align: right;
            width: 250px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
        }

        .clearButton {
            height: 35px;
            width: 80px;
            border-radius: 18px;
            background-color: white;
            border: 2px solid rgba(162, 158, 154, 0.527);
        }

        .loginButton {
            height: 35px;
            width: 80px;
            border-radius: 18px;
            border: 0;
            background-color: #1a73e8;
            color: white;
        }

        .clearButton:focus,
        .loginButton:focus {
            outline: none;
        }

        .deicignedByLine {
            position: relative;
            top: -35px;
            color: rgba(54, 49, 49, 0.593);
        }

        .wrongDetailsPopUp {
            height: 50px;
            width: 260px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ff7b7bd9;
            border-left: 5px solid red;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 5px;
            position: absolute;
            bottom: 20px;
            right: 20px;
            font-weight: 600;
            transition-timing-function: ease-in;
        }


        .visibility {
            visibility: hidden;
            -webkit-animation: fadeIn 1s;
            animation: fadeIn 1s
        }

        .wrongDetailsPopUp:active {
            transition: width 2s;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row loginPageMainContainer">
            <div class="col-11 col-md-6 col-lg-5  loginBox">
                <div class="logoContainer"></div>
                <div class="kceNameContainer">
                    <h1 class="kceName">KARPAGAM</h1>
                    <p class="kceCollege">COLLEGE OF ENGINEERING</p>
                    <p class="kceCollegeQuotes">Rediscover | Refine | Redefine</p>
                </div>
                <hr class="hrLine" />
                <div class="loginInputContainer">
                    <h1 class="loginHeading">Login</h1>
                    <form action="kceLoginPage2.php"  method="post" id="studentLogin">
                        <input type="text" id="userName" class="inputBox" placeholder="User Name" name="username"/>
                        <br />
                        <input type="password" id="loginPassword" class="inputBox" placeholder="Password" name="password"/>
                        <br />
                        
                        <div class="buttonContainer">
                        <button class="clearButton" id="clearButton">Clear</button>
                        <input type="submit" value="Login" class="loginButton" id="loginButton">
                        <!-- <button class="loginButton" id="loginButton">Login</button> -->
                    </form>   
                    </div>
                </div>
                <p class="deicignedByLine">&#169; Made with ❤️ by Gajendran 717822P215 </p>
            </div>
            <div class="wrongDetailsPopUp visibility" id="invalidPopUpBox">
                Invalid User Name or Password!
            </div>
        </div>
    </div>
    <script>
        document.getElementById('loginButton').addEventListener('click', () => {
            let invalidPopUpBox = document.getElementById('invalidPopUpBox');

            let validateLoginInformation = () => {
                let userName = document.getElementById('userName').value;
                let password = document.getElementById('loginPassword').value;
                if (userName !== "" && password !== "")
                {
                    document.getElementById('studentLogin').submit();
                } 
                else 
                {
                    event.preventDefault(); 
                    invalidPopUpBox.classList.remove('visibility');
                    setTimeout(vanishInvalidBox, 2000);
                }
            }

            let vanishInvalidBox = () => {
                invalidPopUpBox.classList.add('visibility');
            }

            validateLoginInformation();
        });
        document.getElementById('studentLogin').event.preventDefault();

    </script>
</body>

</html>