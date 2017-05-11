<?php
namespace AppBundle\MyService;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }
    
    public function upload(UploadedFile $file, $folder)
    {
        $this->targetDir = $this->targetDir.'/'.$folder;
         if (null === $file) {
            return;
        }
        $originalName = $file->getClientOriginalName();
        $name_array = explode('.', $originalName);
        $file_type = $name_array[sizeof($name_array) - 1];
        $valid_file_types = array('png', 'jpg', 'jpeg');
        if (in_array(strtolower($file_type), $valid_file_types)) {
            $fileName = sha1(uniqid(mt_rand(), true)) . '.' . $file->guessExtension();
             $file->move($this->targetDir, $fileName);
        } else {
            throw $this->createNotFoundException('extension image invalide.');
        }
        return $fileName;
    }
}