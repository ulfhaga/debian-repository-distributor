
<?php
ini_set('memory_limit', '1024M');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Upload Debian package</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<h1>
    Result of uploading a Debian package
</h1>
<body>

<script>
function goBack() {
  window.history.back();
}
</script>


<?php

function updateRepository()
{
    $command =  "/usr/local/bin/debrepo";
    shell_exec($command);
}

function moveFileToRepository($repoType, $suit, $fileName, $file_tmp)
{
    $firstChar = substr($fileName, 0, 1);
    $pool = '/var/local/apt/debtoox/pool' . DIRECTORY_SEPARATOR .  $suit . DIRECTORY_SEPARATOR . $repoType . DIRECTORY_SEPARATOR . $firstChar . DIRECTORY_SEPARATOR ;

    if (!is_writable($pool)) {
        var_dump(http_response_code(500));
        echo("The folder pool is not writable. ");
    }


    if (move_uploaded_file($file_tmp, $pool . "$fileName")) {
        echo "The file " . "$fileName" . " has been uploaded." . "<br />";
    } else {
        var_dump(http_response_code(500));
        echo "Sorry, there was an error uploading your file." . "<br />";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $repotype = $_POST["repotype"];
    if ($repotype != 'main' && $repotype != 'contrib' && $repotype != 'non-free' && $repotype != 'test') {
        var_dump(http_response_code(404));
        exit("Wrong type of repository. ");
    }

    $suit = $_POST["suit"];
    if ($suit != 'stable' && $suit != 'unstable') {
        var_dump(http_response_code(404));
        exit("Wrong type of repository suit. ");
    }

    if (isset($_FILES['package']) && $_FILES["package"]["error"] == 0) {
        $uploadOk  = 1;
        $errors    = array();
        $file_name = $_FILES['package']['name'];
        $file_size = $_FILES['package']['size'];
        $file_tmp  = $_FILES['package']['tmp_name'];
        $file_type = $_FILES['package']['type'];


        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $expansion_packages = array(
            "deb"
        );

        if (empty($file_tmp)) {
            $errors = 'Error empty can not be uploaded.';
            $log_message =  "Error Empty file_tmp" .
            $_FILES["package"]['name'] . " " .
            $_FILES["package"]['tmp_name'] . " " .
            $_FILES["package"]['size'] . " " .
            $_FILES['package']['error'] ;
        } else {
            if (in_array($file_ext, $expansion_packages) === false) {
                $errors = 'Extension not allowed, please choose a Debian package file.';
            } else {
                if ($file_size > 209715200) {
                    $errors = 'File size must be less than 200 MB';
                }
            }
        }

        if (empty($errors) == true) {
            moveFileToRepository($repotype, $suit, $file_name, $file_tmp);
            updateRepository();
        } else {
            print_r($errors);
            var_dump(http_response_code(404));
        }
    } else {
        print_r("Wrong file extension. Must be deb extension. " . $_FILES["package"]["error"]);
        var_dump(http_response_code(404));
    }
}
?>

<button onclick="goBack()">Go Back</button>

</body>
</html>
