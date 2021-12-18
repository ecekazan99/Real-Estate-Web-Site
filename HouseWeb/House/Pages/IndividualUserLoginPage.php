<?php
// This file is created for individual user login page
require_once("operation.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Individual User Login Page</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../Images/favIcon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="../Stylings/LoginPageDesign.css">
    <link rel="stylesheet" href="../Stylings/BackgroundAnimation.css">
</head>

<body>

    <div class="login_page">
        <div>
            <div style="float:left;margin: 5px 50px;">
                <a href="MainPage.php"><i class="fas fa-home" style="background-color:#bd2130;color: white; padding:10px; font-size: 30px;border:1px solid #bd2130;border-radius: 100%;box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.3);"></i></a>
            </div>
            <div style="float:right;margin: 5px 50px;">
                <a href="MainPage.php" style="color:white;text-decoration: none"> <button class="btn close_btn" style="float: right;"><i class="fas fa-times"></i></button></a>
            </div>
        </div>
        <div>

            <a href="MainPage.php"><img src="../Images/logo_transparent.png" alt="Logo" style="max-width:100%; height:auto;display: block;margin-left: auto;margin-right: auto;" /></a>
        </div>
        <br>
        <br>
        <div class="user_card">
            <div>
                <h1 class="login_page_text">Giriş Ekranı</h1>
            </div>
            <div>
                <form action="operation.php" method="GET">
                    <div class="input-group mr-5">
                        <div class="input-group-prepend ">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.com$" title="Lütfen e-posta adresini bu şekilde giriniz: [abc@abc.com]" name="userMail" class="form-control input_mail" id="emailAddr" value="" placeholder="E-posta adresi" autocomplete="off" required>
                    </div>
                    <div id="mailWarning" style="margin-left:42px ;color:#bd2130"></div>
                    <div class="input-group mb-2 mt-2">
                        <div class="input-group-prepend ">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" id="password" name="reg_password" class="form-control input_pass" pattern="^[a-zöçğışüA-ZÖÇĞIŞÜ0-9]{8,16}$" minlength="8" maxlength="16" placeholder="Şifre" required />
                        <span class="btnPass"><label><input type="checkbox" id="eye" style="display:none" onclick="(function(e, el){
                            document.getElementById('password').type = el.checked ? 'text' : 'password';
                            el.parentNode.lastElementChild.innerHTML = el.checked ? '<i class=\'fas fa-eye-slash\'>' : '<i class=\'fas fa-eye\'>';
                                     })(event, this)">
                                <span><i class="fas fa-eye"></i></span>
                            </label>
                        </span>
                    </div>
                    <div id="passwordWarning" style="margin-left:42px ;color:#bd2130"></div>
                    <div style="float: right;">
                        <div>
                            <a href="#" class="text-danger">Şifremi Unuttum</a>
                        </div>
                    </div>
                    <div class=" mt-5 login_container">
                        <button type="submit" name="SubmitSignInForIndividualUser" class="btn login_btn">Giriş Yap</button>
                    </div>
                </form>
            </div>
            <div class="mt-4">
                <div>
                    Üye Değil Misin? <a href="IndividualUserSignUpPage.php" class="ml-2 text-danger">Kayıt Ol</a>
                </div>
            </div>
        </div>

    </div>
    <div class="loginPageBackgroundAnimation" style="width: 100%;height:100%;z-index: -1;position: absolute;left: 0;top: 0;"></div>
    <script>
        let userType = 1;
        localStorage.setItem("userTypeID", userType);
    </script>
</body>

</html>