<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Order;

class OrderRepository
{
    /**
     * Retorna paginação da dos pedidos
     *
     * @param integer $level
     * @return LengthAwarePaginator
     */
    public static function get(): LengthAwarePaginator
    {
        if(auth()->user()->admin === 1) {
            return Order::latest()->with('user')->paginate(15);
        }
        return auth()->user()->orders()->with('user')->latest()->paginate(15);
    }

    /**
     * Salva um novo pedido
     *
     * @param array $product
     * @return Order
     */
    public static function store(array $product): Order
    {
        return auth()->user()->orders()->create([
            'description' => $product['description'],
            'value' => $product['value'],
        ]);
    }

    /**
     * Atualiza o status de um pedido
     *
     * @param Order $order
     * @param string $status
     * @return void
     */
    public static function update(Order $order, string $status): void
    {
        $order->update([
            'status' => $status == 'a' ? Order::APROVADO : Order::CANCELADO
        ]);
    }
}
