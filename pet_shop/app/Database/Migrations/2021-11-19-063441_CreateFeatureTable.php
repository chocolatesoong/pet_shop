<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFeatureTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'feature_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => true,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ],
            'pic' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
                'unique' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME'
            ],
        ]);

        $this->forge->addPrimaryKey('feature_id');

        $this->forge->createTable('feature');
    }

    public function down()
    {
        $this->forge->dropTable('feature');
    }
}
