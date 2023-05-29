<?php

declare(strict_types=1);

namespace CrudApi\Types;

use CrudApi\Exceptions\SetTypeException;

class Key extends AbstractType
{
    private $maxLen = 25;

    public function __construct(string $value)
    {
        if (strlen($value) > $this->maxLen) {
            throw new SetTypeException();
        }
        $this->value = $value;
    }
}
