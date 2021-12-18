<?php
// This file is for creating a new advertisement 
require_once("operation.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Advertisements</title>
    <link rel="icon" type="image/png" href="../Images/favIcon.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="../Stylings/HouseCardStyling.css">
    <link rel="stylesheet" href="AddAdvertisementPage.css">
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
            <a href="MainPage.php"> <img src="../Images/logo.png" alt="Logo" style="max-width:100%; height:auto;display: block;margin-left: auto;margin-right: auto;" /></a>
        </div>

    </header>
    <main style="display: flex;flex-direction: row;justify-content: center">
        <div style="width: 60%">

            <div id="buttonGroup" style="display: flex;flex-direction: row;flex: 6" onload="displayButtonGroup()" onclick="displayButtonGroup()">
                <button type="button" class="btn active btn-outline-secondary" style="display: flex;flex: 2">İlan Ekle</button>
                <a class="btn btn-outline-secondary" style="display: flex;flex: 2" href="MyActiveAdvertisementsPage.php">Aktif İlanlarım</a>
                <a class="btn btn-outline-secondary" style="display: flex;flex: 2" href="MyDeletedAdvertisementsPage.php">Geçmiş İlanlarım</a>
            </div>
            <div>
            <!-- We created form for taking advertisement's properties -->
                <form action="operation.php" method="POST" id="ilan" enctype="multipart/form-data">

                    <div style="display:flex;justify-content:center;align-items: center; flex-direction:column;">
                        <label for="files"><img src="../Images/addPhoto.png" width="50px" height="50px" style="cursor: pointer;"></label>
                        <input type="file" name="files[]" id="files" style="display: none;" multiple accept=".jpg,.jpeg,.png" />
                        <div>
                            <div class="wrapper" style="display:flex;justify-content: flex-start; flex-direction:row;">
                                <div id="result" class="text-center"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3" style="display:flex;justify-content:flex-start;flex-direction:row;width:100%;">

                        <div class="ml-3" style="display:flex;justify-content:flex-start;flex-direction:column;width:50%;">
                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                <div>
                                    <input name="price" type="number" id="price" autocomplete="off" value="" required>
                                    <label for="price">Fiyat</label>
                                </div>
                                <div id="element9" class="ml-2 mt-2" style="color:#bd2130"></div>
                            </div>
                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                              
                                <select name="advType" id="advType" form="ilan" style="border: solid 1px #ccc; height:40px;padding: 0 7px;font-size: 15px;font-weight: bold;" required>
                                    <option value="" disabled selected>İlan Tipi</option>
                                    <option value="Satılık">Satılık</option>
                                    <option value="Kiralık">Kiralık</option>
                                </select>

                            </div>
                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                <div>
                                    <textarea name="description" type="text" id="description" rows="2" cols="30" autocomplete="off" required value=""></textarea>
                                    <label for="description">İlan Açıklaması</label>
                                </div>
                                <div id="element10" class="ml-2 mt-2" style="color:#bd2130"></div>
                            </div>
                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                

                                <select name="province" id="province" form="ilan" style="border: solid 1px #ccc; height:40px;padding: 0 7px;font-size: 15px;font-weight: bold;" required>
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
                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">


                                <select name="town" id="town" form="ilan" style="border: solid 1px #ccc; height:40px;padding: 0 7px;font-size: 15px;font-weight: bold;" required>
                                    <option class="dropdown-item" value="" style="display:none">İlçe</option>
                                </select>


                            </div>
                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">


                                <select name="neighborhood" id="neighborhood" form="ilan" style="border: solid 1px #ccc; height:40px;padding: 0 7px;font-size: 15px;font-weight: bold;" required>
                                    <option value="" disabled selected>Mahalle/Semt</option>

                                    <option class="dropdown-item" value="" style="display:none">Mahalle</option>

                                </select>

                            </div>
                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                <div>
                                    <textarea name="address" type="text" id="address" rows="3" cols="30" autocomplete="off" required value=""></textarea>
                                    <label for="address">Adres</label>
                                </div>
                                <div id="element11" class="ml-2 mt-2" style="color:#bd2130"></div>
                            </div>
                        </div>
                        <div class="ml-3" style="display:flex;justify-content:flex-start;flex-direction:column;width:50%;">
                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">

                                <select name="structureType" id="structureType" style="border: solid 1px #ccc; height:40px;padding: 0 7px;font-size: 15px;font-weight: bold;" form="ilan" required>
                                    <option class="dropdown-item" value="" style="display:none">Konut Tipi</option>
                                    <option class="dropdown-item" value="Daire">Daire</option>
                                    <option class="dropdown-item" value="Villa">Villa</option>
                                    <option class="dropdown-item" value="Müstakil Ev">Müstakil Ev</option>
                                    <option class="dropdown-item" value="Residence">Residence</option>
                                    <option class="dropdown-item" value="Yazlık">Yazlık</option>

                                </select>

                            </div>
                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                <div>
                                    <input name="area" type="number" id="area" autocomplete="off" value="" required>
                                    <label for="area">Metrekare</label>
                                </div>
                                <div id="element12" class="ml-2 mt-2" style="color:#bd2130"></div>
                            </div>
                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">



                                <select name="numOfRooms" id="numOfRooms" form="ilan" style="border: solid 1px #ccc; height:40px;padding: 0 7px;font-size: 15px;font-weight: bold;" required>
                                    <option class="dropdown-item" value="" style="display:none">Oda Sayısı</option>
                                    <option class="dropdown-item" value="1+1">1+1</option>
                                    <option class="dropdown-item" value="2+1">2+1</option>
                                    <option class="dropdown-item" value="3+1">3+1</option>
                                    <option class="dropdown-item" value="4+1">4+1</option>
                                    <option class="dropdown-item" value="5+1">5+1</option>
                                    <option class="dropdown-item" value="6+1">6+1</option>

                                </select>
                            </div>
                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                <div>
                                    <input name="floor" type="number" id="floor" autocomplete="off" value="" required>
                                    <label for="floor">Bulunduğu Kat</label>
                                </div>
                                <div id="element13" class="ml-2 mt-2" style="color:#bd2130"></div>
                            </div>
                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                <div>
                                    <input name="age" type="number" id="age" autocomplete="off" value="" required>
                                    <label for="age">Bina Yaşı</label>
                                </div>
                                <div id="element14" class="ml-2 mt-2" style="color:#bd2130"></div>
                            </div>
                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">


                                <select name="heating" id="heating" form="ilan" style="border: solid 1px #ccc; height:40px;padding: 0 7px;font-size: 15px;font-weight: bold;" required>
                                    <option class="dropdown-item" value="" style="display:none">Isınma Sistemi</option>
                                    <option class="dropdown-item" value="Doğalgaz">Doğalgaz</option>
                                    <option class="dropdown-item" value="Merkezi">Merkezi</option>
                                    <option class="dropdown-item" value="Soba">Soba</option>
                                    <option class="dropdown-item" value="Isınma Yok">Isınma Yok</option>
                                </select>
                            </div>
                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                               
                                <select name="facade" id="facade" form="ilan" style="border: solid 1px #ccc; height:40px;padding: 0 7px;font-size: 15px;font-weight: bold;" required>
                                    <option value="" disabled selected>Cephe</option>
                                    <option value="Kuzey">Kuzey</option>
                                    <option value="Doğu">Doğu</option>
                                    <option value="Batı">Batı</option>
                                    <option value="Güney">Güney</option>
                                </select>

                            </div>

                            <div class="additionPart" id="parentOfAdditions">
                                <p>Ek Özellikler</p>
                                <input type="hidden" id="addition1" name="addition1" value="0">
                                <input type="checkbox" id="addition1" name="addition1" value="1">
                                <label for="addition1">Otopark</label>

                                <input type="hidden" id="addition2" name="addition2" value="0">
                                <input type="checkbox" id="addition2" name="addition2" value="1">
                                <label for="addition2">Havuz</label><br>

                                <input type="hidden" id="addition3" name="addition3" value="0">
                                <input type="checkbox" id="addition3" name="addition3" value="1">
                                <label for="addition3">Güvenlik</label>

                                <input type="hidden" id="addition4" name="addition4" value="0">
                                <input type="checkbox" id="addition4" name="addition4" value="1">
                                <label for="addition4">Çocuk Oyun Parkı</label><br>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="mt-3" style="display:flex;justify-content:center;align-items:center;flex-direction:column">
                <button type="submit" name="submitForNewAdvertisement" class="btn" style="background-color: #bd2130;color:white" value="Upload" onclick="myValidation()">İlanı Ekle</button>
            </div>
            </form>
        </div>

        </div>
        <!--Here we includes some js files for stylings and functions-->
        <script type="text/Javascript" src="AddAdvertisement.js"></script>
        <script src="DynamicDisplayForMyAdvertisements.js"></script>
        <script src="AddMultipleImages.js"></script>
        <script>
            $(document).ready(function() {

                $('#province').change(function() {
                    $('#town').empty();
                    $('#neighborhood').empty();
                    var province = $(this).val();
                    $.post("DisplayTown.php", {
                        province: province
                    }, function(a) {
                        $('#town').append(a);
                    })
                });

                $('#town').change(function() {
                    $('#neighborhood').empty();
                    var town = $(this).val();
                    $.post("DisplayNeighborhood.php", {
                        town: town
                    }, function(a) {
                        $('#neighborhood').append(a);
                    })
                });
            });
        </script>
        <script>
            function AddNewAdvertisement() {
                let priceInfoToAdd = document.getElementById("price").value;
                let saleOrRentInfoToAdd = document.getElementById("advType").textContent;
                let descriptionInfoToAdd = document.getElementById("description").value;
                let provinceInfoToAdd = document.getElementById("province").textContent;
                let townInfoToAdd = document.getElementById("town").textContent;
                let neighborhoodInfoToAdd = document.getElementById("neighborhood").textContent;
                let addressInfoToAdd = document.getElementById("address").value;
                let structureInfoToAdd = document.getElementById("structureType").textContent;
                let areaInfoToAdd = document.getElementById("area").value;
                let numberOfRoomsInfoToAdd = document.getElementById("numOfRooms").textContent;
                let floorInfoToAdd = document.getElementById("floor").value;
                let ageInfoToAdd = document.getElementById("age").value;
                let heatingSystemInfoToAdd = document.getElementById("heating").textContent;
                let facadeInfoToAdd = document.getElementById("facade").textContent;
                let additionalInfoToAdd = [];
                let elems = document.querySelectorAll("#parentOfAdditions > [value]")
                Array.from(elems).forEach(function(el) {
                    if (el.checked) {
                        additionalInfoToAdd.push(el.value);
                    }

                })
                let sendPackageAsJSON = {
                    priceToAdd: priceInfoToAdd,
                    saleOrRentToAdd: saleOrRentInfoToAdd,
                    descriptionToAdd: descriptionInfoToAdd,
                    provinceToAdd: provinceInfoToAdd,
                    townToAdd: townInfoToAdd,
                    neighborhoodToAdd: neighborhoodInfoToAdd,
                    addressToAdd: addressInfoToAdd,
                    structureToAdd: structureInfoToAdd,
                    areaToAdd: areaInfoToAdd,
                    numberOfRoomsToAdd: numberOfRoomsInfoToAdd,
                    floorToAdd: floorInfoToAdd,
                    ageToAdd: ageInfoToAdd,
                    heatingSystemToAdd: heatingSystemInfoToAdd,
                    facadeToAdd: facadeInfoToAdd,
                    additionalToAdd: additionalInfoToAdd
                }

            }

            function myValidation() {
                var elem = document.getElementById('advType');
                var txt = elem.textContent || elem.innerText;
                var elem2 = document.getElementById('province');
                var txt2 = elem2.textContent || elem2.innerText;
                var elem3 = document.getElementById('town');
                var txt3 = elem3.textContent || elem3.innerText;
                var elem4 = document.getElementById('neighborhood');
                var txt4 = elem4.textContent || elem4.innerText;
                var elem5 = document.getElementById('structureType');
                var txt5 = elem5.textContent || elem5.innerText;
                var elem6 = document.getElementById('numOfRooms');
                var txt6 = elem6.textContent || elem6.innerText;
                var elem7 = document.getElementById('heating');
                var txt7 = elem7.textContent || elem7.innerText;
                var elem8 = document.getElementById('facade');
                var txt8 = elem8.textContent || elem8.innerText;
                var elem9 = document.getElementById('price');
                var txt9 = elem9.value;
                var elem10 = document.getElementById('description');
                var txt10 = elem10.value;
                var elem11 = document.getElementById('address');
                var txt11 = elem11.value;
                var elem12 = document.getElementById('area');
                var txt12 = elem12.value;
                var elem13 = document.getElementById('floor');
                var txt13 = elem13.value;
                var elem14 = document.getElementById('age');
                var txt14 = elem14.value;
                if (txt9 === "") {
                    document.getElementById('element9').innerHTML = "Lütfen doldurunuz.";
                    setTimeout(function() {
                        $('#element9').html('');
                    }, 3000);
                    return false;
                }
                if (txt === "İlan Tipi") {
                    document.getElementById('element').innerHTML = "Lütfen seçiniz.";
                    setTimeout(function() {
                        $('#element').html('');
                    }, 3000);
                    return false;
                }
                if (txt10 === "") {
                    document.getElementById('element10').innerHTML = "Lütfen doldurunuz.";
                    setTimeout(function() {
                        $('#element10').html('');
                    }, 3000);
                    return false;
                }
                if (txt2 === "İl") {
                    document.getElementById('element2').innerHTML = "Lütfen seçiniz.";
                    setTimeout(function() {
                        $('#element2').html('');
                    }, 3000);
                    return false;
                }
                if (txt3 === "İlçe") {
                    document.getElementById('element3').innerHTML = "Lütfen seçiniz.";
                    setTimeout(function() {
                        $('#element3').html('');
                    }, 3000);
                    return false;
                }
                if (txt4 === "Mahalle/Semt") {
                    document.getElementById('element4').innerHTML = "Lütfen seçiniz.";
                    setTimeout(function() {
                        $('#element4').html('');
                    }, 3000);
                    return false;
                }
                if (txt11 === "") {
                    document.getElementById('element11').innerHTML = "Lütfen doldurunuz.";
                    setTimeout(function() {
                        $('#element11').html('');
                    }, 3000);
                    return false;
                }
                if (txt5 === "Konut Tipi") {
                    document.getElementById('element5').innerHTML = "Lütfen seçiniz.";
                    setTimeout(function() {
                        $('#element5').html('');
                    }, 3000);
                    return false;
                }
                if (txt12 === "") {
                    document.getElementById('element12').innerHTML = "Lütfen doldurunuz.";
                    setTimeout(function() {
                        $('#element12').html('');
                    }, 3000);
                    return false;
                }
                if (txt6 === "Oda Sayısı") {
                    document.getElementById('element6').innerHTML = "Lütfen seçiniz.";
                    setTimeout(function() {
                        $('#element6').html('');
                    }, 3000);
                    return false;
                }
                if (txt13 === "") {
                    document.getElementById('element13').innerHTML = "Lütfen doldurunuz.";
                    setTimeout(function() {
                        $('#element13').html('');
                    }, 3000);
                    return false;
                }
                if (txt14 === "") {
                    document.getElementById('element14').innerHTML = "Lütfen doldurunuz.";
                    setTimeout(function() {
                        $('#element14').html('');
                    }, 3000);
                    return false;
                }
                if (txt7 === "Isınma Sistemi") {
                    document.getElementById('element7').innerHTML = "Lütfen seçiniz.";
                    setTimeout(function() {
                        $('#element7').html('');
                    }, 3000);
                    return false;
                }
                if (txt8 === "Cephe") {
                    document.getElementById('element8').innerHTML = "Lütfen seçiniz.";
                    setTimeout(function() {
                        $('#element8').html('');
                    }, 3000);
                    return false;
                }
                if (txt !== "İlan Tipi" && txt2 !== "İl" && txt3 !== "İlçe" && txt4 !== "Mahalle/Semt" &&
                    txt5 !== "Konut Tipi" && txt6 !== "Oda Sayısı" && txt7 !== "Isınma Sistemi" && txt8 !== "Cephe" && txt9 !== "" &&
                    txt10 !== "" && txt11 !== "" && txt12 !== "" && txt13 !== "" && txt14 !== "") {

                    AddNewAdvertisement();
                    return true;
                } else {


                    return false;
                }
            }
        </script>
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