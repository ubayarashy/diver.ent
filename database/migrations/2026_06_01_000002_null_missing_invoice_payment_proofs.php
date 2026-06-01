<?php

use App\Models\Invoice;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    public function up(): void
    {
        Invoice::query()
            ->whereNotNull('payment_proof')
            ->each(function (Invoice $invoice) {
                if (! Storage::disk('public')->exists($invoice->payment_proof)) {
                    $invoice->update(['payment_proof' => null]);
                }
            });
    }

    public function down(): void
    {
        // Irreversible data cleanup
    }
};
