<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleToDriverTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('driver',[
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['Admin', 'Driver'],
                'default' => 'Driver',
                'null' =>false,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('driver','role');
    }
}
