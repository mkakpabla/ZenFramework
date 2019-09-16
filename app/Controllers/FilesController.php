<?php
namespace App\Controllers;

use App\Models\File;
use App\Uploads\FileUpload;
use Framework\Controller;
use Psr\Http\Message\ServerRequestInterface;

class FilesController extends Controller
{


    /**
     * @return string
     * @Route('get', '/files', 'file.index')
     */
    public function index()
    {
        $files = $this->container->get(File::class)->all();
        return $this->render('files.index', compact('files'));
    }

    /**
     * @return string
     * @Route('get', '/files/create', 'file.create')
     */
    public function create()
    {
        return $this->render('files.create');
    }

    /**
     * @param ServerRequestInterface $request
     * @return string
     * @Route('post', '/files/store', 'file.store')
     */
    public function store(ServerRequestInterface $request)
    {
        $fileUpload = new FileUpload();
        $file = $fileUpload->blob($request->getUploadedFiles()['file']);
        $this->container->get(File::class)->insert($file);
        return $this->redirect('file.index');
    }
}
