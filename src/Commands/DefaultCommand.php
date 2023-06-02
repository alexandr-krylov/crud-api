<?php

declare(strict_types=1);

namespace CrudApi\Commands;

class DefaultCommand extends Command
{
    public function execute(CommandContext $context): bool
    {
        return true;
    }
}
