<?php

namespace Test\Components\Validation;


use App\Validations\BookValidation;
use Components\Validation\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{

    public function testRequired()
    {
        $data = [

        ];
        $validator = (new Validator($data, BookValidation::class))->make();
        $this->assertContains('Le champ titre est requis', $validator->errors());
        $this->assertContains('Le champ auteur est requis', $validator->errors());
        $this->assertEquals(false, $validator->isValid());
    }

    public function testNotEmpty()
    {
        $data = [
            'author' => '',
            'title' => 'Michel'
        ];
        $validator = (new Validator($data, BookValidation::class))->make();
        $this->assertContains('Le champ auteur ne peut être vide', $validator->errors());
        $this->assertEquals(false, $validator->isValid());
    }

    public function testIsValid()
    {
        $data = [
            'author' => 'Germaine',
            'title' => 'Michel'
        ];
        $validator = (new Validator($data, BookValidation::class))->make();
        $this->assertEquals(true, $validator->isValid());
    }
}