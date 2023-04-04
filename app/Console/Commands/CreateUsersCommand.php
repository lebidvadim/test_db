<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserContact;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создать пользователя';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $data = [
            [
                'name' => 'Vasia',
                'email' => 'test@test.ua',
                'password' => '123123',
                //'avatar' => '', Тут ссылка на аватарку из Storage
                'role' => 2, // 1 - manager | 2 - client
                'contacts' => [
                    //type: 1 - phone | 2 - email | 3 - address
                    ['contact_type_id' => 1,'value' => '+380985773019'],
                    ['contact_type_id' => 3,'value' => 'Україна, Київ. ул. Пушкина'],
                ]
            ],
            [
                'name' => 'Petro',
                'email' => 'test@test1.ua',
                'password' => '12341234',
                //'avatar' => '', Тут ссылка на аватарку из Storage
                'role' => 1, // 1 - manager | 2 - client
                'contacts' => [
                    //type: 1 - phone | 2 - email | 3 - address
                    ['contact_type_id' => 1,'value' => '+380985773010'],
                    ['contact_type_id' => 3,'value' => 'Україна, Київ. ул. Шевченка'],
                ]
            ]
        ];
        $roles = Role::all()->pluck('name', 'id')->toArray();

        foreach ($data as $user) {
            $newUser = User::firstOrCreate([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);

            $newUser->syncRoles([$roles[$user['role']]]);
            $user['contacts'][] = [
                'contact_type_id' => 2,'value' => $user['email']
            ];
            $contacts = [];

            foreach ($user['contacts'] as $userContact){
                $contacts[] = new UserContact($userContact);
            }

            $newUser->contacts()->saveMany($contacts);
        }
    }
}
