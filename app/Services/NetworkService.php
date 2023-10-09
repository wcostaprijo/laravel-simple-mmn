<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Network;
use App\Models\User;
use App\Models\Order;

class NetworkService
{
    /**
     * Função para cadastrar a rede de um usuário
     *
     * @param User $user
     * @param User $userUp
     * @param integer $level
     * @return void
     */
    public static function register(User $user, User $userUp, int $level): void
    {
        if($level <= config('network.levels')) {
            $userUp->networkDown()->create(['reference_id' => $user->id, 'level' => $level]);
            $networkUp = $userUp->networkUp()->whereLevel(1)->first();
            if(!empty($networkUp)) {
                self::register($user, $networkUp->user, $level + 1);
            }
        }
    }

    /**
     * Calcula e salva os bonus e pontos da rede sob um pedido
     *
     * @param User $user
     * @param Order $order
     * @param integer $level
     * @return void
     */
    public static function giveBonusAndPoints(User $user, Order $order, int $level): void
    {
        if($level <= config('network.levels')) {
            $points = round(($order->value * config('network.points_percentage')) / 100);
            $user->points()->create(['order_id' => $order->id, 'points' => $points]);

            $networkUp = $user->networkUp()->whereLevel(1)->first();
            if(!empty($networkUp)) {
                $percentageBonus = config('network.bonus.nivel_'.$level) ?? config('bonus_padrao');
                $bonus = ($percentageBonus * $order->value) / 100;
                $userUp = $networkUp->user;
                $userUp->bonus()->create(['order_id' => $order->id, 'value' => $bonus]);
                $userUp->points()->create(['order_id' => $order->id, 'points' => $points]);
                self::giveBonusAndPoints($userUp, $order, $level + 1);
            }
        }
    }
}
