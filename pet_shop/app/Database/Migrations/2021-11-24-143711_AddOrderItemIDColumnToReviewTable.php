<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOrderItemIDColumnToReviewTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('review', [
            'order_item_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'unique' => true,
                'auto_increment' => false
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('review', 'order_item_id');
    }
}
