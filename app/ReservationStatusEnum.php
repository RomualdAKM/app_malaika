<?php

namespace App;

class ReservationStatusEnum
{
    const PENDING = [
        'value' => 'pending',
        'label' => 'En cours'
    ];
    const CONFIRMED = [
        'value' => 'confirmed',
        'label' => 'Confirmé'
    ];
    const CANCELED = [
        'value' => 'canceled',
        'label' => 'Annulé'
    ];
    const REJECTED = [
        'value' => 'rejected',
        'label' => 'Rejeté'
    ];
    const FINISHED = [
        'value' => 'finished',
        'label' => 'Terminé'
    ];

    public static function getLabels()
    {
        return [
            'pending' => 'En cours',
            'confirmed' => 'Confirmé',
            'canceled' => 'Annulé',
            'rejected' => 'Rejeté',
            'finished' => 'Terminé',
        ];
    }

    public static function getLabel($status)
    {
        return self::getLabels()[$status];
    }
}
