<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNameToStaffTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('staff', [
            'name' => [
                'type' => 'TEXT',
                'constraint' => '100',
                'null' => false,
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
