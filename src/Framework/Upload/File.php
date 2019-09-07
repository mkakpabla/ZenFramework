<?php
declare(strict_types=1);
namespace Framework\Upload;

use Psr\Http\Message\UploadedFileInterface;

class File
{

    public static function store(UploadedFileInterface $file, ?string $oldFilePath = null)
    {
        $upload = new Upload();
        return $upload->upload($file, $oldFilePath);
    }
}
