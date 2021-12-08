<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddActivateToCustomerTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('customer', [
            'activate' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => false
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('customer', 'activate');
    }
}
