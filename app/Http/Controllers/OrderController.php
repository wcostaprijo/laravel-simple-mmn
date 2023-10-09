<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repositories\OrderRepository;
use App\Http\Requests\Order\StoreRequest;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Retorna a tabela com os pedidos do usuário
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('orders.index', ['isAdmin' => auth()->user()->admin === 1, 'orders' => OrderRepository::get()]);
    }

    /**
     * Retorna formulário para cadastro de pedido
     *
     * @param Request $request
     * @return View
     */
    public function create(Request $request): View
    {
        return view('orders.create', ['products' => config('products')]);
    }

    /**
     * Salva um novo pedido
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        return OrderService::store($request->safe()->product);
    }

    /**
     * Atualiza o status de pedido
     *
     * @param string $status
     * @param Order $order
     * @return RedirectResponse
     */
    public function update(string $status, Order $order): RedirectResponse
    {
        return OrderService::update($order, $status);
    }
}
