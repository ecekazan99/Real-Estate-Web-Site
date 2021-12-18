<?php

require_once("operation.php");

$userTypeforButton = $_COOKIE['user_type'];
$advertisementIDForDisplaying =  $_COOKIE['advertisementIDForDisplaying'];

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
$ads_Displayed_Count = $myarr['ads_displayed_count'];
$ads_Favoring_Count = $myarr['ads_favoriting_count'];


$queryForAdsImages = "SELECT * FROM tbl_advertisementimages WHERE advertisementID = $advertisementIDForDisplaying";
$adsImageResult = mysqli_query($GLOBALS['con'], $queryForAdsImages);
$countOfImages = mysqli_num_rows($adsImageResult);
$currImageIndex = true;
$photoExists = false;
if ($countOfImages > 0) {
    $photoExists = true;
} else {
    $photoExists = false;
}

?>


<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <title>Edit & Display My Active Advertisement</title>
    <link rel="icon" type="image/png" href="../Images/favIcon.png" />
    <link rel="stylesheet" href="../Stylings/HouseCardStyling.css">
    <link rel="stylesheet" href="AddAdvertisementPage.css">
    <link rel="stylesheet" href="../Stylings/myInterests.css">
    <link rel="stylesheet" href="../Stylings/HouseCardStyling.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
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
    <main style="display: flex;align-items: center;justify-content: center">


        <div style="display: flex;width: 60%;justify-content:center">
            <form method="post" action="operation.php" id="ilan" enctype="multipart/form-data">
                <div id="addIcon"><label for="files"><i class="fa fa-plus-circle" style="display:flex;flex:1;font-size:35px;margin:15px;float:right;cursor:pointer" aria-hidden="true"> <input type="file" name="files[]" id="files" style="display: none;" form="ilan" multiple accept=".jpg,.jpeg,.png" /></i>
                </div>
                <div style="display: flex;flex:16;justify-content: space-between;flex-direction: column">
                    <div style="display:flex;flex:6;justify-content:center;align-items: center; flex-direction:column;">

                        <div id="carouselExampleControls" style="width:600px" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" id="come" style="width:100%">

                                <?php


                                if ($countOfImages > 0) {
                                    $photoExists = true;
                                    while ($row = $adsImageResult->fetch_assoc()) {
                                        $imageURL = 'Advertisement_Images/' . $row["file_name"];
                                ?>

                                        <?php if ($currImageIndex) { ?>
                                            <div class="carousel-item active"> <img style="width:600px;height:300px" src="<?php echo $imageURL; ?>" alt="" /></div>
                                        <?php } else { ?>
                                            <div class="carousel-item"> <img style="width:600px;height:300px" src="<?php echo $imageURL; ?>" alt="" /></div>
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
                    </div>


                    <div style="display: flex;flex: 10;justify-content:flex-start;flex-direction: row;align-items: flex-start;width: 100%;margin-top: 5px">
                        <div style="display: flex; flex :7;flex-direction: column;background-color: rgba(232,232,232,0.77)  ; box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.3)
                ;border: 1px solid rgba(104,102,102,0.24);padding:20px">
                            <div style="display: flex;justify-content:space-between;flex-direction: row">

                                <select name="advType" id="advType" form="ilan" required>
                                    <option <?php if ($ads_Type == 'Kiralık') {
                                                echo "selected";
                                            }; ?>>Kiralık</option>
                                    <option <?php if ($ads_Type == 'Satılık') {
                                                echo "selected";
                                            }; ?>>Satılık</option>
                                </select>

                                <div class="input-group form-item" style="display: flex;justify-content: flex-end">
                                    <?php echo '<input name="price" style="width: 150px" type="number" id="price" autocomplete="off" value="' . $ads_Price . '" required>'; ?>

                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="fas fa-lira-sign"></i></span>
                                    </div>
                                </div>


                            </div>

                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                <?php echo '<textarea name="description" type="text" id="description" rows="2" cols="30" autocomplete="off" required value="' . $ads_Description . '"> ' . $ads_Description . '</textarea>'; ?>
                                <label for="description">İlan Açıklaması</label>
                            </div>
                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">

                                <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                    <select name="province" id="province" form="ilan" required>
                                        <?php
                                        $sql = "SELECT * FROM Province ORDER BY province_title";
                                        $result = mysqli_query($con, $sql);
                                        while ($province = mysqli_fetch_array($result)) {
                                            if ($ads_Province === $province['province_title']) {
                                                echo ' <option value="' . $province['province_key'] . '"selected>' . $province['province_title'] . '</option>';
                                            } else {
                                                echo ' <option value="' . $province['province_key'] . '">' . $province['province_title'] . '</option>';
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>

                                <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                    <select name="town" id="town" form="ilan" required>

                                        <option class="dropdown-item" value="" style="display:none">İl</option>
                                    </select>
                                </div>

                                <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                    <select name="neighborhood" id="neighborhood" form="ilan" required>
                                        <option class="dropdown-item" value="" style="display:none">Mahalle</option>

                                    </select>
                                </div>
                                <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                    <select name="structureType" id="structureType" form="ilan">
                                        <option <?php if ($ads_Housetype == 'Daire') {
                                                    echo "selected";
                                                }; ?>> Daire</option>
                                        <option <?php if ($ads_Housetype == 'Villa') {
                                                    echo "selected";
                                                }; ?>> Villa</option>
                                        <option <?php if ($ads_Housetype == 'Müstakil Ev') {
                                                    echo "selected";
                                                }; ?>>Müstakil Ev</option>
                                        <option <?php if ($ads_Housetype == 'Residence') {
                                                    echo "selected";
                                                }; ?>> Residence</option>
                                        <option <?php if ($ads_Housetype == 'Yazlık') {
                                                    echo "selected";
                                                }; ?>> Yazlık</option>
                                    </select>
                                </div>

                            </div>

                            <div style="display: flex; flex:10;flex-direction: row">
                                <div class="form-item" style="display: flex;flex: 9"> <?php echo '<textarea name="address" id="addressInfo" value="' . $ads_Address . '" rows="3" placeholder="" cols="50" autocomplete="off" required>' . $ads_Address . '</textarea>'; ?>
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

                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                <div>
                                    <?php echo '<input name="area" type="number" value="' . $ads_Area . '" id="area" autocomplete="off" required>'; ?>
                                    <label for="area">Metrekare</label>
                                </div>
                                <div id="element12" class="ml-2 mt-2" style="color:#bd2130"></div>
                            </div>

                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                    <select name="numOfRooms" id="numOfRooms" form="ilan" required>

                                        <option <?php if ($ads_Roomnumber == '1+1') {
                                                    echo "selected";
                                                }; ?>>1+1</option>
                                        <option <?php if ($ads_Roomnumber == '2+1') {
                                                    echo "selected";
                                                }; ?>>2+1</option>
                                        <option <?php if ($ads_Roomnumber == '3+1') {
                                                    echo "selected";
                                                }; ?>>3+1</option>
                                        <option <?php if ($ads_Roomnumber == '4+1') {
                                                    echo "selected";
                                                }; ?>>4+1</option>
                                        <option <?php if ($ads_Roomnumber == '5+1') {
                                                    echo "selected";
                                                }; ?>>5+1</option>
                                        <option <?php if ($ads_Roomnumber == '6+1') {
                                                    echo "selected";
                                                }; ?>>6+1</option>
                                    </select>
                                </div>
                                <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                    <select name="heating" id="heating" form="ilan" required>

                                        <option <?php if ($ads_Heatingsystem == 'Doğalgaz') {
                                                    echo "selected";
                                                }; ?>>Doğalgaz</option>
                                        <option <?php if ($ads_Heatingsystem == 'Merkezi Sistem') {
                                                    echo "selected";
                                                }; ?>>Merkezi Sistem</option>
                                        <option <?php if ($ads_Heatingsystem == 'Soba') {
                                                    echo "selected";
                                                }; ?>>Soba</option>
                                        <option <?php if ($ads_Heatingsystem == 'Isınma Yok') {
                                                    echo "selected";
                                                }; ?>>Isınma Yok</option>
                                    </select>
                                </div>
                                <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                    <select name="facade" id="facade" form="ilan" required>

                                        <option <?php if ($ads_Facade == 'Kuzey') {
                                                    echo "selected";
                                                }; ?>>Kuzey</option>
                                        <option <?php if ($ads_Facade == 'Doğu') {
                                                    echo "selected";
                                                }; ?>>Doğu</option>
                                        <option <?php if ($ads_Facade == 'Batı') {
                                                    echo "selected";
                                                }; ?>>Batı</option>
                                        <option <?php if ($ads_Facade == 'Güney') {
                                                    echo "selected";
                                                }; ?>>Güney</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                <div>
                                    <?php echo '<input name="floor" type="number" id="floor" autocomplete="off" value="' . $ads_Floor . '" required>'; ?>
                                    <label for="floor">Bulunduğu Kat</label>
                                </div>
                                <div id="element13" class="ml-2 mt-2" style="color:#bd2130"></div>
                            </div>
                            <div class="form-item" style="display:flex;justify-content:flex-start;flex-direction:row;">
                                <div>
                                    <?php echo '<input name="age" type="number" id="age" autocomplete="off" value="' . $ads_Age . '" required>' ?>
                                    <label for="age">Bina Yaşı</label>
                                </div>
                                <div id="element14" class="ml-2 mt-2" style="color:#bd2130"></div>
                            </div>
                            <div class="additionPart" id="parentOfAdditions" form="ilan">
                                <p>Ek Özellikler</p>
                                <input type="hidden" id="addition1" form="ilan" name="addition1" value="0">
                                <input type="checkbox" id="addition1" form="ilan" name="addition1" value="1" <?php if ($ads_Otopark) echo 'checked="checked"'; ?>>
                                <label for="addition1">Otopark</label>

                                <input type="hidden" id="addition2" form="ilan" name="addition2" value="0">
                                <input type="checkbox" id="addition2" form="ilan" name="addition2" value="1" <?php if ($ads_Pool) echo 'checked="checked"'; ?>>
                                <label for="addition2">Havuz</label><br>

                                <input type="hidden" id="addition3" form="ilan" name="addition3" value="0">
                                <input type="checkbox" id="addition3" form="ilan" name="addition3" value="1" <?php if ($ads_Security) echo 'checked="checked"'; ?>>
                                <label for="addition3">Güvenlik</label>

                                <input type="hidden" id="addition4" form="ilan" name="addition4" value="0">
                                <input type="checkbox" id="addition4" form="ilan" name="addition4" value="1" <?php if ($ads_Kidsplaygarden) echo 'checked="checked"'; ?>>
                                <label for="addition4">Çocuk Oyun Parkı</label><br>
                            </div>

                            <div class="form-item" style="display:flex;justify-content:space-between;margin-top:15px;">
                                <button class="btn btn-success" type="submit" name="UpdateTheAdvertisement" style="margin-right: 20px">İlanı Güncelle</button>
                                <button class="btn btn-danger" type="submit" name="deleteMyAdvertisement" style="margin-left:20px">İlanı Sil</button>
                                <div>
                                    <div>
                                        <div class="form-item" style="display:flex;justify-content:center;flex-direction:row;">
                                            <h7 style="font-style: italic;float: right" id="dateInfo"><?php echo $ads_Date ?></h7>
                                        </div>
                                    </div>
                                    <div style="display: flex;justify-content: center;flex-direction: row">


                                    </div>

                                </div>

                            </div>
                        </div>
                        <div style="display: flex;flex:3;flex-direction: column;width:100%;float:right;justify-content: flex-start;margin-top: 0;margin-left: 10px;
                    align-items: center;text-align: center;background-color: rgba(232,232,232,0.77)  ;padding: 20px;height:200px;
                    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.3);border: 1px solid rgba(104,102,102,0.24);">
                            <div>
                                <h4 style="font-weight: bold">İlan Etkileşim Bilgileri</h4>
                            </div>
                            <div>
                                <h7 style="display: flex">Görüntülenme Sayısı : <span id="viewCount"> <?php echo $ads_Displayed_Count ?></span></h7>
                            </div>
                            <div>
                                <h7>Beğenilme Sayısı: <span id="likeCount"> <?php echo $ads_Favoring_Count ?></span></h7>
                            </div>
                        </div>
            </form>
            <div>
                <div style="display:flex;flex-direction:row;justify-content:flex-start;padding:10px">
                    <button type="button" id="deleteCurrentImage" style="border:0px">
                        <i class="fa fa-trash" style="font-size: 35px;" aria-hidden="true"></i>
                    </button>
                </div>
                <script>
                    $(document).ready(function() {
                        <?php
                        $sql = "SELECT * FROM Province WHERE province_title='$ads_Province'";
                        $query = mysqli_query($con, $sql);
                        $list = mysqli_fetch_array($query);
                        ?>
                        var province = "<?php echo $list['province_key']; ?>";
                        $.post("DisplayTown.php", {
                            province: province
                        }, function(a) {
                            $('#town').append(a);
                        })

                        <?php
                        $sql = "SELECT * FROM Town WHERE town_title='$ads_Town'";
                        $query = mysqli_query($con, $sql);
                        $list = mysqli_fetch_array($query);
                        ?>

                        var town = "<?php echo $list['town_key']; ?>";
                        $.post("DisplayNeighborhood.php", {
                            town: town
                        }, function(a) {
                            $('#neighborhood').append(a);
                        })

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
                    function setCookie(cname, cvalue) {
                        document.cookie = cname + "=" + cvalue;
                    }

                    function logOut() {
                        localStorage.clear();
                        setCookie('user_type', '0');
                    }
                </script>

                <script>
                    /*
                    let allImagesToAdd=[];
                    let iamgesThatWillBeRemovedFromDb=[];
                    let currentImageSrc= $('.active').find('img').attr('src');

                    $(document).ready(function() {
                    $('#carouselExampleControls').on('slid.bs.carousel', function () {  
                        var src = $('.active').find('img').attr('src');
                            currentImageSrc=src;
                            
                        });  
                    });
                          
                     */
                    var $carousel = $('#come');
                    document.getElementById("deleteCurrentImage").addEventListener("click", function(event) {
                        //event.preventDefault();
                        //document.getElementById("addIcon").innerHTML = '<label for="files"><i class="fa fa-plus-circle"  style="display:flex;flex:1;font-size:35px;margin:15px;float:right;cursor:pointer" aria-hidden="true"><input type="file" name="files[]" id="files" style="display: none;" multiple accept=".jpg,.jpeg,.png" /></i></label>';

                        //document.getElementById("come").innerHTML='';

                        //event.preventDefault();
                        //currentIndex = $('div.active').index();
                        var ActiveElement = $carousel.find('.carousel-item.active');
                        ActiveElement.remove();
                        var NextElement = $carousel.find('.carousel-item');
                        NextElement.remove();

                        /*  
                        var NextElement = $carousel.find('.carousel-item').first();
                        NextElement.addClass('active');*/
                    });
                    document.getElementById("files").addEventListener("change", function(e) {

                        var ActiveElement = $carousel.find('.carousel-item.active');
                        ActiveElement.remove();
                        var NextElement = $carousel.find('.carousel-item');
                        NextElement.remove();
                        let tempAddImages = [];
                        var myFile = $('#files').prop('files');

                        for (let i = 0; i < myFile.length; i++) {
                            tempAddImages.push(myFile[i]);

                        }
                        for (let j = 0; j < tempAddImages.length; j++) {
                            DOM_a = document.getElementById("come");
                            let item_element = document.createElement('div');
                            item_element.style.cssText = "width:600px;height:300px";
                            if (j == 0) {
                                item_element.className = "carousel-item active";
                            } else {
                                item_element.className = "carousel-item";
                            }
                            item_element.innerHTML = '<img style="width:600px;height:300px" src="' + URL.createObjectURL(tempAddImages[j]) + '" alt="" />';
                            DOM_a.appendChild(item_element);
                        }
                    });

                    /*
                    document.getElementById("deleteCurrentImage").addEventListener("click", function(event) {
                            event.preventDefault();
                            console.log(currentImageSrc+"Silinecek");
                            let flag=true;
                            for(let i =0; i < allImagesToAdd.length;i++){
                                    console.log("---------O--------");
                                    console.log(allImagesToAdd[i].name + " / \n");
                                    console.log(currentImageSrc);
                                    console.log("---------O--------");


                                if(allImagesToAdd[i].name == "Advertisement_Images/"+currentImageSrc){
                                    allImagesToAdd[i].name="silinmiş";
                                    flag=false;
                                }
                            }
                            if(flag){
                                iamgesThatWillBeRemovedFromDb.push(currentImageSrc);
                            }

                            $('.active').find('img').remove();
                         
                        // document.getElementById("demo").innerHTML = "Hello World";
                    });*/
                </script>


    </main>
</body>

</html>