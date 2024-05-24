<?php

namespace DesafioSoftExpert\Traits;

trait Money
{
    public function formattedMoney($value)
    {
        return "R$ " . str_replace('.',',',number_format($value, 2));
    }
}