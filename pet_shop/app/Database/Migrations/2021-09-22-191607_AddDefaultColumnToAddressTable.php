<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDefaultColumnToAddressTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('address',[
            'default' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('address','default');
    }
}
