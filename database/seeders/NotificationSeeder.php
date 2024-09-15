<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $users->each(function ($user) {
            $user->notifications()->create([
                'title' => 'New Notification',
                'description' => 'This is a new notification',
            ]);
        });
    }
}
