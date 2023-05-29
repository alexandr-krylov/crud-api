<?php

declare(strict_types=1);

namespace Entities;

use CrudApi\Types\{Id, Name, Phone, Key};
use DateTime;

class Item
{
    protected Id $id;
    protected Name $name;
    protected Phone $phone;
    protected Key $key;
    protected DateTime $createdAt;
    protected DateTime $updatedAt;
}
