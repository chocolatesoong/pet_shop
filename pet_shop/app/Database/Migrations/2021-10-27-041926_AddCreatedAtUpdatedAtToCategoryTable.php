<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCreatedAtUpdatedAtToCategoryTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('category', [
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
