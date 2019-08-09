<?php


use Faker\Factory;
use Phinx\Seed\AbstractSeed;

class CategoriesSeeder extends AbstractSeed
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

        for ($i = 1; $i <= 2; $i++) {
            $this->table('categories')
                ->insert([
                    'title' => $faker->sentence,
                    'slug' => $faker->slug,
                ])
                ->save();
        }
    }
}
