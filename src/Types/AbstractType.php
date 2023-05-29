<?php

declare(strict_types=1);

namespace CrudApi\Types;

abstract class AbstractType
{
    protected $value = null;

    public function get()
    {
        return $this->value;
    }
}
