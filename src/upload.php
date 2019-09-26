
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
            throw new Exception("Wrong repository type", 404);
        }
        $suit = $_POST["suit"];
        if (!$requestValidation->isSuitValid($suit)) {
            throw new Exception("Wrong repository suit", 404);
        }
        $isUploadFileValid=$requestValidation->isUploadFileValid($_FILES);
        if (!$isUploadFileValid) {
            throw new Exception("Upload file not valid", 404);
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
            $httpResposeCode = $e->getCode();
            http_response_code($httpResposeCode);
            echo  "{\"code\": " . $httpResposeCode . "\"message\": \"File uploaded\"}";
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
        <?php echo 'Error message: ' . $e->getMessage() ?>
        <button onclick="goBack()">Go Back</button>
        </body>
        </html>
        <?php
        }
    }
}
?>