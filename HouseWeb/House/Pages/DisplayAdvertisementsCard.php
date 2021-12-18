<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<?php
require_once("db.php");
$connection = Createdb();

$currentPage = $_COOKIE['currentPageForAdvertisements'];
$orderBy = $_COOKIE['orderBy'];
$orderType = $_COOKIE['orderType'];
$sqlForAgency = "SELECT * FROM tbl_OfficalUsers";
$resultForAgency = mysqli_query($connection, $sqlForAgency);
$emparrayForAgency = array();
while ($rowForAgency = mysqli_fetch_assoc($resultForAgency)) {
    $emparrayForAgency[] = $rowForAgency;
}

$sqlForSelectingImageOfAds = "SELECT * FROM `tbl_advertisementimages`";
$resultForSelectingImageOfAds = mysqli_query($connection, $sqlForSelectingImageOfAds);
$emparrayForSelectingImageOfAds = array();
while ($rowForSelectingImageOfAds = mysqli_fetch_assoc($resultForSelectingImageOfAds)) {
    $emparrayForSelectingImageOfAds[] = $rowForSelectingImageOfAds;
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["buttonSearch"]) && $currentPage == "MainPage") {
    $status = 1;
    $str = $_POST['searchedWord'];
    $arr = explode(" ", $str);
    $str = $_POST['searchedWord'];
    $arr = explode(" ", $str);
    $count = 0;
    $emparrayForAllAds = array();
    while (count($arr) !== $count) {
        $sql = "SELECT * FROM tbl_advertisements WHERE ads_status='$status' AND (ads_price LIKE '%$arr[$count]%' OR ads_type LIKE '%$arr[$count]%' OR 
        ads_province LIKE '%$arr[$count]%' OR ads_town LIKE '%$arr[$count]%' OR ads_neighbourhood LIKE '%$arr[$count]%' OR ads_housetype LIKE '%$arr[$count]%' OR 
        ads_area LIKE '%$arr[$count]%' OR ads_roomnumber LIKE '%$arr[$count]%' OR ads_floor LIKE '%$arr[$count]%' OR ads_age LIKE '%$arr[$count]%' OR
        ads_heatingsystem LIKE '%$arr[$count]%' OR ads_facade LIKE '%$arr[$count]%')";
        $resultSQL = mysqli_query($connection, $sql);
        if ($resultSQL) {
            while ($getAdv = mysqli_fetch_array($resultSQL)) {
                $emparrayForAllAds[] = $getAdv;
                echo '<script> console.log("' . $getAdv['ads_ID'] . '")</script>';
            }
        }
        $count++;
    }
} else if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["SearchButton"]) && $currentPage == "MainPage") {
    echo '<script> console.log("YES")</script>';
    $status = 1; //MEVCUT
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
        $emparrayForAllAds = array();
        $sql = "CREATE VIEW advanced_search AS SELECT * FROM tbl_advertisements WHERE ads_status='$status' AND ads_price>='$minPrice' AND ads_price<='$maxPrice' AND
        ads_type='$advType' AND ads_province='$province' AND ads_town='$town' AND ads_neighbourhood='$neighborhood' AND
        ads_housetype='$houseType' AND ads_area>='$minArea' AND ads_area<='$maxArea' AND ads_roomnumber='$roomNum' AND
        ads_floor='$advFloor' AND ads_age>='$minAge' AND ads_age<='$maxAge' AND ads_heatingsystem='$heatingSystem' AND 
        ads_facade='$facade'";

        $resultSQL = mysqli_query($con, $sql);
        $sql2 = "SELECT * FROM advanced_search";
        $resultSQLSearch = mysqli_query($con, $sql2);
        if ($resultSQLSearch) {
            while ($getAdv = mysqli_fetch_array($resultSQLSearch)) {
                echo '<script>console.log("' . $getAdv['ads_ID'] . '")</script>';
                $emparrayForAllAds[] = $getAdv;
            }
        }
    }
} else if ($currentPage == "MainPage" && $orderBy == "Price" && $orderType == "desc") {
    $sql = "CREATE PROCEDURE `orderDescByPrice`() NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER SELECT * FROM tbl_advertisements WHERE ads_status=1 ORDER BY ads_price DESC";
    $result = mysqli_query($connection, $sql);
    $resultForAllAds = mysqli_query($connection, "CALL orderDescByPrice();");
    $emparrayForAllAds = array();
    while ($rowForAllAds = mysqli_fetch_array($resultForAllAds)) {
        $emparrayForAllAds[] = $rowForAllAds;
    }
} else if ($currentPage == "MainPage" && $orderBy == "Price" && $orderType == "asc") {
    $sql = "CREATE PROCEDURE `orderAscByPrice`() NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER SELECT * FROM tbl_advertisements WHERE ads_status=1 ORDER BY ads_price ASC";
    $result = mysqli_query($connection, $sql);
    $resultForAllAds = mysqli_query($connection, "CALL orderAscByPrice();");
    $emparrayForAllAds = array();
    while ($rowForAllAds = mysqli_fetch_array($resultForAllAds)) {
        $emparrayForAllAds[] = $rowForAllAds;
    }
} else if ($currentPage == "MainPage" && $orderBy == "Date" && $orderType == "desc") {
    $sql = "CREATE PROCEDURE `orderDescByDate`() NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER SELECT * FROM tbl_advertisements WHERE ads_status=1 ORDER BY ads_date DESC";
    $result = mysqli_query($connection, $sql);
    $resultForAllAds = mysqli_query($connection, "CALL orderDescByDate();");
    $emparrayForAllAds = array();
    while ($rowForAllAds = mysqli_fetch_array($resultForAllAds)) {
        $emparrayForAllAds[] = $rowForAllAds;
    }
} else if ($currentPage == "MainPage" && $orderBy == "Date" && $orderType == "asc") {
    $sql = "CREATE PROCEDURE `orderAscByDate`() NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER SELECT * FROM tbl_advertisements WHERE ads_status=1 ORDER BY ads_date ASC";
    $result = mysqli_query($connection, $sql);
    $resultForAllAds = mysqli_query($connection, "CALL orderAscByDate();");
    $emparrayForAllAds = array();
    while ($rowForAllAds = mysqli_fetch_array($resultForAllAds)) {
        $emparrayForAllAds[] = $rowForAllAds;
    }
} else if ($currentPage == "MainPage" && $orderBy == "Area" && $orderType == "desc") {
    $sql = "CREATE PROCEDURE `orderDescByArea`() NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER SELECT * FROM tbl_advertisements WHERE ads_status=1 ORDER BY ads_area DESC";
    $result = mysqli_query($connection, $sql);
    $resultForAllAds = mysqli_query($connection, "CALL orderDescByArea();");
    $emparrayForAllAds = array();
    while ($rowForAllAds = mysqli_fetch_array($resultForAllAds)) {
        $emparrayForAllAds[] = $rowForAllAds;
    }
} else if ($currentPage == "MainPage" && $orderBy == "Area" && $orderType == "asc") {
    $sql = "CREATE PROCEDURE `orderAscByArea`() NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER SELECT * FROM tbl_advertisements WHERE ads_status=1 ORDER BY ads_area ASC";
    $result = mysqli_query($connection, $sql);
    $resultForAllAds = mysqli_query($connection, "CALL orderAscByArea();");
    $emparrayForAllAds = array();
    while ($rowForAllAds = mysqli_fetch_array($resultForAllAds)) {
        $emparrayForAllAds[] = $rowForAllAds;
    }
} else if ($currentPage == "MainPage") {
    $sqlForAllAds = "SELECT * FROM tbl_advertisements WHERE ads_status=1";
    $resultForAllAds = mysqli_query($connection, $sqlForAllAds);
    $emparrayForAllAds = array();
    while ($rowForAllAds = mysqli_fetch_assoc($resultForAllAds)) {
        $emparrayForAllAds[] = $rowForAllAds;
    }
} else if ($currentPage == "MyActiveAdvertisementsPage") {
    $userId = $_COOKIE['user_id'];
    $sqlForAllAds = "SELECT * FROM tbl_advertisements WHERE agency_ID=$userId AND ads_status=1";
    $resultForAllAds = mysqli_query($connection, $sqlForAllAds);
    $emparrayForAllAds = array();
    while ($rowForAllAds = mysqli_fetch_assoc($resultForAllAds)) {
        $emparrayForAllAds[] = $rowForAllAds;
    }
} else if ($currentPage == "MyDeletedAdvertisementsPage") {
    $userId = $_COOKIE['user_id'];
    $sqlForAllAds = "SELECT * FROM tbl_advertisements WHERE agency_ID=$userId AND ads_status!=1";
    $resultForAllAds = mysqli_query($connection, $sqlForAllAds);
    $emparrayForAllAds = array();
    while ($rowForAllAds = mysqli_fetch_assoc($resultForAllAds)) {
        $emparrayForAllAds[] = $rowForAllAds;
    }
} else if ($currentPage == "DisplayAgencyOfficerProfile") {
    $agencyId = $_COOKIE['Agency_ID'];
    $sqlForAllAds = "SELECT * FROM tbl_advertisements WHERE agency_ID=$agencyIdAND ads_status!=1 ";
    $resultForAllAds = mysqli_query($connection, $sqlForAllAds);
    $emparrayForAllAds = array();
    while ($rowForAllAds = mysqli_fetch_assoc($resultForAllAds)) {
        $emparrayForAllAds[] = $rowForAllAds;
    }
} else if ($currentPage == "DisplayMyFavoriteAdvertisements") {
    $userType = $_COOKIE['user_type'];
    $userId = $_COOKIE['user_id'];
    if ($userType == 2) {
        $sqlForAllAds = "SELECT * FROM tbl_advertisements WHERE ads_ID IN(SELECT advertisementID FROM tbl_officialusers_favourited WHERE official_UserID=$userId)";
        $resultForAllAds = mysqli_query($connection, $sqlForAllAds);
        $emparrayForAllAds = array();
        while ($rowForAllAds = mysqli_fetch_assoc($resultForAllAds)) {
            $emparrayForAllAds[] = $rowForAllAds;
        }
    } else if ($userType == 1) {
        $sqlForAllAds = "SELECT * FROM tbl_advertisements WHERE ads_ID IN(SELECT advertisementID FROM tbl_individualusers_favourited WHERE individual_UserID=$userId)";
        $resultForAllAds = mysqli_query($connection, $sqlForAllAds);
        $emparrayForAllAds = array();
        while ($rowForAllAds = mysqli_fetch_assoc($resultForAllAds)) {
            $emparrayForAllAds[] = $rowForAllAds;
        }
    }
} else if ($currentPage == "MyInterestsAdvertisementsDisplay") {
    $userId = $_COOKIE['user_id'];
    $userType = $_COOKIE['user_type'];
    if ($userType == 2) {
        $sql = "SELECT * FROM tbl_MyInterest WHERE userID=$userId AND UserType=$userType";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $getSel = mysqli_fetch_array($result);
        }
        $status = 1;
        $advType = $getSel['AdvType'];
        $province = $getSel['Province'];
        $minPrice = $getSel['MinPrice'];
        $maxPrice = $getSel['MaxPrice'];
        $town = $getSel['Town'];
        $neighborhood = $getSel['Neighborhood'];
        $houseType = $getSel['HouseType'];
        $minArea = $getSel['MinArea'];
        $maxArea = $getSel['MaxArea'];
        $roomNum = $getSel['RoomNumber'];
        $advFloor = $getSel['AdvFloor'];
        $minAge = $getSel['MinAge'];
        $maxAge = $getSel['MaxAge'];
        $heatingSystem = $getSel['HeatingSystem'];
        $facade = $getSel['Facade'];
        $additionalInfo = $getSel['AdditionalInfo'];
        $emparrayForAllAds = array();
        $sql = "SELECT * FROM tbl_advertisements WHERE agency_ID!='$userId' AND ads_status='$status' AND ads_price>='$minPrice' AND ads_price<='$maxPrice' AND
            ads_type='$advType' AND ads_province='$province' AND ads_town='$town' AND ads_neighbourhood='$neighborhood' AND
            ads_housetype='$houseType' AND ads_area>='$minArea' AND ads_area<='$maxArea' AND ads_roomnumber='$roomNum' AND
            ads_floor='$advFloor' AND ads_age>='$minAge' AND ads_age<='$maxAge' AND ads_heatingsystem='$heatingSystem' AND 
            ads_facade='$facade'";
        $resultSQL = mysqli_query($con, $sql);
        if ($resultSQL) {
            while ($getAdv = mysqli_fetch_array($resultSQL)) {
                echo '<script>console.log("' . $getAdv['ads_ID'] . '")</script>';
                $emparrayForAllAds[] = $getAdv;
            }
        }
    } else if ($userType == 1) {
        $sql = "SELECT * FROM tbl_MyInterest WHERE userID=$userId AND UserType=$userType";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $getSel = mysqli_fetch_array($result);
        }

        $status = 1; //MEVCUT
        $advType = $getSel['AdvType'];
        $province = $getSel['Province'];
        $minPrice = $getSel['MinPrice'];
        $maxPrice = $getSel['MaxPrice'];
        $town = $getSel['Town'];
        $neighborhood = $getSel['Neighborhood'];
        $houseType = $getSel['HouseType'];
        $minArea = $getSel['MinArea'];
        $maxArea = $getSel['MaxArea'];
        $roomNum = $getSel['RoomNumber'];
        $advFloor = $getSel['AdvFloor'];
        $minAge = $getSel['MinAge'];
        $maxAge = $getSel['MaxAge'];
        $heatingSystem = $getSel['HeatingSystem'];
        $facade = $getSel['Facade'];
        $additionalInfo = $getSel['AdditionalInfo'];
        $emparrayForAllAds = array();
        $sql = "SELECT * FROM tbl_advertisements WHERE ads_status='$status' AND ads_price>='$minPrice' AND ads_price<='$maxPrice' AND
            ads_type='$advType' AND ads_province='$province' AND ads_town='$town' AND ads_neighbourhood='$neighborhood' AND
            ads_housetype='$houseType' AND ads_area>='$minArea' AND ads_area<='$maxArea' AND ads_roomnumber='$roomNum' AND
            ads_floor='$advFloor' AND ads_age>='$minAge' AND ads_age<='$maxAge' AND ads_heatingsystem='$heatingSystem' AND 
            ads_facade='$facade'";
        $resultSQL = mysqli_query($con, $sql);
        if ($resultSQL) {
            while ($getAdv = mysqli_fetch_array($resultSQL)) {
                echo '<script>console.log("' . $getAdv['ads_ID'] . '")</script>';
                $emparrayForAllAds[] = $getAdv;
            }
        }
    }
}



