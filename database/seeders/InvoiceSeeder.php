<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            return;
        }

        Storage::disk('public')->makeDirectory('payment_proofs');

        foreach ($users as $user) {
            if (Invoice::where('user_id', $user->id)->exists()) {
                continue;
            }

            $demoProofPath = $this->createDemoProofFile($user->id);

            $rows = [
                [
                    'number' => 'INV-2026-001',
                    'description' => 'Website Development - Phase 1',
                    'amount' => 15000000,
                    'status' => 'lunas',
                    'due_date' => '2026-01-15',
                    'issue_date' => '2026-01-01',
                    'payment_proof' => $demoProofPath,
                ],
                [
                    'number' => 'INV-2026-002',
                    'description' => 'Social Media Management - March',
                    'amount' => 8500000,
                    'status' => 'diverifikasi',
                    'due_date' => '2026-02-20',
                    'issue_date' => '2026-02-01',
                    'payment_proof' => $demoProofPath,
                ],
                [
                    'number' => 'INV-2026-003',
                    'description' => 'Google Ads Campaign - May',
                    'amount' => 12500000,
                    'status' => 'pending',
                    'due_date' => '2026-05-30',
                    'issue_date' => '2026-05-01',
                    'payment_proof' => $demoProofPath,
                ],
                [
                    'number' => 'INV-2026-004',
                    'description' => 'SEO Optimization - Package A',
                    'amount' => 5000000,
                    'status' => 'pending',
                    'due_date' => '2026-06-10',
                    'issue_date' => '2026-05-15',
                    'payment_proof' => null,
                ],
            ];

            foreach ($rows as $row) {
                Invoice::create(array_merge($row, ['user_id' => $user->id]));
            }
        }
    }

    private function createDemoProofFile(int $userId): ?string
    {
        $source = public_path('img/logo.png');

        if (! is_file($source)) {
            return null;
        }

        $path = 'payment_proofs/demo-user-' . $userId . '.png';
        Storage::disk('public')->put($path, file_get_contents($source));

        return $path;
    }
}
