<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeStatusOrderTable extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('order', [
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Waiting for Quotation', 'Waiting for Payment', 'Shipped', 'Completed'],
                'null' => false,
                'default' => 'Waiting for Quotation',
            ]
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('order', [
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Processing', 'Completed'],
                'null' => false,
                'default' => 'Processing'
            ]
        ]);
    }
}
