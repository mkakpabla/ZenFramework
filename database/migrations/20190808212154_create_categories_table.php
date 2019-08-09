<?php

use Phinx\Migration\AbstractMigration;

class CreateCategoriesTable extends AbstractMigration
{

    public function change()
    {
        $this->table('categories')
            ->addColumn('title', 'string')
            ->addColumn('slug', 'string')
            ->create();
    }
}
