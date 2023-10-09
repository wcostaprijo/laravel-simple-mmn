<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repositories\NetworkRepository;

class NetworkController extends Controller
{
    /**
     * Retorna a tabela com a rede do usuário pelo nivel
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request, int $level): View
    {
        if($level < 1 or $level > config('network.levels')) {
            return abort(404);
        }

        return view('network.index', ['level' => $level, 'networks' => NetworkRepository::get($level)]);
    }
}
