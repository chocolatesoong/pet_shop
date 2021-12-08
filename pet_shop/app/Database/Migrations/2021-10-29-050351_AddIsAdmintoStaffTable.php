<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsAdmintoStaffTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('staff', [
            'isAdmin' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => false
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('staff', 'isAdmin');
    }
}
