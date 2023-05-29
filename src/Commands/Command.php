<?php

declare(strict_types=1);

namespace CrudApi\Commands;

abstract class Command
{
    abstract public function execute(CommandContext $context): bool;
}
