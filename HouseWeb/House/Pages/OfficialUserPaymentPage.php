<!DOCTYPE html>
<html>
<!--This file is created for payment page of official user -->
<head>
    <title>Official User Payment Page</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../Images/favIcon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="..\Stylings\SignUpPageDesign.css">
</head>

<body>
    <div class="signUp_page">
        <div>
            <a href="OfficialUserSignUpPage.php" class="btn back_btn" style="float: left;"><i class="fas fa-arrow-left"></i></a>

            <a href="MainPage.php" style="color:white;text-decoration: none"> <button class="btn close_btn" style="float: right;"><i class="fas fa-times"></i></button></a>
        </div>
        <div>
            <a href="MainPage.php"><img src="../Images/logo.png" alt="Logo" style="max-width:100%; height:auto;display: block;margin-left: auto;margin-right: auto;" /></a>
        </div>
        <div>
            <div class="flex-container row ">
                <div class="displayStep1" style=" background-color: rgba(189,33,48,0.8); width: 60px; height: 52px;">
                    <p style="padding-top: 10px; padding-right: 7px; padding-left: 7px; font-weight: bold;">Kayıt</p>
                </div>
                <div style="border-bottom: 2px solid black ;width: 150px; height: 26px; "></div>
                <div class="displayStep2 " style=" background-color:rgba(189,33,48,0.8); ">
                    <p style="padding-top: 10px; padding-right: 3px; padding-left: 3px;font-weight: bold;">Ödeme</p>
                </div>
            </div>
        </div>
        <div class="user_card ">
            <div>
                <h1 class="signUp_page_text ">Ödeme Ekranı</h1>
            </div>
            <div>
                <div style="z-index: 9999;position: absolute;left: 29%;top: 35%" id="displaySucces"></div>
                <form>
                    <div class="form-item mb-3 " style="display: flex; justify-content: flex-start">
                        <input name="cardNumber" type="text" maxlength="16" pattern="[0-9]{16}" id="cardNumber" autocomplete="off" title="Lütfen kartın ön yüzünde bulunan 16 haneli kart numarasını doğru giriniz." value="" required>
                        <label for="cardNumber">Kart Numarası</label>
                        <div><img src="..\Images\MasterCardLogo.png" alt="MasterCard" style="width: 50px; height: 30px; margin-left: 5px; margin-top: 5px;"></div>
                        <div><img src="..\Images\VisaLogo.jpg" alt="VisaLogo" style="width: 50px; height: 30px; margin-left: 5px; margin-top: 5px;"></div>

                    </div>
                    <div class="form-item mb-4 ">
                        <input name="cardName" type="text" id="cardName" pattern="[a-zA-Z\s]{2,50}" autocomplete="off" value="" required>
                        <label for="cardName">Kart Üzerindeki İsim</label>
                    </div>
                    <div class="date mt-3" id="dateDropdowns">
                        <p class="mt-2 ml-3">Son Kullanma Tarihi</p>
                        <div class="dropdown ml-2">
                            <button type="button" class="btn btn-danger dropdown-toggle" name="monthOption" id="monthOption" data-toggle="dropdown" value="">Ay</button>
                            <div class="dropdown-menu monthDropdown pre-scrollable" style="max-height: 250px">
                                <button class="dropdown-item">01</button>
                                <button class="dropdown-item">02</button>
                                <button class="dropdown-item">03</button>
                                <button class="dropdown-item">04</button>
                                <button class="dropdown-item">05</button>
                                <button class="dropdown-item">06</button>
                                <button class="dropdown-item">07</button>
                                <button class="dropdown-item">08</button>
                                <button class="dropdown-item">09</button>
                                <button class="dropdown-item">10</button>
                                <button class="dropdown-item">11</button>
                                <button class="dropdown-item">12</button>
                            </div>
                        </div>
                        <div class="dropdown ml-1">
                            <button type="button" class="btn btn-danger dropdown-toggle" name="yearOption" id="yearOption" data-toggle="dropdown" value="">Yıl</button>
                            <div class="dropdown-menu yearDropdown pre-scrollable" style="max-height: 250px">
                                <button class="dropdown-item">2021</button>
                                <button class="dropdown-item">2022</button>
                                <button class="dropdown-item">2023</button>
                                <button class="dropdown-item">2024</button>
                                <button class="dropdown-item">2025</button>
                                <button class="dropdown-item">2026</button>
                                <button class="dropdown-item">2027</button>
                                <button class="dropdown-item">2028</button>
                                <button class="dropdown-item">2029</button>
                                <button class="dropdown-item">2030</button>
                            </div>
                        </div>

                    </div>
                    <div id="element" class="mb-2" style="color:#c0392b"></div>
                    <div class="form-item mb-3 " style="width:100px;display: flex; justify-content: flex-start">
                        <input name="cvv" type="text" maxlength="3" id="cvv" style="width:100px" pattern="[0-9]{3}" autocomplete="off" value="" required>
                        <label for="cvv">CVV Kodu</label>
                        <div>
                            <button type="button" class="btn" data-toggle="tooltip" data-placement="right" title="Kartın arka yüzündeki son 3 rakam">
                                <i class="far fa-question-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div class="paymentInformation">
                        <h1>ÖDEME BİLGİLERİ</h1>
                        <p>ORGANİZASYON İSMİ:
                            <span id="nameOfName" style="font-size: 12px; font-weight: bold;"></span>
                        </p>
                        <p>ÖDEME TUTARINIZ: 400 TL</p>
                    </div>
                    <div class=" mt-3 signUp_container ">
                        <button type="submit" name="submitButton" id="submitButton" class="btn signUp_btn " onclick="return myValidation();">Kaydı Tamamla</button>
                    </div>
                </form>

            </div>

        </div>

    </div>
    <script>
        document.getElementById("nameOfName").innerHTML = localStorage.getItem("firmName");
    </script>
    <script>
        $(document).ready(function() {
            $("#monthOption").click(function() {
                document.getElementById("dateDropdowns").style.borderColor = "#c0392b";
                document.getElementById("dateDropdowns").style.color = "#c0392b";
            });
            $("#yearOption").click(function() {
                document.getElementById("dateDropdowns").style.borderColor = "#c0392b";
                document.getElementById("dateDropdowns").style.color = "#c0392b";
            });
            $("#cvv").click(function() {
                document.getElementById("dateDropdowns").style.borderColor = "rgb(82, 82, 82)";
                document.getElementById("dateDropdowns").style.color = "black";
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".monthDropdown .dropdown-item").click(function() {
                $("#monthOption").text($(this).text());
            });
            $(".yearDropdown .dropdown-item").click(function() {
                $("#yearOption").text($(this).text());
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script>
        function myValidation() {
            var elem = document.getElementById('monthOption');
            var txt = elem.textContent || elem.innerText;
            var elem2 = document.getElementById('yearOption');
            var txt2 = elem2.textContent || elem2.innerText;
            if (txt === "Ay") {
                document.getElementById('element').innerHTML = "Lütfen ay ve yıl bilgilerini seçiniz.";
                return false;
            }
            if (txt2 === "Yıl") {
                document.getElementById('element').innerHTML = "Lütfen ay ve yıl bilgilerini seçiniz.";
                return false;
            }
            if (txt !== "Ay" && txt2 !== "Yıl") {
                return true;
            }
        }
    </script>
    <script>
        var cardNumber = document.getElementById('cardNumber');
        var cardName = document.getElementById('cardName');
        var monthOption = document.getElementById('monthOption');
        var yearOption = document.getElementById('yearOption');
        var cvv = document.getElementById('cvv');
        document.querySelector('form').addEventListener('submit', function(e) {
            if (myValidation() === true) {
                e.preventDefault();
                console.log("Kart Numarası: " + cardNumber.value);
                console.log("Kart İsmi: " + cardName.value);
                console.log("Ay: " + monthOption.textContent);
                console.log("Yıl: " + yearOption.textContent);
                console.log("CVV: " + cvv.value);

                function sleep(time) {
                    return new Promise((resolve) => setTimeout(resolve, time));
                }

                document.getElementById("displaySucces").innerHTML = '<div id="succesMessage" style="z-index:9999;position:relative;animation-name: example;animation-duration:4s;box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.3);margin:auto;background-color: #d4edda;border: 1px solid #c3e6cb">' +
                    '<h6 style="padding: 30px;font-size: 30px;color:rgba(0,0,0,0.66)">Kaydınız başarıyla tamamlanmıştır !</h6></div>'

                sleep(4000).then(() => {
                    
                    window.location.href = "OfficialUserLoginPage.php";
                });

            } else {
                e.preventDefault();
            }
        });
    </script>
</body>

</html>