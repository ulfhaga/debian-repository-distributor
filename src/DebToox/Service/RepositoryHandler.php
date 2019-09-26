<?php

namespace DebToox\Service;

use Exception;

class RepositoryHandler
{
    public function __construct()
    {
    }

    public function updateRepository()
    {
        $command =  "/usr/local/bin/debrepo";
        $output=shell_exec($command);
        if ($output != 0) {
            throw new Exception("Function shell_exec failed.", 500);
        }
    }

    public function moveFileToRepository($repoType, $suit, $fileName, $file_tmp)
    {
        $firstChar = substr($fileName, 0, 1);
        $pool = '/var/local/apt/debtoox/pool' . DIRECTORY_SEPARATOR .  $suit . DIRECTORY_SEPARATOR . $repoType . DIRECTORY_SEPARATOR . $firstChar . DIRECTORY_SEPARATOR ;

        if (!is_writable($pool)) {
            throw new Exception("The folder pool is not writable.", 500);
        }

        if (!move_uploaded_file($file_tmp, $pool . "$fileName")) {
            throw new Exception("Sorry, there was an error uploading your file.", 500);
        }
    }
}
