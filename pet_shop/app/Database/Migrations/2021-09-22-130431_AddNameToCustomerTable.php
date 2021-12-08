<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNameToCustomerTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('customer', [
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('customer', 'name');
    }
}
