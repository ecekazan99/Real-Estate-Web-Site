<?php
require_once("operation.php");

$userTypeforButton = $_COOKIE['user_type'];
$advertisementIDForDisplaying =  $_COOKIE['advertisementIDForDisplaying'];
$sqlForDisplayingCount = "UPDATE tbl_advertisements SET ads_displayed_count= ads_displayed_count+1 WHERE ads_ID=$advertisementIDForDisplaying";
$resultQueryForDisplayingCount = mysqli_query($GLOBALS['con'], $sqlForDisplayingCount);
$sqlForCurrentAdsDisplay = "SELECT * FROM tbl_advertisements WHERE ads_ID= '$advertisementIDForDisplaying'";
$resultQueryForCurrentAdvertisement = mysqli_query($GLOBALS['con'], $sqlForCurrentAdsDisplay);
$getValueForDisplayingAdvertisement = mysqli_fetch_array($resultQueryForCurrentAdvertisement);
$myarr =  $getValueForDisplayingAdvertisement;

$ads_Price =  $myarr['ads_price'];
$ads_Description =  $myarr['ads_description'];
$ads_Type = $myarr['ads_type'];
$ads_Province = $myarr['ads_province'];
$ads_Town = $myarr['ads_town'];
$ads_Neighbourhood = $myarr['ads_neighbourhood'];
$ads_Address = $myarr['ads_address'];
$ads_Housetype = $myarr['ads_housetype'];
$ads_Area = $myarr['ads_area'];
$ads_Roomnumber = $myarr['ads_roomnumber'];
$ads_Floor = $myarr['ads_floor'];
$ads_Age = $myarr['ads_age'];
$ads_Heatingsystem = $myarr['ads_heatingsystem'];
$ads_Facade = $myarr['ads_facade'];
$ads_Otopark = $myarr['ads_otopark'];
$ads_Pool = $myarr['ads_pool'];
$ads_Security = $myarr['ads_security'];
$ads_Kidsplaygarden = $myarr['ads_kidsplaygarden'];
$ads_Date = $myarr['ads_date'];

$agency_ID =  $myarr['agency_ID'];

setcookie("Agency_ID", $agency_ID);

