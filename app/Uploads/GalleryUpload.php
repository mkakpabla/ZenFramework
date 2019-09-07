<?php


namespace App\Uploads;

use Framework\Upload\Upload;

class GalleryUpload extends Upload
{
    protected $renameFile = true;

    protected $path = '/uploads';


}
