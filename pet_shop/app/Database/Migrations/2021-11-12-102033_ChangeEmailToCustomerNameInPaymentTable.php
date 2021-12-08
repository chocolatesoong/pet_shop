<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeEmailToCustomerNameInPaymentTable extends Migration
{
    public function up()
    {
        
        $this->forge->modifyColumn('payment', [
            'email' => [
            	'name' => 'customer_name',
                 'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ]
        ]);
    }
    

    public function down()
    {
        $this->forge->modifyColumn('payment','customer_name');
    }
}
