<?php
// This file is created for operations in main page etc.
$con = mysqli_connect("localhost", "root", "", "dbhouse");
require_once("db.php");

?>
<script>
  function price_desc() {
    document.cookie = "orderBy=Price";
    document.cookie = "orderType=desc";
    window.location.reload();
  }

  function price_asc() {
    document.cookie = "orderBy=Price";
    document.cookie = "orderType=asc";
    window.location.reload();
  }

  function listingdate_desc() {
    document.cookie = "orderBy=Date";
    document.cookie = "orderType=desc";
    window.location.reload();
  }

  function listingdate_asc() {
    document.cookie = "orderBy=Date";
    document.cookie = "orderType=asc";
    window.location.reload();
  }

  function squaremeters_desc() {
    document.cookie = "orderBy=Area";
    document.cookie = "orderType=desc";
    window.location.reload();
  }

  function squaremeters_asc() {
    document.cookie = "orderBy=Area";
    document.cookie = "orderType=asc";
    window.location.reload();
  }

  function setCookie(cname, cvalue) {
    document.cookie = cname + "=" + cvalue;
  }

  function logOut() {
    localStorage.clear();
    setCookie('user_type', '0');
  }

  function buttonUserType(userType) {
    if (userType == 1) {
      document.getElementById('buttonDisplay').innerHTML = '<button class="btn btn-primary">Hesabım</button><div class="dropdown-content"><a href="IndividualUserProfilePage.php">Bilgilerim</a><a href="DisplayMyFavoriteAdvertisements.php">Favorilerim</a><a href="MyInterests.php" >İlgilendiğim İlanlar</a><a onclick="logOut()" href="MainPage.php">Çıkış yap</a> </div> ';

    } else if (userType == 2) {
      document.getElementById('buttonDisplay').innerHTML = '<button class="btn btn-danger">Hesabım</button><div class="dropdown-content"><a href="OfficialUserProfilePage.php">Bilgilerim</a><a href="MyActiveAdvertisementsPage.php">İlanlarım</a><a href="DisplayMyFavoriteAdvertisements.php">Favorilerim</a><a href="MyInterests.php" >İlgilendiğim İlanlar</a><a onclick="logOut()" href="MainPage.php">Çıkış yap</a></div>';
    } else {
      document.getElementById('twobuttonDisplay').innerHTML = '<a href="IndividualUserLoginPage.php" style="color:white;text-decoration: none"> <button id="individualuser" type="button" class="btn btn-success" > Bireysel Giriş</button></a><h6 style="margin:2px 2px"></h6><a href="OfficialUserLoginPage.php" style="color:white;text-decoration: none" ><button id="corporateuser" type="button" class="btn btn-danger" > Kurumsal Giriş</button></a><br/>';
    }
  }

  function validationFilter() {
    var count = 0;
    var rentOrSaleOption = document.getElementById('rentOrSaleOption');
    var rentOrSale = rentOrSaleOption.textContent || rentOrSaleOption.innerText;
    if (rentOrSale == "Satılık/Kiralık") {
      count = count + 1;
      document.getElementById('rentOrSale').innerHTML = " Satılık veya Kiralık seçenelerinden birini seçmelisiniz.";
      // return true;
    } else {
      //  return true;
    }

    var countryOption = document.getElementById('countryOption');
    var country = countryOption.textContent || countryOption.innerText;
    if (country == "İl") {
      count = count + 1;
      document.getElementById('country').innerHTML = "İllerden birini seçmelisiniz.";
      // return true;
    } else {
      //  return true;
    }

    var minPrice = document.getElementById('minPrice');
    var minPriceValue = minPrice.value;
    var maxPrice = document.getElementById('maxPrice');
    var maxPriceValue = maxPrice.value;
    if (minPriceValue == '' || maxPriceValue == '' || (minPriceValue == '' && maxPriceValue == '')) {
      // return true;
    } else if (minPriceValue.length > maxPriceValue.length || (minPriceValue.length == maxPriceValue.length && minPriceValue > maxPriceValue)) {
      count = count + 1;
      document.getElementById('minMaxPrice').innerHTML = " Minimum fiyat maksimum fiyattan büyük olamaz.";

      //   return false;
    } else {
      //  return true;
    }

    var minSquareMeters = document.getElementById('minSquareMeters');
    var minSquareMetersValue = minSquareMeters.value;
    var maxSquareMeters = document.getElementById('maxSquareMeters');
    var maxSquareMetersValue = maxSquareMeters.value;
    if (minSquareMetersValue == '' || maxSquareMetersValue == '' || (minSquareMetersValue == '' && maxSquareMetersValue == '')) {
      // return true;
    } else if (minSquareMetersValue.length > maxSquareMetersValue.length || (minSquareMetersValue.length == maxSquareMetersValue.length && minSquareMetersValue > maxSquareMetersValue)) {
      count = count + 1;
      document.getElementById('minMaxSquareMeters').innerHTML = " Minimum metrekare maksimum metrekareden büyük olamaz.";

      //  return false;
    } else {
      //  return true;
    }

    var minAge = document.getElementById('minAge');
    var minAgeValue = minAge.value;
    var maxAge = document.getElementById('maxAge');
    var maxAgeValue = maxAge.value;
    if (minAgeValue == '' || maxAgeValue == '' || (minAgeValue == '' && maxAgeValue == '')) {
      // return true;
    } else if (minAgeValue.length > minAgeValue.length || (minAgeValue.length == minAgeValue.length && minAgeValue > minAgeValue)) {
      count = count + 1;
      document.getElementById('minMaxAge').innerHTML = " Minimum bina yaşı maksimum bina yaşından büyük olamaz.";
      //  return false;
    } else {
      //  return true;
    }
    console.log(count);
    if (count == 0) {
      document.querySelector('form.pure-form-filter').addEventListener('submit', function(e) {
        console.log(count);
        console.log(rentOrSale);
        console.log(country);
        var townArr = townCheckbox();
        console.log(townCheckbox());
        for (var i = 0; i < townArr.length; i++) {
          console.log(townArr[i]);
        }
        console.log(minPriceValue);
        console.log(maxPriceValue);
        console.log(minAgeValue);
        console.log(maxAgeValue);
        console.log(count);
      });
    } else {
      console.log("ece");
      console.log(minPriceValue);
      console.log(maxPriceValue);
      console.log(minSquareMetersValue);
      console.log(maxSquareMetersValue);
      count = 0;
    }

  }

  function update() {
    count = 0;
    var rentOrSaleOption = document.getElementById('rentOrSaleOption');
    var rentOrSale = rentOrSaleOption.value;
    if (rentOrSale === "Satılık/Kiralık") {
      document.getElementById('rentOrSale').innerHTML = " Satılık veya Kiralık seçenelerinden birini seçmelisiniz.";
      count++;
      return false;
    }
    var countryOption = document.getElementById('countryOption');
    var country = countryOption.value;
    if (country === "İl") {
      document.getElementById('country').innerHTML = "İllerden birini seçmelisiniz.";
      count++;
      return false;
    }

    var minPrice = document.getElementById('minPrice');
    var minPriceValue = minPrice.value;
    var maxPrice = document.getElementById('maxPrice');
    var maxPriceValue = maxPrice.value;
    if (minPriceValue == '' || maxPriceValue == '' || (minPriceValue == '' && maxPriceValue == '')) {
      // return true;
    } else if (minPriceValue.length > maxPriceValue.length || (minPriceValue.length == maxPriceValue.length && minPriceValue > maxPriceValue)) {

      document.getElementById('minMaxPrice').innerHTML = " Minimum fiyat maksimum fiyattan büyük olamaz.";
      count++;
      return false;
    }

    var minSquareMeters = document.getElementById('minSquareMeters');
    var minSquareMetersValue = minSquareMeters.value;
    var maxSquareMeters = document.getElementById('maxSquareMeters');
    var maxSquareMetersValue = maxSquareMeters.value;
    if (minSquareMetersValue == '' || maxSquareMetersValue == '' || (minSquareMetersValue == '' && maxSquareMetersValue == '')) {

    } else if (minSquareMetersValue.length > maxSquareMetersValue.length || (minSquareMetersValue.length == maxSquareMetersValue.length && minSquareMetersValue > maxSquareMetersValue)) {

      document.getElementById('minMaxSquareMeters').innerHTML = " Minimum metrekare maksimum metrekareden büyük olamaz.";
      count++;
      return false;
    }

    var minAge = document.getElementById('minAge');
    var minAgeValue = minAge.value;
    var maxAge = document.getElementById('maxAge');
    var maxAgeValue = maxAge.value;
    if (minAgeValue == '' || maxAgeValue == '' || (minAgeValue == '' && maxAgeValue == '')) {

    } else if (minAgeValue.length > maxAgeValue.length || (minAgeValue.length == maxAgeValue.length && minAgeValue > maxAgeValue)) {

      document.getElementById('minMaxAge').innerHTML = " Minimum bina yaşı maksimum bina yaşından büyük olamaz.";
      count++;
      return false;
    }
    if (count == 0) {
     

      return true;
    } else {
      update();
      return false;
    }
  }
