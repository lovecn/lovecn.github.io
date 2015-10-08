<?php
// up.php
if (empty($_FILES)) {
    exit('no file');
}

if ($_FILES['file']['error'] != 0) {
    exit('fail');
}

move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $_FILES['file']['name']);

echo 'ok';