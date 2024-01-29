<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\NotificationUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $notifs = Notification::all();
        foreach ($notifs as $item) {
            NotificationUser::factory()->create([
                'user_id'           => $users->random('id'),
                'notification_id'   => $item->Id,
            ]);
        }
    }
}
