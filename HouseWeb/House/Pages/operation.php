<?php
// This file is created for operations
require_once("db.php");
$con = Createdb();

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["deleteMyAdvertisement"])) {

    $advertisementID = $_COOKIE['advertisementIDForDisplaying'];
    $sqlForChangeStatusOfAds = "UPDATE tbl_advertisements SET ads_status='0' WHERE ads_ID=$advertisementID";
    $removeQuery = mysqli_query($GLOBALS['con'], $sqlForChangeStatusOfAds);
    if ($removeQuery) {
        $statusMsg = "Ilan görselleri silindi.";
    } else {
        $statusMsg = "Ilan görselleri silinemedi.";
    }
    header('Location: DisplayMyDeletedAdvertisements.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["UpdateTheAdvertisement"])) {

    $price_for_advertisement = $_POST['price'];
    $type_for_advertisement = $_POST['advType'];
    echo $type_for_advertisement . " dsadsadsda";
    $description_for_advertisement = $_POST['description'];
    $province_for_advertisement = $_POST['province'];
    $town_for_advertisement = $_POST['town'];
    $neighborhood_for_advertisement = $_POST['neighborhood'];
    $address_for_advertisement = $_POST['address'];
    $structureType_for_advertisement = $_POST['structureType'];
    $area_for_advertisement = $_POST['area'];

    $numOfRooms_for_advertisement = $_POST['numOfRooms'];
    $floor_for_advertisement = $_POST['floor'];
    $age_for_advertisement = $_POST['age'];
    $heating_for_advertisement = $_POST['heating'];
    $facade_for_advertisement = $_POST['facade'];
    $otopark_for_advertisement = $_POST['addition1'];
    $pool_for_advertisement = $_POST['addition2'];
    $security_for_advertisement = $_POST['addition3'];
    $kidsplaygarden_for_advertisement = $_POST['addition4'];

    $findProvince = "SELECT * FROM Province WHERE province_key='$province_for_advertisement'";
    $findName = mysqli_query($con, $findProvince);
    $getName = mysqli_fetch_array($findName);
    $province_for_advertisement = $getName['province_title'];

    $findTown = "SELECT * FROM Town WHERE town_key='$town_for_advertisement'";
    $findName = mysqli_query($con, $findTown);
    $getName = mysqli_fetch_array($findName);
    $town_for_advertisement = $getName['town_title'];

    $findNeighborhood = "SELECT * FROM Neighborhood WHERE neighborhood_key='$neighborhood_for_advertisement'";
    $findName = mysqli_query($con, $findNeighborhood);
    $getName = mysqli_fetch_array($findName);
    $neighborhood_for_advertisement = $getName['neighborhood_title'];

    $advertisementID = $_COOKIE['advertisementIDForDisplaying'];

    $updateAdsSql = "UPDATE tbl_advertisements SET ads_description='$description_for_advertisement',ads_type='$type_for_advertisement', ads_price='$price_for_advertisement',ads_province='$province_for_advertisement',ads_town='$town_for_advertisement',ads_neighbourhood='$neighborhood_for_advertisement',ads_address='$address_for_advertisement',ads_housetype='$structureType_for_advertisement',ads_area='$area_for_advertisement',ads_roomnumber='$numOfRooms_for_advertisement',ads_floor='$floor_for_advertisement',ads_age='$age_for_advertisement',ads_heatingsystem='$heating_for_advertisement',ads_facade='$facade_for_advertisement',ads_otopark='$otopark_for_advertisement',ads_pool='$pool_for_advertisement',ads_security='$security_for_advertisement',ads_kidsplaygarden='$kidsplaygarden_for_advertisement' WHERE ads_ID=$advertisementID";

    $UPtoDate = mysqli_query($GLOBALS['con'], $updateAdsSql);
    if ($UPtoDate) {
        echo "BAŞARILI";
    } else {
        echo "BAŞARSIZ";
    }



    $targetDir = "Advertisement_Images/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'PNG', 'JPEG', 'JPG');
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';

    $fileNames = array_filter($_FILES['files']['name']);

    if (!empty($fileNames)) {

        foreach ($_FILES['files']['name'] as $key => $val) {
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]);

            $targetFilePath = $targetDir . $fileName;

            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server 
                if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                    // Image db insert sql 
                    $insertValuesSQL .= "('" . $advertisementID . "','" . $fileName . "', NOW()),";
                } else {
                    $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                }
            } else {
                $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
            }
        }

        echo $insertValuesSQL;

        if (!empty($insertValuesSQL)) {
            $insertValuesSQL = trim($insertValuesSQL, ',');
            // Insert image file name into database 
            //$insert = $db->query("INSERT INTO images (file_name, uploaded_on) 
            $inserter = "INSERT INTO tbl_advertisementimages (advertisementID,file_name,upload_time) VALUES $insertValuesSQL";
            $addAdsQuery = mysqli_query($GLOBALS['con'], $inserter);

            if ($addAdsQuery) {
                $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                $statusMsg = "Files are uploaded successfully." . $errorMsg;
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
    } else {

        $deleteImages = "DELETE FROM tbl_advertisementimages WHERE advertisementID=$advertisementID";
        $removeQuery = mysqli_query($GLOBALS['con'], $deleteImages);
        if ($removeQuery) {
            $statusMsg = "Ilan görselleri silindi.";
        } else {
            $statusMsg = "Ilan görselleri silinemedi.";
        }
    }

    // Display status message 
    echo $statusMsg;
    header('Location: MyActiveAdvertisementsPage.php');
    exit;
};

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["SubmitSignupForIndividualUser"])) {

    $firstname = $_POST['firstName'];
    $surname = $_POST['lastName'];
    $phone = $_POST['phone'];
    $email = $_POST['mail'];
    $password = $_POST['password'];

    $targetDir = "Individual_Users_Images/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'PNG', 'JPEG', 'JPG');
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';

    $fileNames = array_filter($_FILES['files']['name']);

    if (!empty($fileNames)) {

        foreach ($_FILES['files']['name'] as $key => $val) {
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]);

            $targetFilePath = $targetDir . $fileName;

            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server 
                if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                    // Image db insert sql 
                    $insertValuesSQL .= $fileName;
                } else {
                    $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                }
            } else {
                $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
            }
        }

        echo $insertValuesSQL;

        if (!empty($insertValuesSQL)) {
            $insertValuesSQL = trim($insertValuesSQL, ',');
            $sqlForIndUserRegister = "INSERT INTO tbl_IndividualUsers (FirstName,LastName,MailAddress,Phone,Password,UserType,UserProfileImage) VALUES ('$firstname','$surname','$email','$phone','$password','1','$insertValuesSQL')";
            $query_run_Ind_register = mysqli_query($GLOBALS['con'], $sqlForIndUserRegister);

            if ($query_run_Ind_register) {
                $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                $statusMsg = "Files are uploaded successfully." . $errorMsg;
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
        echo '<script> alert("Profil Fotoğrafı Ekle")</script>';
        echo '<script> window.location.href = "IndividualUserSignUpPage.php";</script>';
    }


    if ($query_run_Ind_register) {
        sleep(3);
        echo '<script> console.log("Kayıt Başarılı")</script>';
        header('Location: IndividualUserLoginPage.php');
        exit;
    } else {

        echo '<script> alert("Data Not Saved")</script>';
    }
}
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET["SubmitSignInForIndividualUser"])) {
    require_once("IndividualUserLoginPage.php");
    $email = $_GET['userMail'];
    $password = $_GET['reg_password'];
    $sql1 = "SELECT * FROM tbl_IndividualUsers WHERE MailAddress='$email'";
    $result = mysqli_query($GLOBALS['con'], $sql1);
    $count = mysqli_num_rows($result);
    if ($count == 0) {
        echo '<script> 
        document.getElementById("mailWarning").innerHTML = "Mail hatalı";
        </script>';
        $email = "";
        $password = "";
        exit;
    } else {
        $sql2 = "SELECT * FROM tbl_IndividualUsers WHERE MailAddress='$email' and Password='$password'";
        $result2 = mysqli_query($GLOBALS['con'], $sql2);
        $count2 = mysqli_num_rows($result2);
        if ($count2 == 0) {

            echo '<script> 
            document.getElementById("passwordWarning").innerHTML = "Şifre hatalı";
            </script>';
            $email = "";
            $password = "";
            exit;
        } else {
            $sqlForRetrievingTypeAndId = "SELECT userID,UserType FROM tbl_IndividualUsers WHERE MailAddress='$email' and Password='$password'";
            $resultForRetrievingTypeAndId = mysqli_query($GLOBALS['con'], $sqlForRetrievingTypeAndId);
            $getValueForRetrievingTypeAndId = mysqli_fetch_array($resultForRetrievingTypeAndId);
            echo '<script> document.cookie = "user_type ="+' . $getValueForRetrievingTypeAndId['UserType'] . ';</script>';
            echo '<script> document.cookie = "user_id ="+' . $getValueForRetrievingTypeAndId['userID'] . ';</script>';
            echo '<script> window.location.href = "MainPage.php";</script>';
            exit;
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["SubmitSignupForOfficialUser"])) {

    $firmname = $_POST['firmName'];
    $address = $_POST['address'];
    $email = $_POST['mail'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $targetDir = "Official_Users_Images/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'PNG', 'JPEG', 'JPG');
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';

    $fileNames = array_filter($_FILES['files']['name']);

    if (!empty($fileNames)) {

        foreach ($_FILES['files']['name'] as $key => $val) {
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]);

            $targetFilePath = $targetDir . $fileName;

            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server 
                if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                    // Image db insert sql 
                    $insertValuesSQL .= $fileName;
                } else {
                    $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                }
            } else {
                $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
            }
        }

        echo $insertValuesSQL;

        if (!empty($insertValuesSQL)) {
            $insertValuesSQL = trim($insertValuesSQL, ',');
            $sqlForOfficialUserRegister = "INSERT INTO tbl_OfficalUsers (FirmName,Address,MailAddress,Phone,Password,UserType,UserProfileImage) VALUES ('$firmname','$address','$email','$phone','$password','2','$insertValuesSQL')";
            $query_run_official_register = mysqli_query($GLOBALS['con'], $sqlForOfficialUserRegister);

            if ($query_run_official_register) {
                $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                $statusMsg = "Files are uploaded successfully." . $errorMsg;
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
        echo '<script> alert("Profil Fotoğrafı Ekle")</script>';
        echo '<script> window.location.href = "OfficialUserSignUpPage.php";</script>';
    }

    if ($query_run_official_register) {
        sleep(3);
        echo '<script> console.log("kAYIT bAŞARILI")</script>';
        header('Location: OfficialUserPaymentPage.php');
        exit;
    } else {

        echo '<script> alert("Data Not Saved")</script>';
    }
}
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET["SubmitSignInForOfficialUser"])) {
    require_once("OfficialUserLoginPage.php");
    $email = $_GET['userMail'];
    $password = $_GET['reg_password'];
    $sql1 = "SELECT * FROM tbl_OfficalUsers WHERE MailAddress='$email'";
    $result = mysqli_query($GLOBALS['con'], $sql1);
    $count = mysqli_num_rows($result);
    if ($count == 0) {
        echo '<script> 
        document.getElementById("mailErrorMessage").innerHTML = "Mail hatalı";
        </script>';
        $email = "";
        $password = "";
        exit;
    } else {
        $sql2 = "SELECT * FROM tbl_OfficalUsers WHERE MailAddress='$email' and Password='$password'";
        $result2 = mysqli_query($GLOBALS['con'], $sql2);
        $count2 = mysqli_num_rows($result2);
        if ($count2 == 0) {

            echo '<script> 
                    document.getElementById("passwordErrorMessage").innerHTML = "Şifre hatalı";
            </script>';
            $email = "";
            $password = "";
            exit;
        } else {
            $sqlForRetrievingTypeAndId = "SELECT userID,UserType FROM tbl_OfficalUsers WHERE MailAddress='$email' and Password='$password'";
            $resultForRetrievingTypeAndId = mysqli_query($GLOBALS['con'], $sqlForRetrievingTypeAndId);
            $getValueForRetrievingTypeAndId = mysqli_fetch_array($resultForRetrievingTypeAndId);
            echo '<script> document.cookie = "user_type ="+' . $getValueForRetrievingTypeAndId['UserType'] . ';</script>';
            echo '<script> document.cookie = "user_id ="+' . $getValueForRetrievingTypeAndId['userID'] . ';</script>';
            echo '<script> window.location.href = "MainPage.php";</script>';
            exit;
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["submitForNewAdvertisement"])) {

    $price_for_advertisement = $_POST['price'];
    $type_for_advertisement = $_POST['advType'];
    $description_for_advertisement = $_POST['description'];
    $province_for_advertisement = $_POST['province'];
    $town_for_advertisement = $_POST['town'];
    $neighborhood_for_advertisement = $_POST['neighborhood'];
    $address_for_advertisement = $_POST['address'];
    $structureType_for_advertisement = $_POST['structureType'];
    $area_for_advertisement = $_POST['area'];


    $numOfRooms_for_advertisement = $_POST['numOfRooms'];
    $floor_for_advertisement = $_POST['floor'];
    $age_for_advertisement = $_POST['age'];
    $heating_for_advertisement = $_POST['heating'];
    $facade_for_advertisement = $_POST['facade'];
    $otopark_for_advertisement = $_POST['addition1'];
    $pool_for_advertisement = $_POST['addition2'];
    $security_for_advertisement = $_POST['addition3'];
    $kidsplaygarden_for_advertisement = $_POST['addition4'];

    $findProvince = "SELECT * FROM Province WHERE province_key='$province_for_advertisement'";
    $findName = mysqli_query($con, $findProvince);
    $getName = mysqli_fetch_array($findName);
    $province_for_advertisement = $getName['province_title'];

    $findTown = "SELECT * FROM Town WHERE town_key='$town_for_advertisement'";
    $findName = mysqli_query($con, $findTown);
    $getName = mysqli_fetch_array($findName);
    $town_for_advertisement = $getName['town_title'];

    $findNeighborhood = "SELECT * FROM Neighborhood WHERE neighborhood_key='$neighborhood_for_advertisement'";
    $findName = mysqli_query($con, $findNeighborhood);
    $getName = mysqli_fetch_array($findName);
    $neighborhood_for_advertisement = $getName['neighborhood_title'];

    $currentUserID = $_COOKIE['user_id'];
    $addAdsSql =  "INSERT INTO tbl_advertisements(agency_ID,ads_type,ads_price,ads_status,ads_province,ads_town,ads_neighbourhood,ads_address,
     ads_housetype,ads_area,ads_roomnumber,ads_floor,ads_age,ads_heatingsystem,ads_facade,ads_otopark,ads_pool,ads_security,
      ads_kidsplaygarden,ads_date,ads_displayed_count,ads_favoriting_count,ads_description)
     VALUES ('$currentUserID','$type_for_advertisement','$price_for_advertisement','1','$province_for_advertisement','$town_for_advertisement','$neighborhood_for_advertisement',
     '$address_for_advertisement','$structureType_for_advertisement','$area_for_advertisement','$numOfRooms_for_advertisement',
     '$floor_for_advertisement','$age_for_advertisement','$heating_for_advertisement','$facade_for_advertisement','$otopark_for_advertisement',
     '$pool_for_advertisement','$security_for_advertisement','$kidsplaygarden_for_advertisement',NOW(),'0','0','$description_for_advertisement')";

    $addAdsQuery = mysqli_query($GLOBALS['con'], $addAdsSql);
    $last_id = $GLOBALS['con']->insert_id;
    echo $last_id;

    $targetDir = "Advertisement_Images/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'PNG', 'JPEG', 'JPG');
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';

    $fileNames = array_filter($_FILES['files']['name']);

    if (!empty($fileNames)) {

        foreach ($_FILES['files']['name'] as $key => $val) {
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]);

            $targetFilePath = $targetDir . $fileName;

            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server 
                if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                    // Image db insert sql 
                    $insertValuesSQL .= "('" . $last_id . "','" . $fileName . "', NOW()),";
                } else {
                    $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                }
            } else {
                $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
            }
        }

        echo $insertValuesSQL;

        if (!empty($insertValuesSQL)) {
            $insertValuesSQL = trim($insertValuesSQL, ',');
            // Insert image file name into database 
            //$insert = $db->query("INSERT INTO images (file_name, uploaded_on) 
            $inserter = "INSERT INTO tbl_advertisementimages (advertisementID,file_name,upload_time) VALUES $insertValuesSQL";
            $addAdsQuery = mysqli_query($GLOBALS['con'], $inserter);

            if ($addAdsQuery) {
                $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                $statusMsg = "Files are uploaded successfully." . $errorMsg;
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }

    // Display status message 
    echo $statusMsg;
    header('Location: MyActiveAdvertisementsPage.php');
    exit;
}



