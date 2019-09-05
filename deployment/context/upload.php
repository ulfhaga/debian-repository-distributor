
<?php
ini_set('memory_limit', '1024M');
require 'bootstrap.php';
use DebToox\Service\RepositoryHandler;
use DebToox\Service\RequestValidation;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $repotype = $_POST["repotype"];
        $formatter = $_POST["formatter"];
        $requestValidation = new RequestValidation();
        if (!$requestValidation->isRepoTypeValid($repotype)) {
            http_response_code(404);
            throw new Exception("Wrong repository type");
        }
        $suit = $_POST["suit"];
        if (!$requestValidation->isSuitValid($suit)) {
            http_response_code(404);
            throw new Exception("Wrong repository suit");
        }
        $isUploadFileValid=$requestValidation->isUploadFileValid($_FILES);
        if (!$isUploadFileValid) {
            http_response_code(404);
            throw new Exception("Upload file not valid");
        }
        $file_tmp  = $_FILES['package']['tmp_name'];
        $file_name = $_FILES['package']['name'];
        $repositoryHandler = new RepositoryHandler();
        $repositoryHandler->moveFileToRepository($repotype, $suit, $file_name, $file_tmp);
        $repositoryHandler->updateRepository();
        
      
        if ($formatter == 'json') {
            echo  "{\"code\": 200,\"message\": \"File uploaded\"}";
        } else {
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

         <?php echo "The file " . "$fileName" . " has been uploaded." . "<br />"; ?>
        <button onclick="goBack()">Go Back</button>
        </body>
        </html>
<?php
        }
    } catch (Exception $e) {
        if ($formatter == 'json') {
            echo  "{\"code\": " . http_response_code() . "\"message\": \"File uploaded\"}";
        } else {
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
<?php echo 'ExceptionMessage: ' .$e->getMessage(); ?>
        <button onclick="goBack()">Go Back</button>
        </body>
        </html>
        <?php
        }
    }
}
?>