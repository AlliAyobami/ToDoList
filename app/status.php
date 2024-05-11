<?php

namespace App;

enum status: string
{
    case PENDING = 'pending';
    case ON_GOING = 'ongoing';
    case COMPLETED = 'completed';
  
    public static function toArray(): array
    {
        return array_column(status::cases(), 'value');
    }   
}
