<?php
namespace DebToox\Service;

use Exception;

class RequestValidation
{
    public function __construct()
    {
    }

    public function isRepoTypeValid($repotype)
    {
        return ($repotype == 'main' || $repotype == 'contrib' || $repotype == 'non-free' || $repotype == 'test') ;
    }

    public function isSuitValid($suit)
    {
        return ($suit == 'stable' || $suit == 'unstable');
    }

    public function isUploadFileValid($files)
    {
        $status = false;

        if (isset($files['package']) && $files["package"]["error"] == 0) {
            $file_name = $_FILES['package']['name'];
            $file_size = $_FILES['package']['size'];
            $file_tmp  = $_FILES['package']['tmp_name'];
            $file_type = $_FILES['package']['type'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $expansion_packages = array("deb");
            if (!empty($file_tmp)) {
                if (in_array($file_ext, $expansion_packages) === false) {
                    $errors = 'Extension not allowed, please choose a Debian package file.';
                    throw new Exception($errors, 404);
                } else {
                    if ($file_size > 209715200) {
                        $errors = 'File size must be less than 200 MB';
                        throw new Exception($errors, 404);
                    } else {
                        $status = true;
                    }
                }
            } else {
                throw new Exception("Upload file missing", 404);
            }
        } else {
            throw new Exception("Upload file missing", 404);
        }
        return $status;
    }
}
