<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::query()->find(1);
        $user2 = User::query()->find(2);

        $userQuery = User::query()->inRandomOrder()->limit(3);

        $user1->incomingConnections()->attach($userQuery->whereKeyNot($user1)->get());
        $user1->outgoingConnections()->attach($userQuery->whereKeyNot($user2)->get());

        $user2->incomingConnections()->attach($userQuery->whereKeyNot($user2)->get());
        $user2->outgoingConnections()->attach($userQuery->whereKeyNot($user2)->get());
    }
}
