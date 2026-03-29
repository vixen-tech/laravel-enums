<?php

namespace Vixen\Enums;

trait ToArray
{
    public function toArray(): array
    {
        return [
            'label' => $this->label(),
            'value' => $this->value,
        ];
    }
}
