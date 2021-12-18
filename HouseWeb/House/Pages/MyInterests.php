<?php
// This file is created for determining interest
include "SearchAndUpdate.php";
include "operation.php";
$userTypeforButton = $_COOKIE['user_type'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="../Images/favIcon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Interests</title>
    <link rel="stylesheet" href="../Stylings/HouseCardStyling.css">
    <link rel="icon" type="image/png" href="../Images/favIcon.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../Stylings/MainPageWithoutLogin.css">
    <link rel="stylesheet" type="text/css" href="..\Stylings\myInterests.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <header>
        <div style="float:left;margin: 5px 50px;">
            <a href="MainPage.php"><i class="fas fa-home" style="color:#bd2130; padding:10px; font-size: 30px;border:1px solid white;border-radius: 100%;box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.3);"></i></a>
        </div>
        <div style="float:right;">
            <div id="buttonDisplay" class="dropdown" style="float:right;margin: 5px 50px; "></div>
        </div>
        <br><br>
        <div>
            <a href="MainPage.php"><img src="../Images/logo.png" alt="Logo" style="max-width:100%; height:auto;display: block;margin-left: auto;margin-right: auto;" /></a>
        </div>
    </header>
    <br>
    <div id="buttonGroup" style="display:flex;flex-direction:row;justify-content: center;align-items: center;width:60%; margin: 5px 300px;">
        <a class="btn btn-secondary" style="display: flex;flex: 2" href="MyInterests.php">İlgilendiğim İlan Özellikleri</a>
        <a class="btn btn-outline-secondary" name="MyInterestsDisplay" style="display: flex;flex: 2" href="MyInterestsAdvertisementsDisplay.php">İlgilendiğim İlanlar</a>
    </div>
    <br>

    <main style="display: flex;justify-content: center;align-items:center;flex-direction: column">
        <div style="display: flex;flex-direction: column;justify-content: center;width: 800px">
            <div style="display:flex;flex-direction:row">
                <div class="date mt-3 mb-1" id="dateDropdowns" style="width: 30%;">
                    <form class="pure-form-filter" action="" method="POST">
                        <h5 style="display: flex;justify-content: center;width: 90%;"> İLAN FİLTRELERİ</h5>
                        <div class="dropdown" style="width: 100%;padding-bottom:3px;">
                            <select style="width:90%;border:1px solid black;" class="btn btn-outline" style="max-height: 200px; width: 220px;" name="rentOrSaleOption" id="rentOrSaleOption" required>
                                <option class="dropdown-item" value="" style="display:none">Satılık/Kiralık</option>
                                <option class="dropdown-item" value="Satılık">Satılık</option>
                                <option class="dropdown-item" value="Kiralık">Kiralık</option>
                            </select>
                            <font size="2">
                                <div id="rentOrSale" style="width:90%; color:red;"></div>
                            </font>
                        </div>
                        <div class="dropdown" style="width: 100%;padding-bottom:3px;">
                            <select style="width:90%;border:1px solid black;" class="btn btn-outline" style="max-height: 200px; width: 220px;" name="countryOption" id="countryOption" required>
                                <option class="dropdown-item" value="" style="display:none">İl</option>
                                <?php
                                $sql = "SELECT * FROM Province ORDER BY province_title";
                                $result = mysqli_query($con, $sql);
                                while ($province = mysqli_fetch_array($result)) {
                                    echo ' <option class="dropdown-item" value="' . $province['province_key'] . '">' . $province['province_title'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <font size="2">
                            <div id="country" style="width:90%; color:red;"></div>
                        </font>
                        <div class="dropdown" style="width: 100%;padding-bottom:3px;">
                            <select style="width: 90%;border:1px solid black;" class="btn btn-outline" style="max-height: 200px; width: 220px;" name="townOption" id="townOption" required>
                                <option class="dropdown-item" value="" style="display:none">İlçe</option>


                            </select>
                        </div>
                        <div class="dropdown" style="width: 100%;padding-bottom:3px;">
                            <select style="width: 90%;border:1px solid black;" class="btn btn-outline" style="max-height: 200px; width: 220px;" name="neighborhoodOption" id="neighborhoodOption" required>
                                <option class="dropdown-item" value="" style="display:none">Mahalle</option>


                            </select>
                        </div>
                        <div class="dropdown" style="width: 100%;padding-bottom:3px;">
                            <select style="width: 90%;border:1px solid black;" class="btn btn-outline" style="max-height: 200px; width: 220px;" name="residentialTypeOption" id="residentialTypeOption" required>
                                <option class="dropdown-item" value="" style="display:none">Konut Tipi</option>
                                <option class="dropdown-item" value="Daire">Daire</option>
                                <option class="dropdown-item" value="Villa">Villa</option>
                                <option class="dropdown-item" value="Müstakil Ev">Müstakil Ev</option>
                                <option class="dropdown-item" value="Residence">Residence</option>
                                <option class="dropdown-item" value="Yazlık">Yazlık</option>
                            </select>
                        </div>
                        <h6 style="margin:2px 2px"> Fiyat Aralığı</h6>

                        <div class="form-row" style="width: 94%;padding-bottom:3px;">
                            <div class="col ">
                                <input type="text" name="minPrice" style="border:1px solid black;" id="minPrice" class="form-control btn-outline" placeholder="Min" pattern="\d*" title="Bu input'a sadece sayısal değer girilebilir" required>
                            </div>
                            <div class="col">
                                <input type="text" name="maxPrice" style="border:1px solid black;" id="maxPrice" class="form-control btn-outline" placeholder="Max" pattern="\d*" title="Bu input'a sadece sayısal değer girilebilir" required>
                            </div>
                        </div>
                        <font size="2">
                            <div id="minMaxPrice" style="width:90%; color:red;"></div>
                        </font>
                        <h6 style="margin:2px 2px"> Mertekare Aralığı</h6>

                        <div class="form-row" style="width: 94%;padding-bottom:3px;">
                            <div class="col ">
                                <input type="text" name="minArea" style="border:1px solid black;" id="minSquareMeters" class="form-control btn-outline" placeholder="Min" pattern="\d*" title="Bu input'a sadece sayısal değer girilebilir" required>
                            </div>
                            <div class="col">
                                <input type="text" name="maxArea" style="border:1px solid black;" id="maxSquareMeters" class="form-control btn-outline" placeholder="Max" pattern="\d*" title="Bu input'a sadece sayısal değer girilebilir" required>
                            </div>
                        </div>
                        <font size="2">
                            <div id="minMaxSquareMeters" style="width:90%; color:red;"></div>
                        </font>
                        <div class="dropdown" style="width: 100%;padding-bottom:3px;">
                            <select style="width: 90%;border:1px solid black;" class="btn btn-outline" style="max-height: 200px; width: 220px;" name="roomOption" id="roomOption">
                                <option class="dropdown-item" value="" style="display:none">Oda Sayısı</option>
                                <option class="dropdown-item" value="1+1">1+1</option>
                                <option class="dropdown-item" value="2+1">2+1</option>
                                <option class="dropdown-item" value="3+1">3+1</option>
                                <option class="dropdown-item" value="4+1">4+1</option>
                                <option class="dropdown-item" value="5+1">5+1</option>
                                <option class="dropdown-item" value="6+1">6+1</option>
                            </select>
                        </div>

                        <h6 style="margin:2px 2px"> Bina Yaş Aralığı</h6>

                        <div class="form-row" style="width: 94%;padding-bottom:3px;">
                            <div class="col ">
                                <input type="text" style="border:1px solid black;" name="minAge" id="minAge" class="form-control btn-outline" placeholder="Min" pattern="\d*" title="Bu input'a sadece sayısal değer girilebilir" required>
                            </div>
                            <div class="col">
                                <input type="text" style="border:1px solid black;" name="maxAge" id="maxAge" class="form-control btn-outline" placeholder="Max" pattern="\d*" title="Bu input'a sadece sayısal değer girilebilir" required>
                            </div>
                        </div>
                        <font size="2">
                            <div id="minMaxAge" style="width:90%; color:red;"></div>
                        </font>

                        <div class="dropdown" style="width: 100%;padding-bottom:3px;">
                            <select style="width: 90%; border:1px solid black;" class="btn btn-outline" style="max-height: 200px; width: 220px;" name="floorOption" id="floorOption" required>
                                <option class="dropdown-item" value="" style="display:none">Bulunduğu Kat</option>
                                <option class="dropdown-item" value="0">0</option>
                                <option class="dropdown-item" value="1">1</option>
                                <option class="dropdown-item" value="2">2</option>
                                <option class="dropdown-item" value="3">3</option>
                                <option class="dropdown-item" value="4">4</option>
                                <option class="dropdown-item" value="5">5</option>
                                <option class="dropdown-item" value="6">6</option>
                                <option class="dropdown-item" value="7">7</option>
                                <option class="dropdown-item" value="8">8</option>
                                <option class="dropdown-item" value="9">9</option>
                                <option class="dropdown-item" value="10">10</option>
                                <option class="dropdown-item" value="11">11</option>
                                <option class="dropdown-item" value="12">12</option>
                                <option class="dropdown-item" value="13">13</option>
                                <option class="dropdown-item" value="14">14</option>
                                <option class="dropdown-item" value="15">15</option>
                                <option class="dropdown-item" value="16">16</option>
                                <option class="dropdown-item" value="17">17 ve üzeri</option>
                            </select>
                        </div>
                        <div class="dropdown" style="width: 100%;padding-bottom:3px;">
                            <select style="width: 90%;border:1px solid black;" class="btn btn-outline" style="max-height: 200px; width: 220px;" name="heatingOption" id="heatingOption" required>
                                <option class="dropdown-item" value="" style="display:none">Isınma Sistemi</option>
                                <option class="dropdown-item" value="Doğalgaz">Doğalgaz</option>
                                <option class="dropdown-item" value="Merkezi">Merkezi</option>
                                <option class="dropdown-item" value="Soba">Soba</option>
                                <option class="dropdown-item" value="Isınma Yok">Isınma Yok</option>
                            </select>
                        </div>

                        <div class="dropdown" style="width: 100%;padding-bottom:3px;">
                            <select style="width: 90%;border:1px solid black;" class="btn btn-outline" style="max-height: 200px; width: 220px;" name="frontOption" id="frontOption" required>
                                <option class="dropdown-item" value="" style="display:none">Cephe</option>
                                <option class="dropdown-item" value="Kuzey">Kuzey</option>
                                <option class="dropdown-item" value="Güney">Güney</option>
                                <option class="dropdown-item" value="Doğu">Doğu</option>
                                <option class="dropdown-item" value="Batı">Batı</option>

                            </select>
                        </div>
                        <div class="dropdown" style="width: 100%;padding-bottom:3px;">
                            <select style="width: 90%;border:1px solid black;" class="btn btn-outline" style="max-height: 200px; width: 220px;" name="additionalOption" id="additionalOption" required>
                                <option class="dropdown-item" value="" style="display:none">Ek Özellikler</option>
                                <option class="dropdown-item" value="Otopark">Otopark</option>
                                <option class="dropdown-item" value="Havuz">Havuz</option>
                                <option class="dropdown-item" value="Güvenlik">Güvenlik</option>
                                <option class="dropdown-item" value="Asansör">Asansör</option>
                                <option class="dropdown-item" value="Çocuk Oyun Parkı">Çocuk Oyun Parkı</option>
                            </select>
                        </div>
                        <div style="display: flex;flex-direction: row">
                            <button id="myBtn" name="Update" type="submit" class="btn btn-secondary" style="margin-left:33px;margin-top:5px ;padding: 6px 40px">Güncelle</button>
                        </div>
                    </form>
                </div>

                <div class="card" style="width: 70%">
                    <h7 class="card-header">İLGİLENDİĞİM İLAN ÖZELLİKLERİ</h7>
                    <div class="card-body" style="background-color:gainsboro">
                        <p>
                            <?php
                            if (isset($_POST['Update'])) {
                                if ($_POST['maxArea'] < $_POST['minArea'] || $_POST['maxPrice'] < $_POST['minPrice'] || $_POST['maxAge'] < $_POST['minAge']) {
                                    echo '<table bgcolor="ff0000" align="right"><tr> <td align="right"><font size="5">KAYDEDİLMEDİ</font></td></tr></table>';
                                } else {
                                    echo '<table bgcolor="00bf00" align="right"><tr> <td align="right"><font size="5">KAYDEDİLDİ</font></td></tr></table>';
                                }
                            }
                            ?>
                        </p>
                        <p> Satılık/Kiralık:
                            <?php
                            if (isset($_POST['Update'])) {
                                if ($_POST['maxArea'] < $_POST['minArea'] || $_POST['maxPrice'] < $_POST['minPrice'] || $_POST['maxAge'] < $_POST['minAge']) {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="rentOrSaleDisplay">' . $getSel['AdvType'] . '</i></font>';
                                } else {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="rentOrSaleDisplay">' . $_POST['rentOrSaleOption'] . '</i></font>';
                                }
                            } else
                                echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="rentOrSaleDisplay">' . $getSel['AdvType'] . '</i></font>';
                            ?>
                        </p>
                        <p>Şehir:
                            <?php
                            if (isset($_POST['Update'])) {
                                $province = $_POST['countryOption'];
                                $findProvince = "SELECT * FROM Province WHERE province_key='$province'";
                                $findName = mysqli_query($con, $findProvince);
                                $getName = mysqli_fetch_array($findName);
                                $province = $getName['province_title'];

                                if ($_POST['maxArea'] < $_POST['minArea'] || $_POST['maxPrice'] < $_POST['minPrice'] || $_POST['maxAge'] < $_POST['minAge']) {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="countryDisplay">' . $getSel['Province'] . '</i></font>';
                                } else {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="countryDisplay">' . $province . '</i></font>';
                                }
                            } else
                                echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="countryDisplay">' . $getSel['Province'] . '</i></font>';
                            ?>
                        </p>
                        <p>İlçe:
                            <?php
                            if (isset($_POST['Update'])) {
                                $town = $_POST['townOption'];
                                $findTown = "SELECT * FROM Town WHERE town_key='$town'";
                                $findName = mysqli_query($con, $findTown);
                                $getName = mysqli_fetch_array($findName);
                                $town = $getName['town_title'];

                                if ($_POST['maxArea'] < $_POST['minArea'] || $_POST['maxPrice'] < $_POST['minPrice'] || $_POST['maxAge'] < $_POST['minAge']) {
                                    echo ' <font size="4" style="color: rgb(42, 15, 163);"><i id="townDisplay">' . $getSel['Town'] . '</i></font>';
                                } else {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="townDisplay">' . $town . '</i></font>';
                                }
                            } else
                                echo ' <font size="4" style="color: rgb(42, 15, 163);"><i id="townDisplay">' . $getSel['Town'] . '</i></font>';
                            ?>
                        </p>
                        <p>Mahalle:
                            <?php
                            if (isset($_POST['Update'])) {
                                $neighborhood = $_POST['neighborhoodOption'];
                                $findNeighborhood = "SELECT * FROM Neighborhood WHERE neighborhood_key='$neighborhood'";
                                $findName = mysqli_query($con, $findNeighborhood);
                                $getName = mysqli_fetch_array($findName);
                                $neighborhood = $getName['neighborhood_title'];

                                if ($_POST['maxArea'] < $_POST['minArea'] || $_POST['maxPrice'] < $_POST['minPrice'] || $_POST['maxAge'] < $_POST['minAge']) {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="neighborhoodDisplay">' . $getSel['Neighborhood'] . '</i></font>';
                                } else {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="neighborhoodDisplay">' . $neighborhood . '</i></font>';
                                }
                            } else
                                echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="neighborhoodDisplay">' . $getSel['Neighborhood'] . '</i></font>';
                            ?>
                        </p>
                        <p> Konut Tipi:
                            <?php
                            if (isset($_POST['Update'])) {
                                if ($_POST['maxArea'] < $_POST['minArea'] || $_POST['maxPrice'] < $_POST['minPrice'] || $_POST['maxAge'] < $_POST['minAge']) {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="residentialTypeDisplay">' . $getSel['HouseType'] . '</i></font>';
                                } else {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="residentialTypeDisplay">' . $_POST['residentialTypeOption'] . '</i></font>';
                                }
                            } else
                                echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="residentialTypeDisplay">' . $getSel['HouseType'] . '</i></font>';
                            ?>
                        </p>
                        <p>Fiyat Aralığı (₺):
                            <?php
                            if (isset($_POST['Update'])) {
                                if ($_POST['maxArea'] < $_POST['minArea'] || $_POST['maxPrice'] < $_POST['minPrice'] || $_POST['maxAge'] < $_POST['minAge']) {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="minPriceDisplay">' . $getSel['MinPrice'] . '</i></font>';
                                } else {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="minPriceDisplay">' . $_POST['minPrice'] . '</i></font>';
                                }
                            } else
                                echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="minPriceDisplay">' . $getSel['MinPrice'] . '</i></font>';
                            ?>
                            <?php echo '-'; ?>
                            <?php
                            if (isset($_POST['Update'])) {
                                if ($_POST['maxArea'] < $_POST['minArea'] || $_POST['maxPrice'] < $_POST['minPrice'] || $_POST['maxAge'] < $_POST['minAge']) {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="maxPriceDisplay">' . $getSel['MaxPrice'] . '</i></font>';
                                } else {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="maxPriceDisplay">' . $_POST['maxPrice'] . '</i></font>';
                                }
                            } else
                                echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="maxPriceDisplay">' . $getSel['MaxPrice'] . '</i></font>';
                            ?>
                        </p>
                        <p>Metrekare Aralığı (m<sup>2</sup>):
                            <?php
                            if (isset($_POST['Update'])) {
                                if ($_POST['maxArea'] < $_POST['minArea'] || $_POST['maxPrice'] < $_POST['minPrice'] || $_POST['maxAge'] < $_POST['minAge']) {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="minSquareMetersDisplay">' . $getSel['MinArea'] . '</i></font>';
                                } else {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="minSquareMetersDisplay">' . $_POST['minArea'] . '</i></font>';
                                }
                            } else
                                echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="minSquareMetersDisplay">' . $getSel['MinArea'] . '</i></font>';
                            ?>
                            <?php echo '-'; ?>
                            <?php
                            if (isset($_POST['Update'])) {
                                if ($_POST['maxArea'] < $_POST['minArea'] || $_POST['maxPrice'] < $_POST['minPrice'] || $_POST['maxAge'] < $_POST['minAge']) {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="maxSquareMetersDisplay">' . $getSel['MaxArea'] . '</i></font>';
                                } else {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="maxSquareMetersDisplay">' . $_POST['maxArea'] . '</i></font>';
                                }
                            } else
                                echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="maxSquareMetersDisplay">' . $getSel['MaxArea'] . '</i></font>';
                            ?>
                        </p>
                        <p>Oda Sayısı:
                            <?php
                            if (isset($_POST['Update'])) {
                                if ($_POST['maxArea'] < $_POST['minArea'] || $_POST['maxPrice'] < $_POST['minPrice'] || $_POST['maxAge'] < $_POST['minAge']) {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="roomDisplay">' . $getSel['RoomNumber'] . '</i></font>';
                                } else {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="roomDisplay">' . $_POST['roomOption'] . '</i></font>';
                                }
                            } else
                                echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="roomDisplay">' . $getSel['RoomNumber'] . '</i></font>';
                            ?>
                        </p>
                        <p>Bina Yaş Aralığı (yıl):
                            <?php
                            if (isset($_POST['Update'])) {
                                if ($_POST['maxArea'] < $_POST['minArea'] || $_POST['maxPrice'] < $_POST['minPrice'] || $_POST['maxAge'] < $_POST['minAge']) {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="minAgeDisplay">' . $getSel['MinAge'] . '</i></font>';
                                } else {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="minAgeDisplay">' . $_POST['minAge'] . '</i></font>';
                                }
                            } else
                                echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="minAgeDisplay">' . $getSel['MinAge'] . '</i></font>'; ?>
                            <?php echo '-'; ?>
                            <?php
                            if (isset($_POST['Update'])) {
                                if ($_POST['maxArea'] < $_POST['minArea'] || $_POST['maxPrice'] < $_POST['minPrice'] || $_POST['maxAge'] < $_POST['minAge']) {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="maxAgeDisplay">' . $getSel['MaxAge'] . '</i></font>';
                                } else {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="maxAgeDisplay">' . $_POST['maxAge'] . '</i></font>';
                                }
                            } else
                                echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="maxAgeDisplay">' . $getSel['MaxAge'] . '</i></font>';
                            ?>
                        </p>
                        <p>Bulunduğu kat:
                            <?php
                            if (isset($_POST['Update'])) {
                                if ($_POST['floorOption'] != 17) {
                                    if ($_POST['maxArea'] < $_POST['minArea'] || $_POST['maxPrice'] < $_POST['minPrice'] || $_POST['maxAge'] < $_POST['minAge']) {
                                        echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="floorDisplay">' . $getSel['AdvFloor'] . '</i></font>';
                                    } else {
                                        echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="floorDisplay">' . $_POST['floorOption'] . '</i></font>';
                                    }
                                } else
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="floorDisplay">17 ve üzeri</i></font>';
                            } else {
                                if ($getSel['AdvFloor'] != 17) {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="floorDisplay">' . $getSel['AdvFloor'] . '</i></font>';
                                } else
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="floorDisplay">17 ve üzeri</i></font>';
                            }
                            ?>
                        </p>
                        <p>Isınma Sistemi:
                            <?php
                            if (isset($_POST['Update'])) {
                                if ($_POST['maxArea'] < $_POST['minArea'] || $_POST['maxPrice'] < $_POST['minPrice'] || $_POST['maxAge'] < $_POST['minAge']) {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="heatingDisplay">' . $getSel['HeatingSystem'] . '</i></font>';
                                } else {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="heatingDisplay">' . $_POST['heatingOption'] . '</i></font>';
                                }
                            } else
                                echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="heatingDisplay">' . $getSel['HeatingSystem'] . '</i></font>';
                            ?>
                        </p>
                        <p>Cephe:
                            <?php
                            if (isset($_POST['Update'])) {
                                if ($_POST['maxArea'] < $_POST['minArea'] || $_POST['maxPrice'] < $_POST['minPrice'] || $_POST['maxAge'] < $_POST['minAge']) {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="frontDisplay">' . $getSel['Facade'] . '</i></font>';
                                } else {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="frontDisplay">' . $_POST['frontOption'] . '</i></font>';
                                }
                            } else
                                echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="frontDisplay">' . $getSel['Facade'] . '</i></font>';
                            ?>
                        </p>
                        <p>Ek Özellikler:
                            <?php
                            if (isset($_POST['Update'])) {
                                if ($_POST['maxArea'] < $_POST['minArea'] || $_POST['maxPrice'] < $_POST['minPrice'] || $_POST['maxAge'] < $_POST['minAge']) {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="additionalDisplay">' . $getSel['AdditionalInfo'] . '</i></font>';
                                } else {
                                    echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="additionalDisplay">' . $_POST['additionalOption'] . '</i></font>';
                                }
                            } else
                                echo '<font size="4" style="color: rgb(42, 15, 163);"><i id="additionalDisplay">' . $getSel['AdditionalInfo'] . '</i></font>';
                            ?>
                        </p>

                    </div>
                </div>
            </div>
        </div>

    </main>
    <?php
    echo '<script>
   
        $(document).ready(function() {
            
            buttonUserType("' . $userTypeforButton . '");
        });
        </script>';
    ?>
    <script>
        $(document).ready(function() {
            $(".form-control").click(function() {
                document.getElementById('minMaxPrice').innerHTML = '';
                document.getElementById('minMaxSquareMeters').innerHTML = '';
                document.getElementById('minMaxAge').innerHTML = '';
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#countryOption').change(function() {
                $('#townOption').empty();
                $('#neighborhoodOption').empty();
                var province = $(this).val();
                $.post("DisplayTown.php", {
                    province: province
                }, function(a) {
                    $('#townOption').append(a);
                })
            });

            $('#townOption').change(function() {
                $('#neighborhoodOption').empty();
                var town = $(this).val();
                $.post("DisplayNeighborhood.php", {
                    town: town
                }, function(a) {
                    $('#neighborhoodOption').append(a);
                })
            });
        });
    </script>
</body>

</html>
<?php

$userId = $_COOKIE['user_id'];

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['Update'])) {

    echo '<script> console.log("YES")</script>';
    $advType = $_POST['rentOrSaleOption'];
    $province = $_POST['countryOption'];
    $minPrice = $_POST['minPrice'];
    $maxPrice = $_POST['maxPrice'];
    $town = $_POST['townOption'];
    $neighborhood = $_POST['neighborhoodOption'];
    $houseType = $_POST['residentialTypeOption'];
    $minArea = $_POST['minArea'];
    $maxArea = $_POST['maxArea'];
    $roomNum = $_POST['roomOption'];
    $advFloor = $_POST['floorOption'];
    $minAge = $_POST['minAge'];
    $maxAge = $_POST['maxAge'];
    $heatingSystem = $_POST['heatingOption'];
    $facade = $_POST['frontOption'];
    $additionalInfo = $_POST['additionalOption'];

    $findProvince = "SELECT * FROM Province WHERE province_key='$province'";
    $findName = mysqli_query($con, $findProvince);
    $getName = mysqli_fetch_array($findName);
    $province = $getName['province_title'];

    $findTown = "SELECT * FROM Town WHERE town_key='$town'";
    $findName = mysqli_query($con, $findTown);
    $getName = mysqli_fetch_array($findName);
    $town = $getName['town_title'];

    $findNeighborhood = "SELECT * FROM Neighborhood WHERE neighborhood_key='$neighborhood'";
    $findName = mysqli_query($con, $findNeighborhood);
    $getName = mysqli_fetch_array($findName);
    $neighborhood = $getName['neighborhood_title'];


    if ($minPrice > $maxPrice) {
        echo ' <script>document.getElementById("minMaxPrice").innerHTML = " Minimum fiyat maksimum fiyattan büyük olamaz.";</script>';
        echo '<script> console.log("KAYIT YOK")</script>';

        exit;
    } else if ($minArea > $maxArea) {
        echo ' <script>document.getElementById("minMaxSquareMeters").innerHTML = " Minimum metrekare maksimum metrekareden büyük olamaz.";</script>';
        echo '<script> console.log("KAYIT YOK")</script>';

        exit;
    } else if ($minAge > $maxAge) {
        echo ' <script>document.getElementById("minMaxAge").innerHTML = " Minimum bina yaşı maksimum bina yaşından büyük olamaz.";</script>';

        exit;
    } else {
        $updateSql = "UPDATE tbl_MyInterest SET AdvType='$advType', Province ='$province', minPrice='$minPrice', maxPrice='$maxPrice',
      Town='$town', Neighborhood='$neighborhood', HouseType='$houseType', MinArea='$minArea', MaxArea='$maxArea',
      RoomNumber='$roomNum', AdvFloor='$advFloor', MinAge='$minAge', MaxAge='$maxAge', HeatingSystem='$heatingSystem',
      Facade='$facade', AdditionalInfo='$additionalInfo'  WHERE UserID = $userId AND UserType=$userTypeforButton";

        $update = mysqli_query($con, $updateSql);
        if ($update) {
            echo '<script> console.log("KAYIT OLDU")</script>';
        }
    }
} else {
    echo '<script> console.log("NO")</script>';
}
?>