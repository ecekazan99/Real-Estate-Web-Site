<?php
// This file is created for displaying agency profile of an advertisement
require_once("operation.php");
$userTypeforButton = $_COOKIE['user_type'];
$agency_ID = $_COOKIE['Agency_ID'];

$sqlForAgencyProfile = "SELECT * FROM tbl_OfficalUsers WHERE userID= '$agency_ID'";
$resultQueryForAgencyInfo = mysqli_query($GLOBALS['con'], $sqlForAgencyProfile);
$getValueForDisplayingAgency = mysqli_fetch_array($resultQueryForAgencyInfo);

$agency_name =  $getValueForDisplayingAgency['FirmName'];
$agency_phoneNumber =  $getValueForDisplayingAgency['Phone'];
$agency_address = $getValueForDisplayingAgency['Address'];
$agency_mail = $getValueForDisplayingAgency['MailAddress'];
$cookiename = 'DisplayAgencyOfficerProfile';
$value = 'MyDeletedAdvertisementsPage';
setcookie($cookiename, $value);
echo '<script>window.onload = function() {
        if(!window.location.hash) {
            window.location = window.location + "#loaded";
            window.location.reload();
        }
    }</script>';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Agency Officer Profile</title>
    <link rel="icon" type="image/png" href="../Images/favIcon.png" />
    <link rel="stylesheet" href="../Stylings/HouseCardStyling.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../Stylings/mainPageWithoutLogin.css">
    <link rel="stylesheet" type="text/css" href="..\Stylings\myInterests.css">
</head>

<body>

    <header>
        <div style="float:left;margin: 5px 50px;">
            <a href="MainPage.php"><i class="fas fa-home" style="color:#bd2130; padding:10px; font-size: 30px;border:1px solid white;border-radius: 100%;box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.3);"></i></a>
        </div>
        <div style="display: flex;flex-direction: column;float:right;">
            <div id="twobuttonDisplay" class="buttontwo" style="float:right;margin: 5px 50px;"></div>
            <div id="buttonDisplay" class="dropdown" style="float:right;margin: 5px 50px; "></div>
        </div>
        <br><br>
        <div style="display: flex;flex-direction: column">
            <a href="MainPage.php"> <img src="../Images/logo.png" alt="Logo" style="max-width:100%; height:auto;display: block;margin-left: auto;margin-right: auto;" /></a>
        </div>
    </header>
    <main style="display: flex;justify-content: center;align-items:center;flex-direction: column">

        <div style="display: flex;flex-direction: column;justify-content: center;width: 800px">
            <div class="row" style="display:flex;margin-left:2px">

                <?php echo '<img src="Official_Users_Images/' . $getValueForDisplayingAgency['UserProfileImage'] . '" class="officialImg" style="width:120px;height:170px;">'; ?>
                <div class="card" style="width: 67%">
                    <h5 class="card-header">Organizasyon İsmi: <?php echo $agency_name; ?> </h5>
                    <div class="card-body" style="background-color:gainsboro">
                        <h7> Telefon numarası: <?php echo $agency_phoneNumber; ?> </h7><br>
                        <!--Agency address in Google maps-->
                        <h7 style="display: flex; justify-content:flex-start; flex-direction: row;">Adres:
                            <h7 id="address"> <?php echo $agency_address; ?></h7>
                            <div class="map">
                                <button class="btn mapBtn">
                                    <img src="..\Images\icon.png" style="width:40px;height:40px; ">
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
                                            let address = $('#address').text();
                                            var a = "https://maps.google.com/maps?q=" + eval("address") + "&t=&z=19&ie=UTF8&iwloc=&output=embed";
                                            console.log(a);
                                            $('#gmap_canvas').attr('src', a)
                                        </script>
                                    </span>
                                </div>
                            </div>
                        </h7>
                        <h7> Mail adresi: <?php echo $agency_mail; ?></h7>
                    </div>
                </div>
            </div><br>
            <div style="display:flex;flex-direction:row;">
                <div class="CardsContainerStyle">

                    <div class="DisplayAllilans" id="issuesList" style="border: 1px solid black"></div>
                    <div>
                        <div class="pagenumbers" id="pagination"></div>
                    </div>
                </div>
            </div>

        </div>

    </main>
    <?php require_once("DisplayAdvertisementsCard.php"); ?>
    <?php require_once("SearchAndUpdate.php"); ?>
    <?php
    // for displaying account button
    echo '<script>
   
        $(document).ready(function() {
            
            buttonUserType("' . $userTypeforButton . '");
        });
        </script>;'
    ?>
</body>

</html>