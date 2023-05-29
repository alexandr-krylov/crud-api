<?php

declare(strict_types=1);

namespace CrudApi\Commands;

class CommandContext
{
    private string $error = "";
    public function __construct(private array $params = [])
    {
    }
    public function addParam(string $key, $val)
    {
        $this->params[$key] = $val;
    }
    public function get(string $key): ?string
    {
        if (key_exists($key, $this->params)) return $this->params[$key];
        return null;
    }
    public function setError(string $error)
    {
        $this->error = $error;
    }
    public function getError(): string
    {
        return $this->error;
    }
}
