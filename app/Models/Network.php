<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Network extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Retorna usuário superior dessa referência
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retorna usuário da referência
     *
     * @return BelongsTo
     */
    public function reference(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reference_id', 'id');
    }
}
