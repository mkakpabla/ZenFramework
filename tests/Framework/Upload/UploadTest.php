<?php


namespace Tests\Framework\Upload;


use Framework\Upload\Upload;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UploadedFileInterface;

class UploadTest extends TestCase
{

    /**
     * @var Upload
     */
    private $upload;

    protected function setUp(): void
    {
        $this->upload = new Upload('/tests');
    }

    public function testUpload()
    {
        $uploadedFile = $this->getMockBuilder(UploadedFileInterface::class)->getMock();

        $uploadedFile->expects($this->any())
            ->method('getClientFilename')
            ->willReturn('demo.jpg');
        $uploadedFile->expects($this->once())
            ->method('moveTo')
            ->with($this->equalTo('/tests/'. sha1('demo').'.jpg'));

        $this->assertEquals('/tests/'. sha1('demo').'.jpg', $this->upload->upload($uploadedFile));
    }

}