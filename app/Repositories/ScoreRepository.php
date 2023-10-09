<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

class ScoreRepository
{
    /**
     * Retorna paginação dos pontos do usuário
     *
     * @param integer $level
     * @return LengthAwarePaginator
     */
    public static function get(): LengthAwarePaginator
    {
        return auth()->user()->points()->with('order.user')->paginate(15);
    }
}
