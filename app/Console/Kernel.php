<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Peminjaman;
use App\Models\Denda;
use App\Models\DetailPeminjaman;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $peminjaman = Peminjaman::whereDate('batas_peminjaman', '<', Carbon::now()->toDateString())->get();

            if ($peminjaman->isNotEmpty()) {
                $peminjaman->each(function ($data) {
                    $d = $data->where('jatuh_tempo', false);
                    if ($d->get()->isNotEmpty()) {
                        $d->update([
                            'jatuh_tempo' => true
                        ]);

                        $id_buku = DetailPeminjaman::where('id_peminjaman', $data->id)->first()->id_buku;
                        $telat = Carbon::now()->diffInDays($data->batas_peminjaman);
                        Denda::create([
                            'id_user' => $data->id_user,
                            'id_buku' => $id_buku,
                            'telat' => $telat,
                            'total_denda' => $telat * 3000,
                        ]);
                    }
                });
            }

            $denda = Denda::all();

            foreach ($denda as $value) {
                $denda->update([
                    'telat' => $telat++,
                    'total_denda' => $telat++ * 3000
                ]);
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
