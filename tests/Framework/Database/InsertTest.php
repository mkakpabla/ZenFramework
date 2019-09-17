<?php


namespace Tests\Framework\Database;

use Framework\Database\Query;
use PHPUnit\Framework\TestCase;

class InsertTest extends TestCase
{

    /**
     * @var \PDO
     */
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = new \PDO('sqlite::memory:', null, null, [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
    }


    public function testInsertQuery()
    {
        $query = (new Query($this->pdo))->table('posts')
            ->insert([
                'title' => 'titre de test',
                'slug' => 'slug-test',
            ]);
        $this->assertEquals(
            "INSERT INTO posts (title, slug) VALUES (?, ?)",
            (string)$query
        );
    }

    public function testInsertQueryWithExecute()
    {
        $this->pdo->exec('CREATE TABLE posts');
        $query = (new Query($this->pdo))->table('posts')
            ->insert([
                'title' => 'titre de test',
                'slug' => 'slug-test',
            ])
        ->execute();
        $this->assertEquals(
            "INSERT INTO posts SET title = ?, slug = ?",
            $query
        );
    }
}