if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["updateIndividualUserProperties"])) {
    $userID = $_COOKIE['user_id'];
    $firstname = $_POST['firstName'];
    $surname = $_POST['lastName'];
    $phone = $_POST['phone'];
    $email = $_POST['mail'];

    $targetDir = "Individual_Users_Images/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'PNG', 'JPEG', 'JPG');
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';

    $fileNames = array_filter($_FILES['files']['name']);

    if (!empty($fileNames)) {

        foreach ($_FILES['files']['name'] as $key => $val) {
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]);

            $targetFilePath = $targetDir . $fileName;

            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server 
                if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                    // Image db insert sql 
                    $insertValuesSQL .= $fileName;
                } else {
                    $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                }
            } else {
                $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
            }
        }

        echo $insertValuesSQL;

        if (!empty($insertValuesSQL)) {
            $insertValuesSQL = trim($insertValuesSQL, ',');
            $sqlForIndUserUpdate = "UPDATE tbl_IndividualUsers SET FirstName='$firstname',LastName='$surname',Phone='$phone',MailAddress='$email',UserProfileImage='$insertValuesSQL' WHERE userID=$userID";
            $query_run_ind_update = mysqli_query($GLOBALS['con'], $sqlForIndUserUpdate);
            if ($query_run_ind_update) {
                $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                $statusMsg = "Files are uploaded successfully." . $errorMsg;
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }
    header('Location: IndividualUserProfilePage.php');
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["updateIndividualUserPassword"])) {
    $userID = $_COOKIE['user_id'];
    $password = $_POST['password2'];
    $sql = "UPDATE tbl_IndividualUsers SET Password='$password' WHERE userID=$userID";
    $query_run = mysqli_query($GLOBALS['con'], $sql);
    header('Location: IndividualUserProfilePage.php');
}




