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

    private $file = [];


    /***
     * @param UploadedFileInterface $file: le fichier à sauvegarder
     * @param string|null $oldFilePath: le fichier à supprimer
     * @return string: le chemin du fichier sauvegarder
     * @throws \Exception
     */
    final public function upload(UploadedFileInterface $file, ?string $oldFilePath = null)
    {
        $fileName = $file->getClientFilename();
        $targetPath = $this->getTargetPath($fileName);
        $this->fileExist($targetPath);
        $this->delete($oldFilePath);
        $this->pathExist($targetPath);
        $file->moveTo($targetPath);
        $path = $this->path . DIRECTORY_SEPARATOR . pathinfo($targetPath, PATHINFO_BASENAME);
        return $path;
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
    final public function delete(?string $oldFilePath): void
    {
        if ($oldFilePath) {
            $fileName = pathinfo($oldFilePath, PATHINFO_BASENAME);
            $file = getcwd() . DIRECTORY_SEPARATOR. $this->path . DIRECTORY_SEPARATOR .$fileName;
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
