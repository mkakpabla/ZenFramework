<?php

use Phinx\Migration\AbstractMigration;

class CreatePostsTable extends AbstractMigration
{

    public function change()
    {
        $this->table('posts')
            ->addColumn('title', 'string')
            ->addColumn('slug', 'string')
            ->addColumn('content', 'text')
            ->addColumn('cover', 'string')
            ->addColumn('category_id', 'integer')
            ->addForeignKey('category_id', 'categories', 'id')
            ->create();
    }
}
