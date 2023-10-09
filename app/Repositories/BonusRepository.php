<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

class BonusRepository
{
    /**
     * Retorna paginação dos bônus do usuário
     *
     * @param integer $level
     * @return LengthAwarePaginator
     */
    public static function get(): LengthAwarePaginator
    {
        return auth()->user()->bonus()->with('order.user')->paginate(15);
    }
}
