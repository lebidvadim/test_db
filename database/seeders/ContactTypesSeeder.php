<?php

namespace Database\Seeders;

use App\Models\ContactType;
use Illuminate\Database\Seeder;

class ContactTypesSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'phone',
            'email',
            'address',
        ];

        foreach ($types as $type) {
            ContactType::firstOrCreate(['name' => $type]);
        }
    }
}
