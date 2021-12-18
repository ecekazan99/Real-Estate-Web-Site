<?php
// This file is created for main page. It is first page of our project
echo '<script>
    if (localStorage.getItem("userTypeID") === null) {
        document.cookie = "currentPageForAdvertisements=MainPage";
        document.cookie="orderBy=Date";
        document.cookie="orderType=desc";
    } ;  
    </script>';
$cookiename = 'currentPageForAdvertisements';
$value = 'MainPage';
setcookie($cookiename, $value);
echo '<script>window.onload = function() {
        if(!window.location.hash) {
            window.location = window.location + "#loaded";
            window.location.reload();
        }
    }</script>';
require_once("SearchAndUpdate.php");
require_once("operation.php");
$con = mysqli_connect("localhost", "root", "", "dbhouse");
echo '<script>
        if (localStorage.getItem("userTypeID") === null) {
            document.cookie = "user_type=0";
            document.cookie = "user_id=0";
        } ;  
    </script>';

$userTypeforButton = $_COOKIE['user_type'];



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Main Page</title>
    <link rel="icon" type="image/png" href="../Images/favIcon.png" />
    <link rel="stylesheet" href="../Stylings/HouseCardStyling.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../Stylings/MainPageWithoutLogin.css">
    <link rel="stylesheet" type="text/css" href="..\Stylings\myInterests.css">
</head>

