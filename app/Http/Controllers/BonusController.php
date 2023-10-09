<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repositories\BonusRepository;

class BonusController extends Controller
{
    /**
     * Retorna a tabela com os bonus recebido pelo usuário
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('bonus.index', ['bonus' => BonusRepository::get()]);
    }
}
