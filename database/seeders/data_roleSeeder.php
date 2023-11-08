<?php

namespace Database\Seeders;

use App\Models\roleModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class data_roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        roleModel::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['role' => 'admin'],
            ['role' => 'user']
        ];

        foreach ($data as $value) {
            roleModel::create(
                [
                    'role' => $value['role']
                ]
            );
        }
    }
}
