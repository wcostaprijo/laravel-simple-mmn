<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repositories\ScoreRepository;

class PointController extends Controller
{
    /**
     * Retorna a tabela com os pontos recebido pelo usuário
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('points.index', ['points' => ScoreRepository::get()]);
    }
}
