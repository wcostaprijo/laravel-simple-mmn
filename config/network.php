<?php

return [
    'levels' => 5, // Númedo de niveis da rede
    'points_percentage' => 40, // (%) porcentagem sobre o pedido para calculo dos pontos
    'bonus_padrao' => 10, // (%) bonus usado quando nivel não está na array abaixo
    'bonus' => [ // (%) bonus para cada nivel no padrao 'nivel_{nivel}'
        'nivel_1' => 10,
        'nivel_2' => 5,
        'nivel_3' => 2.5,
        'nivel_4' => 1,
        'nivel_5' => 0.5,
    ],
];
