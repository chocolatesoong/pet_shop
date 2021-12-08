<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'order_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'customer_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'null' => false,
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'postcode' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'city' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'state' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'order_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
                'default' => 0.00,
            ],
            'total_fee' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
                'default' => 0.00
            ],
            'shipping_fee' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
                'default' => 0.00
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Processing', 'Completed'],
                'null' => false,
                'default' => 'Processing'
            ]
        ]);

        $this->forge->addPrimaryKey('order_id');

        $this->forge->createTable('order');
    }

    public function down()
    {
        $this->forge->dropTable('order');
    }
}
