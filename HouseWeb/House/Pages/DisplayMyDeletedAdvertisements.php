<?php

// This file is created for displaying deleted advertisement of agency
require_once("operation.php");

$userTypeforButton = $_COOKIE['user_type'];
$userID = $_COOKIE['user_id'];
$advertisementIDForDisplaying =  $_COOKIE['advertisementIDForDisplaying'];

$sqlForCurrentAdsDisplay = "SELECT * FROM tbl_advertisements WHERE agency_ID='$userID' AND ads_status!=1 AND ads_ID= '$advertisementIDForDisplaying'";
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
$ads_Displayed_Count = $myarr['ads_displayed_count'];
$ads_Favoring_Count = $myarr['ads_favoriting_count'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Display My Deleted Advertisement</title>
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
                <div style="display: flex;width: 50%">
                    <div style="display: flex;flex: 10;justify-content:flex-start;flex-direction: row;align-items: flex-start;width: 100%;margin-top: 5px">
                        <div style="display: flex; flex :7;flex-direction: column;background-color: rgba(232,232,232,0.77)  ; box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.3)
   ;border: 1px solid rgba(104,102,102,0.24);padding:20px">
                            <div style="display: flex;justify-content:space-between;flex-direction: row">
                                <?php echo ' <h3 id="adsType" style="float: left;box-shadow: 5px 5px 5px 0 rgba(0, 0, 0, 0.1);
            background-color: rgba(232,232,232,0.04);border: 1px solid rgba(104,102,102,0.24);border-radius:10%;padding: 7px;font-style: italic">' . $ads_Type . '</h3>' ?>
                                <?php echo ' <h3 style="float: right;box-shadow: 5px 5px 5px 0 rgba(0, 0, 0, 0.1);
            background-color: rgba(246,246,246,0.04);border: 1px solid rgba(104,102,102,0.24);border-radius:10%;padding: 7px;font-style: italic" id="priceOfEstate">' . $ads_Price . ' ₺</h3>' ?>
                            </div>

                            <div>
                                <?php echo '<h4 id="adsDescription" style="display: flex;flex-direction: row;justify-content: flex-start">' . $ads_Description . '</h4>' ?>
                            </div>

                            <div style="display: flex; flex:10;flex-direction: row">
                                <div style="display: flex;flex: 9;flex-direction: row;justify-content: flex-start">
                                    <?php echo '<h7 id="addressInfo">' . $ads_Address . ' ' . $ads_Neighbourhood . '/' . $ads_Town . '/' . $ads_Province . '</h7>' ?>
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
                                                    let address = $('#addressInfo').text();
                                                    var a = "https://maps.google.com/maps?q=" + eval("address") + "&t=&z=19&ie=UTF8&iwloc=&output=embed";
                                                    console.log(a);
                                                    $('#gmap_canvas').attr('src', a)
                                                </script>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="font-family: inherit">
                                </br>
                                <div>
                                    <?php echo '<h7>Konut Tipi: <span id="houseInfo">' . $ads_Housetype . '</span></h7>' ?>
                                </div>
                                <div>
                                    <?php echo '<h7>Metrekare: <span id="areaInfo">' . $ads_Area . '</span></h7>' ?>
                                </div>
                                <div>
                                    <?php echo '<h7>Oda Sayısı: <span id="numberOfRoomsInfo">' . $ads_Roomnumber . '</span></h7>' ?>
                                </div>
                                <div>
                                    <?php echo '<h7>Bulunduğu Kat: <span id="floorInfo">' . $ads_Floor . '</span></h7>' ?>
                                </div>
                                <div>
                                    <?php echo '<h7>Bina Yaşı: <span id="ageOfConstructInfo">' . $ads_Age . '</span></h7>' ?>
                                </div>
                                <div>
                                    <?php echo '<h7>Isıtma Sistemi: <span id="warmingSystemInfo">' . $ads_Heatingsystem . '</span></h7>' ?>
                                </div>
                                <div>
                                    <?php echo '<h7>Cephe: <span id="facadeInfo">' . $ads_Facade . '</span></h7>' ?>
                                </div>
                                <div>
                                    <h7>Ek Özellikler: <span id="additionalDataInfo"><?php
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
                                    <h7 style="font-style: italic;float: right" id="dateInfo"><?php echo $ads_Date ?></h7>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex;flex:3;flex-direction: column;width:100%;justify-content: flex-start;margin-top: 0;margin-left: 10px;
                    align-items: center;text-align: center;background-color: rgba(232,232,232,0.77)  ;padding: 20px;
                    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.3);border: 1px solid rgba(104,102,102,0.24)">
                            <div>
                                <h4 style="font-weight: bold">İlan Etkileşim Bilgileri</h4>
                            </div>
                            <div>
                                <h7 style="display: flex">Görüntülenme Sayısı : <span id="viewCount"> <?php echo $ads_Displayed_Count ?></span></h7>
                            </div>
                            <div>
                                <h7>Beğenilme Sayısı: <span id="likeCount"><?php echo $ads_Favoring_Count ?></span></h7>
                            </div>
                        </div>
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

</html>