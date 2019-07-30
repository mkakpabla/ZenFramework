<?php

namespace Test\Components\Validation;

use Components\Validation\Validation;
use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{

    public function testRequired()
    {
        $data = [

        ];
        $validator = new Validation([
            'title'  => 'required|notEmpty|alpha',
            'author' => 'required|notEmpty'
            ]);
        $validator->validate($data);
        $this->assertContains('Le champ title est requis', $validator->errors());
        $this->assertContains('Le champ author est requis', $validator->errors());
        $this->assertEquals(false, $validator->isValid());
    }

    public function testNotEmpty()
    {
        $data = [
            'author' => '',
            'title' => 'Michel'
        ];
        $validator = new Validation([
            'title'  => 'required|notEmpty|alpha',
            'author' => 'required|notEmpty'
        ]);
        $validator->validate($data);
        $this->assertContains('Le champ author ne peut être vide', $validator->errors());
        $this->assertEquals(false, $validator->isValid());
    }

    public function testInteger()
    {
        $data = [
            'author' => 'Michel',
            'title' => 'Michel',
            'price' => 'toto'
        ];
        $validator = new Validation([
            'title'  => 'required|notEmpty|alpha',
            'author' => 'required|notEmpty',
            'price' => 'required|notEmpty|integer'
        ]);
        $validator->validate($data);
        $this->assertContains('le price doit être un entier(Ex: 1234)', $validator->errors());
        $this->assertEquals(false, $validator->isValid());
    }

    public function testIsValid()
    {
        $data = [
            'author' => 'Germaine',
            'title' => 'Michel'
        ];
        $validator = new Validation([
            'title'  => 'required|notEmpty|alpha',
            'author' => 'required|notEmpty'
        ]);
        $validator->validate($data);
        $this->assertEquals(true, $validator->isValid());
    }

    public function testAlpha()
    {
        $data = [
            'author' => 'Germaine',
            'title' => 11111
        ];
        $validator = new Validation([
            'title'  => 'required|notEmpty|alpha',
            'author' => 'required|notEmpty'
        ]);
        $validator->validate($data);
        $this->assertContains('Le title  n\'est pas valide(Alphabétique)', $validator->errors());
    }
}
