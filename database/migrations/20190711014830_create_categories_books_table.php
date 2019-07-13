<?php

use Phinx\Migration\AbstractMigration;

class CreateCategoriesBooksTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible Migrations using this method.
     *
     * More information on writing Migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->table('categories_books')
            ->addColumn('categories_id', 'integer')
            ->addColumn('books_id', 'integer')
            ->addForeignKey('books_id', 'books', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('categories_id', 'categories', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->create();

    }
}
