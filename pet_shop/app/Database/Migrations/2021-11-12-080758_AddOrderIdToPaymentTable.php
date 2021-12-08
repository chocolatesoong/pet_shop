<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOrderIdToPaymentTable extends Migration
{
	public function up()
	{
		$this->forge->addColumn('payment', [
			'order_id' => [
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => true
			]
		]);
	}

	public function down()
	{
		$this->forge->dropColumn('payment','order_id');
	}
}
