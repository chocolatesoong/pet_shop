<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOauthIdColumnToCustomerTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('customer', [
            'oauth_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique' => true,
                'default' => null,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('customer', 'oauth_id');
    }
}
