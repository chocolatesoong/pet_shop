<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDriverIdToOrderTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('order',[
            'driver_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'null' => true,
                'default' => null,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('order','driver_id');
    }
}
