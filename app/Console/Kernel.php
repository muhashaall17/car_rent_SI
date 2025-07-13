<?php

namespace App\Console;

use App\Models\Mobil;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Rental;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            // Log untuk melacak apakah scheduler berjalan
            Log::info('Scheduler is running');

            // Ambil rental yang ongoing dan tanggal_kembali sudah lewat
            $rentalSelesai = Rental::where('status', 'ongoing')
                ->where('tanggal_kembali', '<', now())
                ->get();

            Log::info('Jumlah rental yang selesai: ' . $rentalSelesai->count());

            foreach ($rentalSelesai as $rental) {
                // Log rental yang diperbarui
                Log::info('Rental ID yang diperbarui: ' . $rental->id);

                // Ubah status rental menjadi selesai
                $rental->update(['status' => 'completed']);

                // Ubah status mobil terkait menjadi available
                $rental->mobil->update(['status' => 'available']);

                // Log perubahan status mobil
                Log::info('Mobil ID ' . $rental->mobil->id_mobil . ' status updated to available');
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