echo '<script> let mochHouseData =' . json_encode($emparrayForAllAds, JSON_UNESCAPED_UNICODE) . '</script>';
echo '<script> console.log(mochHouseData)</script>';
echo '<script> let agencyData =' . json_encode($emparrayForAgency, JSON_UNESCAPED_UNICODE) . '</script>';
echo '<script> console.log(agencyData)</script>';
echo '<script> let adsImageData =' . json_encode($emparrayForSelectingImageOfAds, JSON_UNESCAPED_UNICODE) . '</script>';
echo '<script> console.log(adsImageData)</script>';

echo '<script> const issueListe = document.getElementById("issuesList");
const pagination_element = document.getElementById("pagination");
let current_page = 1;
let rows = 2;
</script>';

echo '<script>
function PaginationButton(page, items, typeOfButton) {
    if (typeOfButton === "0") {

        let button = document.createElement("button");
        button.innerText = page;

        if (current_page === page) {
            button.classList.add("active");
        }

        button.addEventListener("click", function() {
            current_page = page;
            fetchData(items, issueListe, rows, current_page);
            let current_btn = document.querySelector(".pagenumbers button.active");
            button.classList.add("active");
        });

        return button;
    } else if (typeOfButton === "1") {
        let button = document.createElement("button");
        let iconIse = document.createElement("div");
        iconIse.innerHTML = "<i class=\'fas fa-arrow-left\'></i>";
        button.appendChild(iconIse);

        button.addEventListener("click", function() {
            current_page--;
            fetchData(items, issueListe, rows, current_page);
        });
        return button;

    } else {
        let button = document.createElement("button");
        let iconIse = document.createElement("div");
        iconIse.innerHTML = "<i class=\'fas fa-arrow-right\'></i>";
        button.appendChild(iconIse);

        button.addEventListener("click", function() {
            current_page++;
            fetchData(items, issueListe, rows, current_page);
        });
        return button;
    }

}
</script>';

