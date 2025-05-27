<?php

namespace App\Models;

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
class UploudImage
{

    private $cloudinary;
    private $config;
    public function __construct()
    {
        $this->config = new Configuration(getenv("CLOUDINARY_URL"));
        $this->cloudinary = new Cloudinary($this->config);
    }

    public function uploud($file){
        $result = $this->cloudinary->uploadApi()->upload(
            $file->getTempName(),
            [
                "folder" => "PerpustakaanXyz/books"
            ]
        );
        return $result;
    }

}
