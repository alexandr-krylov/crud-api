<?php

declare(strict_types=1);

namespace CrudApi\Types;

use CrudApi\Exceptions\SetTypeException;

class Name extends AbstractType
{
    private $maxLen = 255;

    public function __construct(?string $value)
    {
        if (!is_null($value) and strlen($value) > $this->maxLen) {
            throw new SetTypeException();
        }
        $this->value = $value;
    }
}
