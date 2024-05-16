<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Tenant::factory()->create([
            'id' => 'ae694f47-75b8-405c-84eb-5de03dec36a6',
        ]);

        Tenant::factory(10)->create();
    }

}
