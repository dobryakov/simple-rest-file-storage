<?php

//print_r($_REQUEST);
//print_r($_FILES);

$u = uniqid();
$source = $_FILES['file']['tmp_name'];
$e = getExtension(getFileMimeType($source));
$destination = __DIR__ . '/../files/' . $u . "." . $e;

move_uploaded_file($source, $destination);

echo $u . "." . $e . "\n";

// -------------------------------------------------

function getFileMimeType($file) {
    if (function_exists('finfo_file')) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $type = finfo_file($finfo, $file);
        finfo_close($finfo);
    } else {
        require_once 'upgradephp/ext/mime.php';
        $type = mime_content_type($file);
    }
    return $type;
}

function getExtension($type) {
    $a = [
       'image/png' => 'png',
       'image/jpeg' => 'jpg',
       'image/jpg' => 'jpg'
    ];
    if (array_key_exists($type, $a)) {
        return $a[$type];
    } else {
        return 'unknown';
    }
}
