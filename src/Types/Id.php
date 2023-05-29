<?php

declare(strict_types=1);

namespace CrudApi\Types;

use CrudApi\Exceptions\SetTypeException;

class Id extends AbstractType
{
    public function __construct(int $value)
    {
        if ($value <= 0) {
            throw new SetTypeException();
        }
        $this->value = $value;
    }
}
