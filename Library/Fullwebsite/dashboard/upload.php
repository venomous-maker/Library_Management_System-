
<?php
session_start();
require_once "../connect.php";
if(isset($_SESSION['adminID']) =="") {
  if(isset($_SESSION['user_id']) =="" ) {
    echo 'encoutered log in error TRY_AGAIN';
    header("Location: ../login.php");
}
  }
$target_dir = "upload/";
$Username = $_SESSION['First_name'];
$name = $_FILES['file']['name'];
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["upload"])) {

  if (empty($_FILES["file"]["tmp_name"])){
    echo "<h1 style='color: red; text-align: center;'>File is not set.</h1>";
    $uploadOk = 0;
  }else{
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if($check !== false) {
    echo "<h1 style='color: red; text-align: center;'>File is an image - " . $check["mime"] . ".</h1>";
    $uploadOk = 1;
  } else {
    echo "<h1 style='color: red; text-align: center;'>File is not an image.</h1>";
    $uploadOk = 0;
  }
}
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "<h1 style='color: red; text-align: center;'>Sorry, file already exists.</h1>";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["file"]["size"] > 500000) {
  echo "<h1 style='color: red; text-align: center;'>Sorry, your file is too large.</h1>";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "<h1 style='color: red; text-align: center;'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</h1>";
  $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "<h1 style='color: red; text-align: center;'>Sorry, your file was not uploaded.</h1>";
  header('refresh: 3 javascript://history.go(-1)');
  // if everything is ok, try to upload file
} else {
  // Check if the image profile is already session_set
if ($_SESSION['uploadok'] == 0){
  // update the image
  $sql = "UPDATE images1 SET name='".$name."' WHERE ID_NUMBER='".$_SESSION['ID_Number']."'";
  if(mysqli_query($conn, $sql)){
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
      echo "<h1 style='color: red; text-align: center;'>"."The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded as your new profile picture."."</h1>";
    } else {
      echo "<h1 style='color: red; text-align: center;'>Sorry, there was an error uploading your Image.</h1>";
  }} else {
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
  }
}else {
  // insert the first time image
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    $query = "insert into images1(name, Username, ID_NUMBER) values('".$name."', '".$_SESSION['First_name']."', '".$_SESSION['ID_Number']."')";
    mysqli_query($conn,$query);
    echo "<h1 style='color: red; text-align: center;'>"."The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded as your new profile picture."."</h1>";
    header('refresh: 3 javascript://history.go(-1)');
  } else {
    echo "<h1 style='color: red; text-align: center;'>Sorry, there was an error uploading your Image.</h1>";
    header('refresh: 3 javascript://history.go(-1)');
  }
}
}

?><!--  -->