if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["updateOfficialUserProperties"])) {
    $userID = $_COOKIE['user_id'];
    $firmname = $_POST['firmName'];
    $address = $_POST['address'];
    $email = $_POST['mail'];
    $phone = $_POST['phone'];
    $targetDir = "Official_Users_Images/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'PNG', 'JPEG', 'JPG');
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';

    $fileNames = array_filter($_FILES['files']['name']);

    if (!empty($fileNames)) {

        foreach ($_FILES['files']['name'] as $key => $val) {
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]);

            $targetFilePath = $targetDir . $fileName;

            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server 
                if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                    // Image db insert sql 
                    $insertValuesSQL .= $fileName;
                } else {
                    $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                }
            } else {
                $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
            }
        }

        echo $insertValuesSQL;

        if (!empty($insertValuesSQL)) {
            $insertValuesSQL = trim($insertValuesSQL, ',');
            $sqlForOfficialUserUpdate = "UPDATE tbl_OfficalUsers SET FirmName='$firmname',Address='$address',Phone='$phone',MailAddress='$email',UserProfileImage='$insertValuesSQL' WHERE userID=$userID";
            $query_run_official_update = mysqli_query($GLOBALS['con'], $sqlForOfficialUserUpdate);
            if ($query_run_official_update) {
                $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                $statusMsg = "Files are uploaded successfully." . $errorMsg;
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }

    header('Location: OfficialUserProfilePage.php');
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["updateOfficialUserPassword"])) {
    $userID = $_COOKIE['user_id'];
    $password = $_POST['password2'];
    $sql = "UPDATE tbl_OfficalUsers SET Password='$password' WHERE userID=$userID";
    $query_run = mysqli_query($GLOBALS['con'], $sql);
    header('Location: OfficialUserProfilePage.php');
}

