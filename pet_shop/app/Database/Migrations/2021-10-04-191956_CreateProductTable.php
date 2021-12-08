<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'product_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'product_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'product_description' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'default' => null
            ],
            'product_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
                'default' => 0.00
            ],
            'stock_quantity' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'null' => false,
                'default' => 0
            ],
            'weight' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => null
            ],
            'birthday' => [
                'type' => 'DATE',
                'null' => true,
                'default' => null
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' =>100,
                'null' => true,
                'default' => null
            ],
            'colour' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'default' => null
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['Pet', 'Non-Pet'],
                'null' => false,
                'default' => 'Pet'
            ],
            'available' => [
                'type' => 'ENUM',
                'constraint' => ["In Stock", "Out Of Stock"],
                'null' => false,
                'default' => "In Stock"
            ],
            'gender' => [
                'type' => 'ENUM',
                'constraint' => ['Male', 'Female', 'NotApplicable'],
                'null' => false,
                'default' => 'NotApplicable'
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ]
        ]);

        $this->forge->addPrimaryKey('product_id');

        $this->forge->createTable('product');
    }

    public function down()
    {
        $this->forge->dropTable('product');
    }
}
