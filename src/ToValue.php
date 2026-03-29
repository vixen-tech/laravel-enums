<?php

namespace Vixen\Enums;

trait ToValue
{
    public function toValue(): int|string
    {
        return $this->value;
    }
}
