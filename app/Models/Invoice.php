<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Invoice extends Model
{
    protected $fillable = [
        'user_id',
        'number',
        'description',
        'amount',
        'status',
        'due_date',
        'issue_date',
        'payment_proof',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'due_date' => 'date',
            'issue_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Public URL for payment proof (only when file exists on disk).
     */
    protected function paymentProofUrl(): Attribute
    {
        return Attribute::get(function (): ?string {
            if (blank($this->payment_proof)) {
                return null;
            }

            $disk = Storage::disk('public');

            if (! $disk->exists($this->payment_proof)) {
                return null;
            }

            return $disk->url($this->payment_proof);
        });
    }

    public function hasPaymentProofFile(): bool
    {
        return filled($this->payment_proof)
            && Storage::disk('public')->exists($this->payment_proof);
    }
}
