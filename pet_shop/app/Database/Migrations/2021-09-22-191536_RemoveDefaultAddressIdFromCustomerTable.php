<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveDefaultAddressIdFromCustomerTable extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('customer','default_address_id');
    }

    public function down()
    {
        $this->forge->addColumn('customer',[
            'default_address_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'default' => 0,
            ],
        ]);
    }
}
