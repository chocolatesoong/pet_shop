<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnSalesPriceToProductTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('product', [
            'sales_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
                'default' => 0.00
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('product', 'sales_price');
    }
}
