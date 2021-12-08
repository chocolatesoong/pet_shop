<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyStaffTableToSeller extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('staff', [
            'staff_id' => [
                'name' => 'seller_id',
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true
            ]
        ]);
        $this->forge->renameTable('staff', 'seller');
    }

    public function down()
    {
        //
    }
}
