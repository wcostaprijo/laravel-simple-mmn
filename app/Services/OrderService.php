<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use App\Repositories\OrderRepository;

class OrderService
{
    /**
     * Calcula e salva os pontos do usuário
     *
     * @param Order $order
     * @return void
     */
    public static function setUserScore(Order $order): void
    {
        $points = round(($order->value * config('network.points_percentage')) / 100);
    }

    /**
     * Salva um novo pedido
     *
     * @param string $productRequest
     * @return RedirectResponse
     */
    public static function store(string $productRequest): RedirectResponse
    {
        $product = null;
        foreach(config('products') as $p) {
            if($p['description'] == $productRequest) {
                $product = $p;
            }
        }

        if(empty($product)) {
            return back()->withErrors(['product' => 'Produto não encontrado.']);
        }

        if(OrderRepository::store($product)) {
            return redirect('/orders')->with('status', 'Pedido criado com sucesso!');
        }

        return back()->withErrors(['product' => 'Erro ao cadastrar pedido.']);
    }

    /**
     * Atualiza o status de um pedido
     *
     * @param string $status
     * @return RedirectResponse
     */
    public static function update(Order $order, string $status): RedirectResponse
    {
        if(!in_array($status, ['a','c'])) {
            return redirect('/dashboard');
        }

        OrderRepository::update($order, $status);
        return back()->with('status', 'Pedido '.($status == 'a' ? 'aprovado' : 'cancelado').' com sucesso.');
    }
}
