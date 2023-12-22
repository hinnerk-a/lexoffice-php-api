<?php

declare(strict_types=1);

namespace Sysix\LexOffice\Clients;

use Sysix\LexOffice\BaseClient;
use Sysix\LexOffice\Clients\Traits\CreateTrait;
use Sysix\LexOffice\Clients\Traits\DocumentClientTrait;
use Sysix\LexOffice\Clients\Traits\GetTrait;
use Sysix\LexOffice\Clients\Traits\PursueTrait;
use Sysix\LexOffice\Clients\Traits\VoucherListTrait;

class OrderConfirmation extends BaseClient
{
    use CreateTrait;
    use DocumentClientTrait;
    use GetTrait;
    use PursueTrait;
    use VoucherListTrait;

    protected string $resource = 'order-confirmations';

    /** @var string[] */
    protected array $voucherListTypes = ['orderconfirmation'];
}
