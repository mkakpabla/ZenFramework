<?php


namespace Tests\Framework\Database;

use Framework\Database;
use Framework\Database\Query;
use PHPUnit\Framework\TestCase;

class UpdateTest extends TestCase
{

    public function testUpdateQuery()
    {
        $query = (new Query())->table('posts')
            ->update([
                'title' => 'titre de test',
                'slug' => 'slug-test',
            ]);
        $this->assertEquals("UPDATE posts SET title = ?, slug = ?", (string)$query);
    }


    public function testUpdateQueryWithWhere()
    {
        $query = (new Query())->table('posts')
            ->update([
            'title' => 'titre de test',
            'slug' => 'slug-test',
            ])->where(["title > ?" => 'titre', "id = ?" => 2]);
        $this->assertEquals(
            "UPDATE posts SET title = ?, slug = ? WHERE (title > 'titre') AND (id = '2')",
            (string)$query
        );
    }
}
