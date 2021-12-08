<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPasswordToStaffTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('staff', [
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
        ],);
    }

    public function down()
    {
        //
    }
}
