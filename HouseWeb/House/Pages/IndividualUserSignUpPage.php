<?php
// This file is created for individual sign up page
require_once("operation.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Individual User Sign Up Page</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../Images/favIcon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="..\Stylings\SignUpPageDesign.css">
</head>

<body>

    <div class="signUp_page">
        <div>
            <a href="IndividualUserLoginPage.php" class="btn back_btn" style="float: left;"><i class="fas fa-arrow-left"></i></a>
            <a href="MainPage.php" style="color:white;text-decoration: none">
                <button class="btn close_btn" style="float: right;"><i class="fas fa-times"></i></button>
            </a>
        </div>
        <div>

            <a href="MainPage.php"><img src="../Images/logo.png" alt="Logo" style="max-width:100%; height:auto;display: block;margin-left: auto;margin-right: auto;" /></a>

        </div>

        <div class="user_card">
            <div>
                <h1 class="signUp_page_text">Bireysel Kayıt Formu</h1>
            </div>
            <div style="display:flex;flex-direction:row">

                <div style="z-index: 9999;position: absolute;left: 29%;top: 35%" id="displaySucces"></div>
                <form action="operation.php" method="POST" enctype="multipart/form-data">

                    <div class="custom-file-upload ml-3 mr-5" style="display:flex;flex-direction:column;float:left">
                        <label class="profile" for="files" id="photoIcon"><i class="fas fa-folder-plus fa-2x"></i></label>
                        <input type="file" name="files[]" id="files" accept=".jpg,.jpeg,.png" onchange="loadFile(event)">
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
                            <input name="firstName" type="text" id="firstName" autocomplete="off" value="" pattern="^[a-zöçğışüA-ZÖÇĞİŞÜ]{2,25}$" maxlength="25" required>
                            <label for="firstName">İsim</label>
                        </div>
                        <div class="form-item">
                            <input name="lastName" type="text" id="lastName" autocomplete="off" pattern="^[a-zöçğışüA-ZÖÇĞİŞÜ]{2,25}$" maxlength="25" required value="">
                            <label for="lastName">Soyisim</label>
                        </div>
                        <div class="form-item">
                            <input name="mail" type="email" id="mail" autocomplete="off" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.com$" title="Lütfen e-posta adresini bu şekilde giriniz: [abc@abc.com]" required value="">
                            <label for="mail">E-posta Adresi</label>
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
                            <button type="submit" name="SubmitSignupForIndividualUser" class="btn signUp_btn">Kaydı Tamamla</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <script>
        var firstName = document.getElementById('firstName');
        var lastName = document.getElementById('lastName');
        var mail = document.getElementById('mail');
        var phone = document.getElementById('phone');
        var password = document.getElementById('password');
        document.querySelector('form').addEventListener('submit', function(e) {

        

            console.log("İsim: " + firstName.value);
            console.log("Soyisim: " + lastName.value);
            console.log("Mail adresi: " + mail.value);
            console.log("Telefon: " + phone.value);
            console.log("Şifre: " + password.value);

            function sleep(time) {
                return new Promise((resolve) => setTimeout(resolve, time));
            }

            document.getElementById("displaySucces").innerHTML = '<div id="succesMessage" style="z-index:9999;position:relative;animation-name: example;animation-duration:4s;box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.3);margin:auto;background-color: #d4edda;border: 1px solid #c3e6cb">' +
                '<h6 style="padding: 30px;font-size: 30px;color:rgba(0,0,0,0.66)">Kaydınız başarıyla tamamlanmıştır !</h6></div>'
            sleep(4000).then(() => {
               
                window.location.href = "IndividualUserLoginPage.php";
            });


        });
    </script>

</body>

</html>