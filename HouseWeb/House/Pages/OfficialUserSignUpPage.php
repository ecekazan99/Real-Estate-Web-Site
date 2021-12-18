<?php
// This file is created for sign up page of official user
require_once("operation.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Official User Sign Up Page</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../Images/favIcon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="..\Stylings\SignUpPageDesign.css">
</head>

<body>
    <div class="signUp_page">
        <div>
            <a href="OfficialUserLoginPage.php?foo=bar" class="btn back_btn" style="float: left;"><i class="fas fa-arrow-left"></i></a>
            <a href="MainPage.php" style="color:white;text-decoration: none"> <button class="btn close_btn" style="float: right;"><i class="fas fa-times"></i></button></a>
        </div>
        <div>
            <a href="MainPage.php"><img src="../Images/logo.png" alt="Logo" style="max-width:100%; height:auto;display: block;margin-left: auto;margin-right: auto;" /></a>
        </div>
        <div>
            <div class="flex-container row ">
                <div class="displayStep1" style=" background-color:rgba(189,33,48,0.8); width: 60px; height: 52px;">
                    <p style="padding-top: 10px; padding-right: 7px; padding-left: 7px;font-weight: bold;">Kayıt</p>
                </div>
                <div style="border-bottom: 2px solid black ;width: 150px; height: 26px; "></div>
                <div class="displayStep2 ">
                    <p style="padding-top: 10px; padding-right: 3px; padding-left: 3px;font-weight: bold;">Ödeme</p>
                </div>
            </div>
        </div>
        <div class="user_card">
            <div>
                <h1 class="signUp_page_text">Kurumsal Kayıt Formu</h1>
            </div>
            <div style="display:flex;flex-direction:row">
                <form action="operation.php" method="POST" enctype="multipart/form-data">
                    <div class="custom-file-upload ml-3 mr-2" style="display:flex;flex-direction:column;float:left">
                        <label class="profile" for="photo" id="photoIcon"><i class="fas fa-folder-plus fa-2x"></i></label>
                        <input type="file" name="files[]" id="photo" accept=".jpg,.jpeg,.png" onchange="loadFile(event)">
                        <img id="output" style="width: 100px ;height: 150px" />
                        <script language="JavaScript" type="text/javascript">
                            var loadFile = function(event) {
                                var reader = new FileReader();
                                reader.onload = function() {
                                    var output = document.getElementById('output');
                                    output.src = reader.result;
                                };
                                console.log(event.target.files);
                                if (event.target.files[0]) {
                                    reader.readAsDataURL(event.target.files[0]);
                                }
                            };
                        </script>
                    </div>
                    <div style="display:flex;flex-direction:column">
                        <div class="form-item">
                            <input name="firmName" type="text" id="firmName" maxLength=25 autocomplete="off" value="" required>
                            <label for="firmName">Organizasyon İsmi</label>
                        </div>
                        <div class="form-item">
                            <input name="mail" type="email" id="mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.com$" title="Lütfen e-posta adresini bu şekilde giriniz: [abc@abc.com]" autocomplete="off" required value="">
                            <label for="mail">Resmi E-posta</label>
                        </div>
                        <div class="form-item">
                            <textarea name="address" type="text" id="address" rows="4" cols="22" autocomplete="off" required value=""></textarea>
                            <label for="address">Organizasyon Adresi</label>
                        </div>
                        <div class="form-item">
                            <input name="phone" type="tel" id="phone" pattern="05[0-9]{2}[0-9]{3}[0-9]{2}[0-9]{2}" title="Lütfen telefon numarasını 05xx-xxx-xx-xx şeklinde giriniz." maxlength="11" autocomplete="off" required value="">
                            <label for="phone">Telefon</label>
                        </div>
                        <div class="form-item">
                            <input name="password" type="password" id="password" autocomplete="off" pattern="^[a-zöçğışüA-ZÖÇĞİŞÜ0-9]{8,16}$" title="Şifre sadece harf ve sayı içermelidir ve en az 8 en fazla 16 karakter içermelidir." maxlength="16" required value="">
                            <label for="password">Şifre</label>
                            <span class="btnPass"><label><input type="checkbox" id="eye" style="display:none" onclick="(function(e, el){
                            document.getElementById('password').type = el.checked ? 'text' : 'password';
                            el.parentNode.lastElementChild.innerHTML = el.checked ? '<i style=\'cursor: pointer\' class=\'fas fa-eye-slash\'>' : '<i style=\'cursor: pointer\' class=\'fas fa-eye\'>';
                                     })(event, this)">
                                    <span><i class="fas fa-eye" style="cursor: pointer"></i></span>
                                </label>
                            </span>
                        </div>
                        <div class="form-item">
                            <button type="submit" name="SubmitSignupForOfficialUser" class="btn signUp_btn">Ödeme Basamağına Geç</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <script>
            let firmName = document.getElementById('firmName');
            document.querySelector('form').addEventListener('submit', function(e) {
                let firmNameVal = firmName.value;
                localStorage.setItem("firmName", firmNameVal);
            });
        </script>
</body>

</html>