<?php


namespace App\Controllers;

use App\Uploads\GalleryUpload;
use Framework\Controller;
use Framework\Upload\File;
use Psr\Http\Message\ServerRequestInterface;

class UploadController extends Controller
{

    /**
     * @Route('get', '/galery', 'galery.index')
     * @return string
     */
    public function index()
    {
        return $this->render('upload');
    }

    /**
     * @Route('post', '/galery/upload', 'upload')
     * @param ServerRequestInterface $request
     * @return string
     * @throws \Exception
     */
    public function store(ServerRequestInterface $request)
    {
        $u = new GalleryUpload();
        $file = $request->getUploadedFiles()['name'];
        $r = File::store($file);
        dd($r);
    }
}
