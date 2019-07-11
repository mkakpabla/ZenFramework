<?php


use App\Models\Category;
use Phinx\Seed\AbstractSeed;

class DatabaseSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        for($i = 1; $i <= 5; $i++) {
            Category::create([
                'title' => 'Catégorie' . $i,
                'slug' => 'catégorie-'. $i
            ]);
        }

        for($i = 1; $i <= 10; $i++) {
            \App\Models\Book::create([
                'title' => 'Livre' . $i,
                'slug' => 'livre-'. $i,
                'author' => 'author-'. $i,
                'summary' => 'summary'. $i
            ]);
        }
    }
}
