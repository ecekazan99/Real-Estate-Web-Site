<?php
// This file is created for displaying profile page of official user
require_once("operation.php");
$userIDforDisplayingOfficialProfile = $_COOKIE['user_id'];
$sqlQueryForDisplayingOfficialProfile = "SELECT * FROM tbl_OfficalUsers WHERE userID=$userIDforDisplayingOfficialProfile";
$resultForDisplayingOfficialProfile = mysqli_query($GLOBALS['con'], $sqlQueryForDisplayingOfficialProfile);
if (mysqli_query($GLOBALS['con'], $sqlQueryForDisplayingOfficialProfile)) {
    $getValueForDisplayingOfficialProfile = mysqli_fetch_array($resultForDisplayingOfficialProfile);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Official User Profile</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../Images/favIcon.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="..\Stylings\MyProfile.css">
    <link rel="stylesheet" href="../Stylings/myInterests.css">
</head>

<body>
    <header>
        <div style="float:left;margin: 5px 50px;">
            <a href="MainPage.php"><i class="fas fa-home" style="color:#bd2130; padding:10px; font-size: 30px;border:1px solid white;border-radius: 100%;box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.3);"></i></a>
        </div>
        <div style="float:right;margin: 5px 50px;" class="dropdown">
            <button class="btn btn-danger">Hesabım</button>
            <div class="dropdown-content">
                <a href="OfficialUserProfilePage.php">Bilgilerim</a>
                <a href="MyActiveAdvertisementsPage.php">İlanlarım</a>
                <a href="DisplayMyFavoriteAdvertisements.php">Favorilerim</a>
                <a href="MyInterests.php">İlgilendiğim İlanlar</a>
                <a onclick=logOut() href="MainPage.php">Çıkış yap</a>
            </div>
        </div>
        <br><br>
        <div>
            <a href="MainPage.php"><img src="../Images/logo.png" alt="Logo" style="max-width:100%; height:auto;display: block;margin-left: auto;margin-right: auto;" /></a>
        </div>

    </header>
    <main style="display: flex;justify-content: center;align-items:center;flex-direction: column">
        <div class="profileCard">
            <div>
                <h1 class="profileCardText ml-3">Kurumsal Hesap Bilgilerim</h1>
            </div>
            <div class="profileInformations">
                <form action="operation.php" method="POST" enctype="multipart/form-data" style="display:flex;flex:7; flex-direction: row;">
                    <div class="informationPartLeft ">
                        <div class="custom-file-upload mr-2" style="display:flex;flex:2; flex-direction: column;float:left">
                            <label class="profilePhoto" for="photo" id="photoIcon"><i class="fas fa-user-edit"></i></label>
                            <input type="file" name="files[]" id="photo" accept=".jpg,.jpeg,.png" onchange="loadFile(event)">
                            <?php echo '<img id="output" src="Official_Users_Images/' . $getValueForDisplayingOfficialProfile['UserProfileImage'] . '" style="width: 100px ;height: 150px; " />'; ?>
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
                                <?php echo '<input name="firmName" type="text" id="firmName" maxLength=25 autocomplete="off" value="' . $getValueForDisplayingOfficialProfile['FirmName'] . '" required>'; ?>
                                <label for="firmName">Organizasyon İsmi</label>
                                <span class="editIcon"><i class="far fa-edit"></i></span>
                            </div>
                            <div class="form-item" style="display: flex; justify-content: flex-start ;">
                                <?php echo '<textarea name="address" type="text" id="address" rows="4" cols="22" autocomplete="off" value="" required>' . $getValueForDisplayingOfficialProfile['Address'] . '</textarea>'; ?>
                                <label for="address">Organizasyon Adresi</label>
                                <span class="editIcon"><i class="far fa-edit"></i></span>
                                <div class="map">
                                    <button type="button" class="btn mapBtn">
                                        <i class="fas fa-map-marked-alt"></i>
                                    </button>

                                    <div class="content">
                                        <span class="mapouter">
                                            <span class="gmap_canvas"><iframe width="400" height="300" id="gmap_canvas" src="about:blank" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                                <a href="https://www.whatismyip-address.com/nordvpn-coupon/"></a>
                                            </span>
                                            <style>
                                                .mapouter {
                                                    position: relative;
                                                    text-align: right;
                                                    height: 300px;
                                                    width: 400px;
                                                    z-index: 10;
                                                }

                                                .gmap_canvas {
                                                    overflow: hidden;
                                                    background: none !important;
                                                    height: 300px;
                                                    width: 400px;
                                                }
                                            </style>
                                            <script>
                                                let address = $('#address').val();
                                                var a = "https://maps.google.com/maps?q=" + eval("address") + "&t=&z=19&ie=UTF8&iwloc=&output=embed";
                                                $('#gmap_canvas').attr('src', a)
                                            </script>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="form-item">
                                <?php echo '<input name="phone" type="tel" id="phone" pattern="05[0-9]{2}[0-9]{3}[0-9]{2}[0-9]{2}" title="Lütfen telefon numarasını 05xx-xxx-xx-xx şeklinde giriniz." maxlength="11" autocomplete="off" required value="' . $getValueForDisplayingOfficialProfile['Phone'] . '">'; ?>
                                <label for="phone">Telefon</label>
                                <span class="editIcon"><i class="far fa-edit"></i></span>
                            </div>
                            <div class="form-item">
                                <?php echo '<input name="mail" type="email" id="mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.com$" title="Lütfen e-posta adresini bu şekilde giriniz: [abc@abc.com]" autocomplete="off" required value="' . $getValueForDisplayingOfficialProfile['MailAddress'] . '">'; ?>
                                <label for="mail">Resmi E-posta</label>
                                <span class="editIcon"><i class="far fa-edit"></i></span>
                            </div>
                            <div style="display:flex; justify-content: flex-end;">
                                <button type="submit" name="updateOfficialUserProperties" class="btn btn-danger">Güncelle</button>
                            </div>
                        </div>

                </form>
            </div>
            <div class="informationPartRight">
                <form action="operation.php" method="POST">
                    <div class="form-item">
                        <?php echo '<input name="password1" type="password" id="password1" autocomplete="off" pattern="^[a-zöçğışüA-ZÖÇĞİŞÜ0-9]{8,16}$" title="Şifre sadece harf ve sayı içermelidir ve en az 8 en fazla 16 karakter içermelidir." maxlength="16" required value="' . $getValueForDisplayingOfficialProfile['Password'] . '">'; ?>
                        <label for="password1"> Mevcut Şifre:</label>
                        <span class="btnPass"><label><input type="checkbox" id="eye" style="display:none" onclick="(function(e, el){
                                document.getElementById('password1').type = el.checked ? 'text' : 'password';
                                el.parentNode.lastElementChild.innerHTML = el.checked ? '<i style=\'cursor: pointer\' class=\'fas fa-eye-slash\'>' : '<i style=\'cursor: pointer\' class=\'fas fa-eye\'>';
                                         })(event, this)">
                                <span><i class="fas fa-eye" style="cursor: pointer"></i></span>
                            </label>
                        </span>
                    </div>
                    <div class="form-item">
                        <input name="password2" type="password" id="password2" autocomplete="off" pattern="^[a-zöçğışüA-ZÖÇĞİŞÜ0-9]{8,16}$" title="Şifre sadece harf ve sayı içermelidir ve en az 8 en fazla 16 karakter içermelidir." maxlength="16" required value="">
                        <label for="password2"> Yeni Şifre:</label>
                        <span class="btnPass"><label><input type="checkbox" id="eye2" style="display:none" onclick="(function(e, el){
                                document.getElementById('password2').type = el.checked ? 'text' : 'password';
                                el.parentNode.lastElementChild.innerHTML = el.checked ? '<i style=\'cursor: pointer\' class=\'fas fa-eye-slash\'>' : '<i style=\'cursor: pointer\' class=\'fas fa-eye\'>';
                                         })(event, this)">
                                <span><i class="fas fa-eye" style="cursor: pointer"></i></span>
                            </label>
                        </span>
                    </div>
                    <div style="display:flex; justify-content: flex-end;">
                        <button type="submit" name="updateOfficialUserPassword" class="btn btn-danger">Güncelle</button>
                    </div>
                </form>
            </div>
        </div>
        </div>

        </div>
        <script>
            function setCookie(cname, cvalue) {
                document.cookie = cname + "=" + cvalue;
            }

            function logOut() {
                localStorage.clear();
                setCookie('user_type', '0');
            }
        </script>
    </main>
</body>