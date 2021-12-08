<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDriverTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'driver_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'password_hash' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => false,
            ]
        ]);

        $this->forge->addPrimaryKey('driver_id');

        $this->forge->createTable('driver');
    }

    public function down()
    {
        $this->forge->dropTable('driver');
    }
}
