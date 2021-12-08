<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTokenToCustomerTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('customer', [
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'default' => null
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('customer', 'token');
    }
}