//Get data from mysql database
function getData()
{
    $sql = "SELECT * FROM books";
    $result = mysqli_query($GLOBALS['con'], $sql);

    if (mysqli_num_rows($result) > 0) {
        return $result;
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["add_remove_from_favourites"])) {

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

    if ($countOfCurrentAdsAndIndividualUser > 0) {
        echo '<script>console.log("çIKARMAYA GİRDİ")</script>';
        if ($user_type == 1) {
            $sqlForRemovingCurrentAdvertisementFromUser = "DELETE FROM tbl_IndividualUsers_Favourited WHERE individual_UserID= $userID AND advertisementID=$advertisementIDForDisplaying";
        } else if ($user_type == 2) {
            $sqlForRemovingCurrentAdvertisementFromUser = "DELETE FROM tbl_OfficialUsers_Favourited WHERE official_UserID= $userID AND advertisementID=$advertisementIDForDisplaying";
        }
        $queryForCurrentFavorAdvertisement = mysqli_query($GLOBALS['con'], $sqlForRemovingCurrentAdvertisementFromUser);
        header('Location: DisplayAdvertisementPage.php');
        exit;
    } else {
        echo '<script>console.log("EKLEMEDE GİRDİ")</script>';
        if ($user_type == 1) {
            $sqlForAddNewFavouritedAdvertisements = "INSERT INTO tbl_IndividualUsers_Favourited (individual_UserID,advertisementID) VALUES  ('$userID','$advertisementIDForDisplaying')";
        } else if ($user_type == 2) {
            $sqlForAddNewFavouritedAdvertisements = "INSERT INTO tbl_OfficialUsers_Favourited (official_UserID,advertisementID) VALUES  ('$userID','$advertisementIDForDisplaying')";
        }

        $queryForCurrentFavorAdvertisement = mysqli_query($GLOBALS['con'], $sqlForAddNewFavouritedAdvertisements);
        header('Location: DisplayAdvertisementPage.php');
        exit;
    }
}

function textboxValue($value)
{
    $textbox = mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
    if (empty($textbox)) {
        return false;
    } else {
        return $textbox;
    }
}
