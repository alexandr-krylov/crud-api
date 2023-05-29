<?php

declare(strict_types=1);

namespace CrudApi\Types;

use CrudApi\Exceptions\SetTypeException;

class Phone extends AbstractType
{
    private $maxLen = 15;

    public function __construct(?string $value)
    {
        if (!is_null($value) and strlen($value) > $this->maxLen) {
            throw new SetTypeException();
        }
        $this->value = $value;
    }
}
