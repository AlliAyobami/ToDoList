<?php

namespace App;

enum priority: string
{
    case CRITICAL = 'critical';
    case HIGH = 'high';
    case MEDIUM = 'medium';
    case LOW = 'low';
    case PLANNING = 'planning';
  
    public static function toArray(): array
    {
        return array_column(priority::cases(), 'value');
    }   
}
