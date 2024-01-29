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
        $users = User::where('role', 'admin')->get();
        $notifs = Notification::all();
        foreach ($notifs as $item) {
            foreach ($users as $key => $value) {
                NotificationUser::factory()->create([
                    'user_id'           => $value->id,
                    'notification_id'   => $item->id,
                ]);
            }
        }
    }
}
