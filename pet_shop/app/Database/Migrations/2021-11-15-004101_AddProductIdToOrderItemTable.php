<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProductIdToOrderItemTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('order_item', [
            'product_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => false
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('order_item', 'product_id');
    }
}
