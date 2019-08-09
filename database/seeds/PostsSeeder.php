<?php


use Faker\Factory;
use Phinx\Seed\AbstractSeed;

class PostsSeeder extends AbstractSeed
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

        for ($i = 1; $i < 5; $i++) {
            $this->table('posts')
                ->insert([
                    'title' => $faker->sentence,
                    'slug' => $faker->slug,
                    'content' => $faker->text,
                    'category_id' => rand(1, 2)
                ])
                ->save();
        }
    }
}