</script>
<?php
$userId = $_COOKIE['user_id'];  //USER ID
$userType = $_COOKIE['user_type'];

if ($userType !== 0) {
  echo '<script>console.log("*  ' . $userType . '  *")</script>';
  $sql = "SELECT * FROM tbl_MyInterest WHERE userID=$userId AND UserType=$userType";
  $result = mysqli_query($con, $sql);
  $count = mysqli_num_rows($result);
  if ($count <= 0) {
    $sql = "INSERT INTO tbl_MyInterest (UserID, UserType) VALUES ('$userId','$userType')";
    $result = mysqli_query($con, $sql);
  }

  $sql = "SELECT * FROM tbl_MyInterest WHERE userID=$userId AND UserType=$userType";
  $result = mysqli_query($con, $sql);
  if ($result) {
    $getSel = mysqli_fetch_array($result);
  }
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["SearchButton"])) {
  echo '<script> console.log("YES")</script>';
  $status = 1; 
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
    echo '<script> console.log("KAYIT OLDU")</script>';

    $sql = "SELECT * FROM tbl_advertisements WHERE ads_status='$status' AND ads_price>='$minPrice' AND ads_price<='$maxPrice' AND
        ads_type='$advType' AND ads_province='$province' AND ads_town='$town' AND ads_neighbourhood='$neighborhood' AND
        ads_housetype='$houseType' AND ads_area>='$minArea' AND ads_area<='$maxArea' AND ads_roomnumber='$roomNum' AND
        ads_floor='$advFloor' AND ads_age>='$minAge' AND ads_age<='$maxAge' AND ads_heatingsystem='$heatingSystem' AND 
        ads_facade='$facade'";
    $resultSQL = mysqli_query($con, $sql);
    if ($resultSQL) {
      while ($getAdv = mysqli_fetch_array($resultSQL)) {
        echo '<script>console.log("' . $getAdv['ads_ID'] . '")</script>';
      }
    }
  }
} else {
  echo '<script> console.log("NO")</script>';
}
?>