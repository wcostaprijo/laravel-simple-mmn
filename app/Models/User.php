<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'cpf',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Retorna a relação com as indicações acima do usuário
     *
     * @return HasMany
     */
    public function networkUp(): HasMany
    {
        return $this->hasMany(Network::class, 'reference_id');
    }

    /**
     * Retorna a relação com as indicações abaixo do usuário
     *
     * @return HasMany
     */
    public function networkDown(): HasMany
    {
        return $this->hasMany(Network::class, 'user_id');
    }

    /**
     * Retorna a relação com os pedidos
     *
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Retorna a relação com os pontos
     *
     * @return HasMany
     */
    public function points(): HasMany
    {
        return $this->hasMany(Score::class);
    }

    /**
     * Retorna a relação com os bonus
     *
     * @return HasMany
     */
    public function bonus(): HasMany
    {
        return $this->hasMany(Bonus::class);
    }
}
