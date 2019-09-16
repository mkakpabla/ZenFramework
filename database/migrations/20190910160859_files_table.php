<?php

use Phinx\Migration\AbstractMigration;

class FilesTable extends AbstractMigration
{

    public function change()
    {
        $this->table('files')
            ->addColumn('name', 'string')
            ->addColumn('type', 'string')
            ->addColumn('size', 'integer')
            ->addColumn('content', 'blob')
            ->create();
    }
}
