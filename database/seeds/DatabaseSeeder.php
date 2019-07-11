<?php


use App\Models\Category;
use Faker\Factory;
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
        $faker = Factory::create('fr_FR');
        $this->table('books')
            ->insert([
                'title' => $faker->catchPhrase,
                'slug' => $faker->slug(3),
                'author' => $faker->name,
                'summary' => $faker->paragraph()
            ])->save();

    }
}