echo '<script>
function redirectToAdvertisementsPage(ads_ID) {
    document.cookie = "advertisementIDForDisplaying =" + ads_ID;
    localStorage.setItem("advertisementIDForDisplaying", ads_ID);
    localStorage.setItem("directedFrom", window.location.href.split("/")[window.location.href.split("/").length - 1].split(".")[0]);
    let currPageRedirectionParameter = window.location.href.split("/")[window.location.href.split("/").length - 1].split(".")[0];
    if (currPageRedirectionParameter === "MyActiveAdvertisementsPage") {
        window.location.href = "DisplayMyActiveAdvertisementsPage.php";
    } else if (currPageRedirectionParameter === "MyDeletedAdvertisementsPage") {
        window.location.href = "DisplayMyDeletedAdvertisements.php";
    } else {
        window.location.href = "DisplayAdvertisementPage.php";
    }

}
</script>';

echo '<script>
function fetchData(items, wrapper, rows_per_page, page) {

    wrapper.innerHTML = "";
    page--;
    let start = rows_per_page * page;
    let end = start + rows_per_page;
    let paginatedItems = items.slice(start, end);
    for (let i = 0; i < paginatedItems.length; i++) {
        let ads_ID = paginatedItems[i].ads_ID;
        let price = paginatedItems[i].ads_price;
        let date = paginatedItems[i].ads_date;
        let rentOrSale = paginatedItems[i].ads_type;
        let houseType = paginatedItems[i].ads_housetype;
        let meterSquare = paginatedItems[i].ads_area;
        let roomNumber = paginatedItems[i].ads_roomnumber;
        let description = paginatedItems[i].ads_description;
        let address = paginatedItems[i].ads_province+" "+paginatedItems[i].ads_town+" "+paginatedItems[i].ads_neighbourhood+" "+paginatedItems[i].ads_address;
        let firm="";
        let firstImageOfAds="";
        for (let j = 0; j < agencyData.length; j++){
            if(paginatedItems[i].agency_ID==agencyData[j].userID){
                firm = agencyData[j].FirmName;
            }
        }
        
        for (let k = 0; k < adsImageData.length; k++){
            if(paginatedItems[i].ads_ID==adsImageData[k].advertisementID){
                firstImageOfAds = adsImageData[k].file_name;
                break;
            }
        }

        let item_element = document.createElement("div");
        let sourceOfImage="Advertisement_Images/"+firstImageOfAds+"";
        item_element.innerHTML = "<a style=\'cursor:pointer;color:inherit;text-decoration:inherit\' onclick=\'redirectToAdvertisementsPage(" + ads_ID + ")\'><div class=\'HomeCardStyling\'>" +
            "<div><img src="+sourceOfImage+" alt=\'EvGörseli\' width=\'200px\' height=\'250px\' style=\'border:1px solid black;margin-right: 8px;margin-top: 5px;margin-left: 4px;margin-bottom: 5px;\'/></div>" +
            "<div class=\'InnerElementsSytlingForCard\'>" +
            "<div style=\'margin: 0\'><div class=\'LineElementsForSpaceBetween\'><div><div><h1 class=\'priceStyling\'>" + price + "₺</h1></div></div>" +
            "<div> <h1 style=\'font-size: 15px;text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);\'>" + date + "</h1></div></div></div>" +
            "<div><div class=\'LineElementsColumnBasedSytling\'><div><h1>" + rentOrSale + "</h1></div>" +
            "<div><h1>" + houseType + "</h1></div><div><h1>" + roomNumber + "</h1></div><div><h1>" + meterSquare + " m<sup>2</sup></h1></div></div></div>" +
            "<div> <h1 style=\'font-size: 15px; font-weight: normal;\'>" + description + "</h1></div>" +
            "<div><div class=\'LineElementsForSpaceBetween\'><div>" +
            "<h1>" + address + "</h1></div><div><h1 style=\'white-space: nowrap;\'>" + firm + "</h1>" +
            "</div></div></div></div></div></a>"
        wrapper.appendChild(item_element);

    }

    pagination_element.innerHTML = "";
    let page_count = Math.ceil(items.length / rows_per_page);
    if (current_page >= 4) {
        pagination_element.appendChild(PaginationButton(current_page, items, "1"));
    }

    if (current_page === 1 || (current_page - 1) % 3 === 0) {

        for (let currIndex = current_page; currIndex < current_page + 3; currIndex++) {

            if (currIndex <= Math.ceil(mochHouseData.length / rows_per_page)) {
                let btn = PaginationButton(currIndex, items, "0");
                pagination_element.appendChild(btn);
            }

        }
    } else {

        let begIndex = ((Math.ceil((current_page / 3) + 1) - 1) * 3) - 2;

        for (let i = begIndex; i < begIndex + 3; i++) {
            if (i <= Math.ceil(mochHouseData.length / rows_per_page)) {
                let btn = PaginationButton(i, items, "0");
                pagination_element.appendChild(btn);
            }
        }
    }
    if (mochHouseData.length / rows_per_page !== current_page) {
        pagination_element.appendChild(PaginationButton(current_page, items, "2"));
    }

}
</script>';
echo '<script>
fetchData(mochHouseData, issueListe, rows, current_page);
</script>';
?>