<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateDevicesAddTenantId extends Migration
{
    public function up()
    {
        // Add tenant_id column after device_type_id
        $fields = [
            'tenant_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'device_type_id',
            ],
        ];

        $this->forge->addColumn('devices', $fields);
        // Add foreign key to tenants
        $this->forge->addForeignKey('tenant_id', 'tenants', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        // Drop foreign key then column
        $this->forge->dropForeignKey('devices', 'tenant_id');
        $this->forge->dropColumn('devices', 'tenant_id');
    }
}
