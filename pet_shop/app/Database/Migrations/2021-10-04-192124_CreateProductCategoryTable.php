<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductCategoryTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'product_category_id' => [
                'type' => 'INT' ,
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'product_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'null' => false,
            ],
            'category_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ]
        ]);

        $this->forge->addPrimaryKey('product_category_id');

        $this->forge->createTable('product_category');
    }

    public function down()
    {
        $this->forge->dropTable('product_category');
    }
}
