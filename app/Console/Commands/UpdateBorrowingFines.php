<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Borrowing;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateBorrowingFines extends Command
{
    protected $signature = 'borrowings:update-fines';
    protected $description = 'Update late days and fines for overdue borrowings';

    public function handle()
    {
        $now = Carbon::now();

        // Ambil peminjaman yang belum dikembalikan dan due_date sudah lewat
        $borrowings = Borrowing::whereNull('return_date')
            ->whereIn('status', ['Borrowed', 'Late'])
            ->whereNotNull('due_date')
            ->where('due_date', '<', $now)
            ->get();

        $this->info("Found {$borrowings->count()} overdue borrowings.");

        foreach ($borrowings as $borrowing) {
            $due = Carbon::parse($borrowing->due_date);

          
            $lateDays = $due->startOfDay()->diffInDays($now->startOfDay());
            $fine = (int) $lateDays * (int) 2000;

            $borrowing->update([
                'late_days' => $lateDays,
                'fine_total' => $fine,
                'fine_remaining' => $fine,
                'status' => 'Late',
            ]);

            $this->info("Borrowing ID {$borrowing->id}: late_days={$lateDays}, fine={$fine}");
            Log::info("Borrowing fines updated", [
                'borrowing_id' => $borrowing->id,
                'late_days' => $lateDays,
                'fine' => $fine
            ]);
        }

        $this->info("Fines update finished.");
    }
}
