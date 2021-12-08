<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRecipientNameAndContactOrderTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('order', [
            'recipient_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'recipient_contact' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('order', ['recipient_name, recipient_contact']);
    }
}
