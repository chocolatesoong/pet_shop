<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductPicTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'product_pic_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'product_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 10,
                'null' => false,
            ],
            'pic' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ]
        ]);

        $this->forge->addPrimaryKey('product_pic_id');

        $this->forge->createTable('product_pic');
    }

    public function down()
    {
        $this->forge->dropTable('product_pic');
    }
}
