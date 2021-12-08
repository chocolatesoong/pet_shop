<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCompletedAtToOrderTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('order', [
            'completed_at' => [
                'type' => 'datetime',
                'default' => null,
                'null' => true,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('order', 'completed_at');
    }
}
