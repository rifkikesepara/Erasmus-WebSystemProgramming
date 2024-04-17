<?php
$targetPath = "photos/";
if (!file_exists($targetPath . $_POST["productName"])) {
    mkdir($targetPath . $_POST["productName"], 0777, true);
    $targetPath = $targetPath . $_POST["productName"] . "/";
} else {
    $targetPath = $targetPath . $_POST["productName"] . "/";
}
$targetFileName = $targetPath . basename($_FILES["fileToUpload"]["name"]);
$uploadOK = 1;
$extFileName = strtolower(pathinfo($targetFileName, PATHINFO_EXTENSION));

if (isset($_POST["submit"])) {
    $checkResult = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($checkResult !== false) {
        echo "The received file is an image file type " . $checkResult["mime"] . ". <br/>";
        $uploadOK = 1;
    } else {
        echo "The received file is not an image.<br/>";
        $uploadOK = 0;
    }
}

if (file_exists($targetFileName)) {
    echo "Unfortunately, such a file already exists. <br/>";
    $uploadOK = 0;
}

if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "File too big.<br/>";
    $uploadOK = 0;
}

if ($uploadOK == 0) {
    echo "The file is not received.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFileName)) {
        // echo "File " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " was received.";
    } else {
        echo "An error occured while copying the file to the target directory.";
    }
}
