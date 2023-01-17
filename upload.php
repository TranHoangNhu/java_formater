<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $beforeDot = substr($_FILES['fileToUpload']['name'], 0, strpos($_FILES['fileToUpload']['name'], '.'));
    $afterDot = end(explode('.', $_FILES['fileToUpload']['name']));
    $new_file = $beforeDot . '.' . $afterDot;
    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], 'uploads/' . $new_file);
    header('location: ./readfile.php');
}
