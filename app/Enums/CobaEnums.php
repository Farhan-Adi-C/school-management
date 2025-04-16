<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum CobaEnums: string implements HasLabel
{
    case Farhan = 'Farhan';
    case Adi = 'Adi';
    case Chandra = 'Chandra';
    
    public function getLabel(): ?string
    {
        return $this->name;
        
        // or
    
        return match ($this) {
            self::Farhan => 'Farhan',
            self::Adi => 'Adi',
            self::Chandra => 'Chandra',
        };
    }
}