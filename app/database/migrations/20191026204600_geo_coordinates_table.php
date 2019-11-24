<?php

use Phinx\Migration\AbstractMigration;

class GeoCoordinatesTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
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
        $table = $this->table('geo_coordinates');
        $table->addColumn('coords_from', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('coords_destination', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('order_id', 'integer')
            ->addForeignKey(['order_id'],
                'orders',
                ['id'],
                ['delete' => 'CASCADE', 'update' => 'CASCADE', 'constraint' => 'fk_geo_coordinate_to_order'])
            ->create();

    }
}
