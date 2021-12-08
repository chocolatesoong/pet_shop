<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyColumnPicFromProductPicTable extends Migration
{
    public function up()
    {
        // $fields = [
        //     'pic' => [
        //         'constraint' => 1500,
        //     ]
        // ];
        // $this->forge->modifyColumn('product_pic', $fields);
        $this->forge->modifyColumn('product_pic', [
            'pic' => [
                'type' => 'VARCHAR',
                'constraint' => '1999',
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
