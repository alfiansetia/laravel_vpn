<?php

namespace App\Console\Commands;

use App\Mail\MonitorVpnMail;
use App\Models\Vpn;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class MonitorExpiredVpn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:monitor-expired-vpn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Melakukan Monitor Expired VPN';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $vpns = Vpn::query()
            ->with('server')
            ->where('is_active', 'yes')
            ->where('expired', '<=', date('Y-m-d'))
            ->get();
        try {
            foreach ($vpns as $value) {
                $value->update([
                    'is_active' => 'no'
                ]);
            }
            $to = env('MAIL_BACKUP_NOTIFICATION_ADDRESS');
            if (empty($to)) {
                throw new Exception('Error : MAIL_BACKUP_NOTIFICATION_ADDRESS !');
            }
            Mail::to($to)->send(new MonitorVpnMail($vpns->toArray()));
            $this->info('Monitor Sukses');
            return Command::SUCCESS;
        } catch (\Throwable $th) {
            $this->error('Monitor Gagal : ' . $th->getMessage());
            return Command::FAILURE;
        }
    }
}
