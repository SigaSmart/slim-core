<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core;

use Psr\Http\Message\UploadedFileInterface;

/**
 * Description of UploadAbstract
 *
 * @author caltj
 */
class UploadAbstract {

    private $filename;
    private $uploadedFile;
    private $directory;

    public function __construct(UploadedFileInterface $uploadedFile) {

        $this->uploadedFile = $uploadedFile;
        $this->directory = $_SERVER['DOCUMENT_ROOT'];
    }

    /**
     * Moves the uploaded file to the upload directory and assigns it a unique name
     * to avoid overwriting an existing uploaded file.
     *
     * @param string $directory directory to which the file is moved
     * @param UploadedFile $uploaded file uploaded file to move
     * @return string filename of moved file
     */
    public function moveUploadedFile() {
        if ($this->uploadedFile->getError() === UPLOAD_ERR_OK):
            $extension = pathinfo($this->uploadedFile->getClientFilename(), PATHINFO_EXTENSION);

            $basename = bin2hex(random_bytes(8));
           
            $filename = sprintf('%s.%0.8s', $basename, $extension);

            $dirUploadBase = $this->_mkDir(sprintf("%s/uploads/images", $this->directory));

            $dirUploadAno = $this->_mkDir(sprintf("%s/%s", $dirUploadBase, date("Y")));

            $dirUploadMes = $this->_mkDir(sprintf("%s/%s", $dirUploadAno, date("m")));

            $this->filename = str_replace("/", DIRECTORY_SEPARATOR, sprintf("%s/%s", $dirUploadMes, $filename));

            $this->uploadedFile->moveTo($this->filename);

            return sprintf("uploads/images/%s/%s/%s", date("Y"), date("m"), $filename);
        endif;
        return "";
    }

    private function _mkDir($Directory) {
        $Dir = str_replace("/", DIRECTORY_SEPARATOR, $Directory);
        if (!is_dir($Dir)):
            mkdir($Dir);
        endif;
        return $Dir;
    }

}
