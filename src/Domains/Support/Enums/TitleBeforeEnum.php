<?php

declare(strict_types=1);

namespace Domains\Support\Enums;

use Domains\Support\Enums\Concerns\HasEqualValues;
use Domains\Support\Enums\Concerns\HasListableDetails;
use Domains\Support\Enums\Concerns\HasListableValues;
use Infrastructure\Support\Enums\BaseEnum;
use Infrastructure\Support\Enums\CodelistEnum;

enum TitleBeforeEnum: string implements BaseEnum, CodelistEnum
{
    use HasEqualValues;
    use HasListableDetails;
    use HasListableValues;

    case Bc = 'Bc.';
    case Mgr = 'Mgr.';
    case Ing = 'Ing.';
    case JUDr = 'JUDr.';
    case MVDr = 'MVDr.';
    case MUDr = 'MUDr.';
    case PaedDr = 'PaedDr.';
    case Prof = 'prof.';
    case Doc = 'doc.';
    case Dipl = 'dipl.';
    case MDDr = 'MDDr.';
    case Dr = 'Dr.';
    case MgrArt = 'Mgr. art.';
    case ThLic = 'ThLic.';
    case PhDr = 'PhDr.';
    case PhMr = 'PhMr.';
    case RNDr = 'RNDr.';
    case ThDr = 'ThDr.';
    case RSDr = 'RSDr.';
    case Arch = 'arch.';
    case PharmDr = 'PharmDr.';
}
