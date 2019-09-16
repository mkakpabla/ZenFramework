<?php


namespace Tests\Framework\Database;

use Framework\Database\Query;
use PHPUnit\Framework\TestCase;

class InsertTest extends TestCase
{


    public function testInsertQuery()
    {
        $query = (new Query())->table('posts')
            ->insert([
                'title' => 'titre de test',
                'slug' => 'slug-test',
                'content' => 'contenu de test',
                'cover' => 'cover de test',
                'category_id' => 1,
            ]);
        $this->assertEquals(
            "INSERT INTO posts SET title = ?, slug = ?, content = ?, cover = ?, category_id = ?",
            (string)$query
        );
    }
}
