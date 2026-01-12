<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profile_uuid = Str::uuid();

        User::create([
            'uuid' => Str::uuid(),
            'profile_uuid' => $profile_uuid,
            'email' => 'admin@admin.com',
            'login' => 'admin@admin.com',
            'etat' => 'actif',
            'id_role' => 1,
            'role' => 'Admin',
            'password' => bcrypt('password123'),
            'codepartenaire' => 'LLV',
            'branche' => 'COM',
        ]);

        Profile::create([
            'uuid' => $profile_uuid,
            'nom' => 'Admin',
            'prenom' => 'Admin',
            'telephone' => '0000000000',
            'email' => 'admin@admin.com',
            'adresse' => 'Admin',
            'photo_url' => 'https://ui-avatars.com/api/?name=Admin',
            'role' => 'Admin',
            'codepartenaire' => 'LLV',
            'branche' => 'COM',
            'partenaire' => 'YAKO AFRICA',
            'codeagent' => 'AD-0001',
        ]);
    }
}
