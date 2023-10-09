<?php

namespace App\Observers;

use App\Models\Order;
use App\Services\NetworkService;

class OrderObserver
{
    public $afterCommit = true;

    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        //
    }

    /**
     * Evento disparado quando um pedido é atualializado
     */
    public function updated(Order $order): void
    {
        /**
         * Verificamos se o status foi atualizado para aprovado
         */
        if($order->isDirty('status') and $order->status === Order::APROVADO) {
            NetworkService::giveBonusAndPoints($order->user, $order, 1);
        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
