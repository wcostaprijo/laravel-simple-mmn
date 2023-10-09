<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

class NetworkRepository
{
    /**
     * Retorna paginação da rede do usuário
     *
     * @param integer $level
     * @return LengthAwarePaginator
     */
    public static function get(int $level): LengthAwarePaginator
    {
        return auth()->user()->networkDown()->with('reference')->whereLevel($level)->paginate(15);
    }
}
