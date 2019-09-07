<?php


namespace Framework\Upload;

use Psr\Http\Message\UploadedFileInterface;

class Upload
{

    /***
     * The file path store
     * @var string
     */
    protected $path = 'uploads';

    /***
     * @var bool
     */
    protected $renameFile = true;

    /***
     * Upload constructor.
     * @param string|null $path
     */
    public function __construct(?string $path = null)
    {
        if (!is_null($path)) {
            $this->path = $path;
        }
    }

    /***
     * @param UploadedFileInterface $file: le fichier à sauvegarder
     * @param string|null $oldFilePath: le fichier à supprimer
     * @return string: le chemin du fichier sauvegarder
     * @throws \Exception
     */
    public function upload(UploadedFileInterface $file, ?string $oldFilePath = null)
    {
        $fileName = $file->getClientFilename();
        $targetPath = $this->getTargetPath($fileName);
        $this->fileExist($targetPath);
        $this->delete($oldFilePath);
        $this->pathExist($targetPath);
        $file->moveTo($targetPath);
        return $targetPath;
    }

    /***
     * Rename the file
     * @param string $targetPath
     * @return string
     */
    private function renameFile(string $targetPath)
    {
        $pathInfo = pathinfo($targetPath);
        $fileName = strtoupper(md5(uniqid($pathInfo['filename'], true)));
        return $pathInfo['dirname'] . '/' . $fileName . '.' . $pathInfo['extension'];
    }

    /***
     * Verifie if the file exists
     * @param string $file
     * @throws \Exception
     */
    private function fileExist(string $file)
    {
        if (file_exists($file)) {
            throw new FileExistException();
        }
    }

    /***
     * Verifie if the path exist if not create it
     * @param string $targetPath
     */
    private function pathExist(string $targetPath): void
    {
        $dirname = pathinfo($targetPath, PATHINFO_DIRNAME);
        if (!file_exists($dirname)) {
            mkdir($dirname, 777, true);
        }
    }

    /***
     * Delete the file
     * @param string|null $oldFilePath
     */
    private function delete(?string $oldFilePath): void
    {
        if ($oldFilePath) {
            $file = getcwd() . $oldFilePath;
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

    /***
     * Return the file path
     * @param string $fileName
     * @return string
     */
    private function getTargetPath(string $fileName): string
    {
        $dirname = getcwd() . DIRECTORY_SEPARATOR . $this->path . DIRECTORY_SEPARATOR;
        $targetPath = $this->renameFile ? $this->renameFile($dirname . $fileName) : $dirname .  $fileName;
        return $targetPath;
    }
}
