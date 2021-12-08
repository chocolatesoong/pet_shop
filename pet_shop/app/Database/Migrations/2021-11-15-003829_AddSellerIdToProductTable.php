<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSellerIdToProductTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('product', [
            'seller_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => false
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('product', 'seller_id');
    }
}