$sqlForAgency = "SELECT * FROM tbl_OfficalUsers WHERE userID= '$agency_ID'";
$resultQueryForAgencyInfo = mysqli_query($GLOBALS['con'], $sqlForAgency);
$getValueForDisplayingAgency = mysqli_fetch_array($resultQueryForAgencyInfo);
$myarrAgency =  $getValueForDisplayingAgency;
$ads_FirmName = $myarrAgency['FirmName'];
$ads_Address = $myarrAgency['Address'];
$ads_Phone = $myarrAgency['Phone'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Display Advertisement</title>
    <link rel="icon" type="image/png" href="../Images/favIcon.png" />
    <link rel="stylesheet" href="../Stylings/HouseCardStyling.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../Stylings/MainPageWithoutLogin.css">
    <link rel="stylesheet" type="text/css" href="..\Stylings\myInterests.css">
    <link rel="stylesheet" href="AddAdvertisementPage.css">

</head>

<body>
    <header>

        <div style="float:left;margin: 5px 50px;">
            <a href="MainPage.php"><i class="fas fa-home" style="color:#bd2130; padding:10px; font-size: 30px;border:1px solid white;border-radius: 100%;box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.3);"></i></a>
        </div>
        <div style="float:right;margin: 5px 50px;" class="dropdown">
            <div id="twobuttonDisplay" class="buttontwo" style="float:right;margin: 5px 50px;"></div>
            <div id="buttonDisplay" class="dropdown" style="float:right;margin: 5px 50px; "></div>
        </div>
        <br><br>
        <div>
            <a href="MainPage.php"><img src="../Images/logo.png" alt="Logo" style="max-width:100%; height:auto;display: block;margin-left: auto;margin-right: auto;" /></a>
        </div>
        <div style="margin-left: 75%" id="favoriteDiv">
            <!-- Add icon library -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <!-- Use an element to toggle between a like/dislike icon -->
            <form method="POST" action="operation.php">
                <div style="display: flex;flex-direction: row;justify-content: flex-start;margin-bottom: 0;cursor: pointer">
                    <button type="submit" style="border:none" name="add_remove_from_favourites" id="likeStatus">
                        <i class="far fa-heart" style="color: #c0392b;font-size: 35px"></i>
                        </i>

                        <?php
                        $userID = $_COOKIE['user_id'];
                        $advertisementIDForDisplaying = $_COOKIE['advertisementIDForDisplaying'];
                        $user_type = $_COOKIE['user_type'];
                        if ($user_type != null && $user_type == 1) {
                            $sqlForCheckingCurrentAdsFavOrNot = "SELECT * FROM tbl_IndividualUsers_Favourited WHERE individual_UserID= $userID AND advertisementID=$advertisementIDForDisplaying";
                        } else if ($user_type != null && $user_type == 2) {
                            $sqlForCheckingCurrentAdsFavOrNot = "SELECT * FROM tbl_OfficialUsers_Favourited WHERE official_UserID= $userID AND advertisementID=$advertisementIDForDisplaying";
                        }

                        $queryForCurrentFavorAdvertisement = mysqli_query($GLOBALS['con'], $sqlForCheckingCurrentAdsFavOrNot);
                        $countOfCurrentAdsAndIndividualUser = mysqli_num_rows($queryForCurrentFavorAdvertisement);

                        if ($countOfCurrentAdsAndIndividualUser > 0) { ?>
                            <script>
                                document.getElementById("likeStatus").innerHTML = '<i class="fas fa-heart" style="color: #c0392b;font-size: 35px"></i>';
                            </script>
                        <?php
                        } else { ?>
                            <script>
                                document.getElementById("likeStatus").innerHTML = '<i class="far fa-heart" style="color: #c0392b;font-size: 35px"></i>';
                            </script>
                        <?php } ?>
                        <div style="margin-left: 40px" id="alertField">
                        </div>
                </div>
            </form>
            <script>
                function myFunction(status) {

                    if (status) {
                        document.getElementById("alertField").innerHTML = '<div class="alert alert-danger" style="margin: 0;padding: 6px" role="alert">İlan favorilere eklendi</div>';
                        document.getElementById("likeStatus").innerHTML = '<i class="fas fa-heart" style="color: #c0392b;font-size: 35px"></i>';
                    } else {
                        document.getElementById("alertField").innerHTML = '<div class="alert alert-danger" style="margin: 0;padding: 6px" role="alert">İlan favorilerden çıkarıldı.</div>';
                        document.getElementById("likeStatus").innerHTML = '<i class="far fa-heart" style="color: #c0392b;font-size: 35px"></i>';
                    }
                    this.autoRemoveAlertBox();

                }
            </script>
        </div>
    </header>
    <script>
        function sleep(time) {
            return new Promise((resolve) => setTimeout(resolve, time));
        }

        function autoRemoveAlertBox() {
            sleep(2500).then(() => {
                document.getElementById("alertField").innerHTML = "";
            });
        }


        window.onload = function() {

            let address = $('#addressInfo').text();
            var a = "https://maps.google.com/maps?q=" + eval("address") + "&t=&z=19&ie=UTF8&iwloc=&output=embed";

            $('#gmap_canvas').attr('src', a)


        }
    </script>
    <main style="display: flex;align-items: center;justify-content: center">

        <div style="display: flex;flex:16;justify-content: center;flex-direction: column">
            <div title="İlanın görselleri" style="display:flex;flex:6;justify-content:center;align-items: center; flex-direction:column;">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

                        <?php

                        $queryForAdsImages = "SELECT * FROM tbl_advertisementimages WHERE advertisementID = $advertisementIDForDisplaying";
                        $adsImageResult = mysqli_query($GLOBALS['con'], $queryForAdsImages);
                        $countOfImages = mysqli_num_rows($adsImageResult);
                        $currImageIndex = true;
                        if ($countOfImages > 0) {

                            while ($row = $adsImageResult->fetch_assoc()) {
                                $imageURL = 'Advertisement_Images/' . $row["file_name"];
                        ?>

                                <?php if ($currImageIndex) { ?>
                                    <div class="carousel-item active"> <img style="width:100%;height:300px" src="<?php echo $imageURL; ?>" alt="" /></div>
                                <?php } else { ?>
                                    <div class="carousel-item"> <img style="width:100%;height:300px" src="<?php echo $imageURL; ?>" alt="" /></div>
                                <?php }
                                $currImageIndex = false; ?>

                            <?php }
                        } else { ?>
                            <p>No image(s) found...</p>
                        <?php } ?>
                    </div>

                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div>


                <div style="display: flex;flex: 10;width: 50%">
                    <div title="İlan Bilgileri" style="display: flex;flex: 10;flex-direction: row;align-items: center;width: 100%;margin-top: 5px">
                        <div style="display: flex; flex :7;flex-direction: column;background-color: rgba(232,232,232,0.77)  ; box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.3)
   ;border: 1px solid rgba(104,102,102,0.24);padding:20px">
                            <div style="display: flex;justify-content:space-between;flex-direction: row">
                                <h3 id="adsType" style="float: left;box-shadow: 5px 5px 5px 0 rgba(0, 0, 0, 0.1);
            background-color: rgba(232,232,232,0.04);border: 1px solid rgba(104,102,102,0.24);border-radius:10%;padding: 7px;font-style: italic">
                                    <?php echo $ads_Type ?>
                                </h3>
                                <h3 style="float: right;box-shadow: 5px 5px 5px 0 rgba(0, 0, 0, 0.1);
            background-color: rgba(246,246,246,0.04);border: 1px solid rgba(104,102,102,0.24);border-radius:10%;padding: 7px;font-style: italic" id="priceOfEstate">
                                    <?php echo $ads_Price . "₺" ?>
                                </h3>
                            </div>

                            <div>
                                <h4 id="adsDescription" style="display: flex;flex-direction: row;justify-content: flex-start">
                                    <?php echo $ads_Description ?>
                                </h4>
                            </div>

                            <div style="display: flex; flex:10;flex-direction: row">
                                <div style="display: flex;flex: 9;flex-direction: row;justify-content: flex-start">
                                    <h7 id="addressInfo">
                                        <?php echo $ads_Address . " /" . $ads_Neighbourhood . " /" . $ads_Town . " /" . $ads_Province ?>
                                    </h7>
                                </div>
                                <div style="display: flex;flex: 1;flex-direction: row;justify-content:flex-end">
                                    <div class="map">
                                        <button style="display: flex;float: right" class="btn">
                                            <img src="..\Images\icon.png" style="width:40px;height:40px; ">
                                        </button>
                                        <div class="content" style="width: inherit;height: inherit">
                                            <span class="mapouter">
                                                <span class="gmap_canvas"><iframe width="400" height="300" id="gmap_canvas" src="about:blank" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                                    <a href="https://www.whatismyip-address.com/nordvpn-coupon/"></a>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="font-family: inherit">
                                </br>
                                <div>
                                    <h7>Konut Tipi: <span id="houseType"></span>
                                        <?php echo $ads_Housetype ?>
                                    </h7>
                                </div>
                                <div>
                                    <h7>Metrekare: <span id="areaInfo"></span>
                                        <?php echo $ads_Area ?></h7>
                                </div>
                                <div>
                                    <h7>Oda Sayısı: <span id="numberOfRoomsInfo">
                                            <?php echo $ads_Roomnumber
                                            ?>
                                        </span></h7>
                                </div>
                                <div>
                                    <h7>Bulunduğu Kat: <span id="floorInfo">
                                            <?php echo $ads_Floor ?>
                                        </span></h7>
                                </div>
                                <div>
                                    <h7>Bina Yaşı: <span id="ageOfConstructInfo">
                                            <?php echo $ads_Age ?>
                                        </span></h7>
                                </div>
                                <div>
                                    <h7>Isıtma Sistemi: <span id="warmingSystemInfo"></span>
                                        <?php echo $ads_Heatingsystem ?></h7>
                                </div>
                                <div>
                                    <h7>Cephe: <span id="facadeInfo"></span> <?php echo $ads_Facade ?></h7>
                                </div>
                                <div>
                                    <h7>Ek Özellikler: <span id="additionalDataInfo"> <?php
                                                                                        if ($ads_Kidsplaygarden) {
                                                                                            echo "<br><t><t><t>-Çocuk Oyun Alanı /";
                                                                                        }
                                                                                        if ($ads_Pool) {
                                                                                            echo "<br>-Havuz ";
                                                                                        }
                                                                                        if ($ads_Otopark) {
                                                                                            echo "<br>-Otopark ";
                                                                                        }
                                                                                        if ($ads_Security) {
                                                                                            echo "<br>-Özel Güvenlik ";
                                                                                        }

                                                                                        ?></span></h7>
                                </div>
                                <div>
                                    <h7 style="font-style: italic;float: right" id="dateInfo"> <?php echo $ads_Date ?></h7>
                                </div>
                            </div>
                        </div>

                        <div title="İlanı veren emlak ofisi" style="display: flex;flex:3;flex-direction: column;width:100%;height:100%;justify-content: center;padding-top:30px;margin-left: 10px;
                        padding-bottom:30px;align-items: center;text-align: center;background-color: rgba(232,232,232,0.77)  ;
                        box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.3);border: 1px solid rgba(104,102,102,0.24)">
                            <a style="cursor:pointer;color:inherit;text-decoration:inherit" href="DisplayAgencyOfficerProfile.php">
                                <div>
                                    <?php echo '<img src="Official_Users_Images/' . $myarrAgency['UserProfileImage'] . '" width="145" height="182" alt="Emlakçı Fotoğraf">'; ?>
                                </div>
                                <div>
                                    <h5 id="agencyName"><?php echo $ads_FirmName; ?></h5>
                                </div>
                                <div>
                                    <h6>Gsm: <span id="agencyPhoneNumber"><?php echo $ads_Phone; ?></span></h6>
                                </div>
                                <div>
                                    <h6 id="agencyAddress"><?php echo $ads_Address; ?></h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php require_once("SearchAndUpdate.php"); ?>
    </main>
    <?php
    echo '<script>
   
        $(document).ready(function() {
            
            buttonUserType("' . $userTypeforButton . '");
        });
        </script>;';

    echo '<script>
        if (localStorage.getItem("userTypeID") === null) {
            var elem = document.getElementById("favoriteDiv");
            elem.parentNode.removeChild(elem);
        } ;  
        </script>';
    ?>
</body>

</html>