<body>
    <header>
        <div style="display: flex;flex-direction: column;float:right;">
            <div id="twobuttonDisplay" class="buttontwo" style="float:right;margin: 5px 50px;"></div>
            <div id="buttonDisplay" class="dropdown" style="float:right;margin: 5px 50px; "></div>
        </div>
        <br><br>
        <div style="display: flex;flex-direction: column">
            <img src="../Images/logo.png" alt="Logo" style="width: fit-content;height: fit-content;margin: auto" />
        </div>
    </header>

    <main style="display: flex;justify-content: center;align-items:center;flex-direction: column">

        <div style="display: flex;flex-direction: column;justify-content: center;width: 1000px">


            <div style="display: flex;flex-direction: row;width: 870px;border:1px solid rgb(226, 226, 226); height: 50px;align-items: center;justify-content: center">
                <form method="POST" action="" class="pure-form-search" id="myForm">
                    <div class="form-inline">
                        <label for="validationDefault01">Arama: </label>
                        <h6 style="margin:2px 2px"></h6>
                        <input id="searchBox" type="text" name="searchedWord" class="form-control mx-sm-6" pattern="[a-z0-9-üıöşçğ+ ]{2,20}" autocomplete="off" placeholder="Örnek: Daire" value="">
                        <h6 style="margin:2px 2px"></h6>
                        <button name="buttonSearch" type="submit" onsubmit="resetValue()" id="buttonSearch" class="btn btn-danger" style="padding: 5px 70px;">Ara</button>
                    </div>
                </form>
            </div>
            <div style="display: flex;flex:9;justify-content: center;align-items:center;text-align:center;margin-top:10px;width: 87%">
                <h7 style="flex:1;">Fiyat</h4>
                    <a href="#" id="price" type="button" class="btn btn-outline-secondary" style="flex:1;padding-top: 0px;" onclick="price_desc()">↓</a>
                    <a href="#" id="price" type="button" class="btn btn-outline-secondary" style="flex:1;padding-top: 0px;" onclick="price_asc()">↑</a>
                    <h7 style="flex:1;">İlan Tarihi</h4>
                        <a href="#" id="listingdate" type="button" class="btn btn-outline-secondary" style="flex:1;padding-top: 0px;" onclick="listingdate_desc()">↓</a>
                        <a href="#" id="listingdate" type="button" class="btn btn-outline-secondary" style="flex:1;padding-top: 0px;" onclick="listingdate_asc()()">↑</a>
                        <h7 style="flex:1;">Metrekare</h4>
                            <a href="#" id="squaremeters" type="button" class="btn btn-outline-secondary" style="flex:1;padding-top: 0px;" onclick="squaremeters_desc()">↓</a>
                            <a href="#" id="squaremeters" type="button" class="btn btn-outline-secondary" style="flex:1;padding-top: 0px;" onclick="squaremeters_asc()()">↑</a>
            </div>
            <div style="display:flex;flex-direction:row;">
                <div class="date mt-3 mb-1" id="dateDropdowns" style="width: 25%;">
                    <form class="pure-form-filter" action="" method="POST">
                        <h5 style="display: flex;justify-content: center;width: 90%;"> İLAN FİLTRELERİ</h5>
                        <div class="dropdown" style="width: 100%;padding-bottom:3px;">
                            <select style="width:90%;border:1px solid black;" class="btn btn-outline" style="max-height: 200px; width: 220px;" name="rentOrSaleOption" id="rentOrSaleOption" required>
                                <option class="dropdown-item" value="Satılık/Kiralık" style="display:none">Satılık/Kiralık</option>
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
                                <input type="text" style="border:1px solid black;" name="minPrice" id="minPrice" class="form-control btn-outline" placeholder="Min" pattern="\d*" title="Bu input'a sadece sayısal değer girilebilir" required>
                            </div>
                            <div class="col">
                                <input type="text" style="border:1px solid black;" name="maxPrice" id="maxPrice" class="form-control btn-outline" placeholder="Max" pattern="\d*" title="Bu input'a sadece sayısal değer girilebilir" required>
                            </div>
                        </div>
                        <font size="2">
                            <div id="minMaxPrice" style="width:90%; color:red;"></div>
                        </font>
                        <h6 style="margin:2px 2px"> Mertekare Aralığı</h6>

                        <div class="form-row" style="width: 94%;padding-bottom:3px;">
                            <div class="col ">
                                <input type="text" style="border:1px solid black;" name="minArea" id="minSquareMeters" class="form-control btn-outline" placeholder="Min" pattern="\d*" title="Bu input'a sadece sayısal değer girilebilir" required>
                            </div>
                            <div class="col">
                                <input type="text" style="border:1px solid black;" name="maxArea" id="maxSquareMeters" class="form-control btn-outline" placeholder="Max" pattern="\d*" title="Bu input'a sadece sayısal değer girilebilir" required>
                            </div>
                        </div>
                        <font size="2">
                            <div id="minMaxSquareMeters" style="width:90%; color:red;"></div>
                        </font>
                        <div class="dropdown" style="width: 100%;padding-bottom:3px;">
                            <select style="width: 90%;border:1px solid black;" class="btn btn-outline" style="max-height: 200px; width: 220px;" name="roomOption" id="roomOption" required>
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
                                <input type="text" name="minAge" style="border:1px solid black;" id="minAge" class="form-control btn-outline" placeholder="Min" pattern="\d*" title="Bu input'a sadece sayısal değer girilebilir" required>
                            </div>
                            <div class="col">
                                <input type="text" name="maxAge" style="border:1px solid black;" id="maxAge" class="form-control btn-outline" placeholder="Max" pattern="\d*" title="Bu input'a sadece sayısal değer girilebilir" required>
                            </div>
                        </div>
                        <font size="2">
                            <div id="minMaxAge" style="width:90%; color:red;"></div>
                        </font>

                        <div class="dropdown" style="width: 100%;padding-bottom:3px;">
                            <select style="width: 90%;border:1px solid black;" class="btn btn-outlineborder:1px solid black;" style="max-height: 200px; width: 220px;" name="floorOption" id="floorOption" required>
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
                            <button name="SearchButton" id="btn" type="submit" onclick="validationFilter()" class="btn btn-secondary" style="padding: 6px 33px">Ara</button>
                            <h6 style="margin:2px 2px"></h6>
                            <button onclick="window.location.reload();" class="btn btn-secondary" style="padding: 6px 33px">Temizle</button>
                        </div>
                    </form>
                </div>
                <div class="CardsContainerStyle">
                    <br><br>
                    <div class="DisplayAllilans" id="issuesList" style="border: 1px solid rgba(9,0,0,0.35)"></div>
                    <div>
                        <div class="pagenumbers" id="pagination"></div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once("DisplayAdvertisementsCard.php"); ?>
        <script>
            function resetValue() {
                document.getElementById('buttonSearch').value = "";
            }
            $(document).ready(function() {

                $(".form-control").click(function() {
                    document.getElementById('minMaxPrice').innerHTML = '';
                    document.getElementById('minMaxSquareMeters').innerHTML = '';
                    document.getElementById('minMaxAge').innerHTML = '';
                });
            });
        </script>
    </main>
    <?php
    echo '<script>
   
        $(document).ready(function() {
            
            buttonUserType("' . $userTypeforButton . '");
        });
        </script>'
    ?>

    <script>
        $(document).ready(function() {

            $('#countryOption').change(function() {
                $('#townOption').empty();
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