<?php declare(strict_types=1);

namespace App\Enums\Permissions;

use BenSampo\Enum\Enum;


final class RoleTypeEnum extends Enum
{
    const ADMIN = 'admin';
    const AGENT = 'agent';
    const OWNER = 'owner';
}