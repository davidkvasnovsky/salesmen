<?php

declare(strict_types=1);

namespace Domains\Support\Enums;

use Domains\Support\Enums\Concerns\HasEqualValues;
use Domains\Support\Enums\Concerns\HasListableDetails;
use Domains\Support\Enums\Concerns\HasListableValues;
use Infrastructure\Support\Enums\BaseEnum;
use Infrastructure\Support\Enums\CodelistEnum;

enum TitleAfterEnum: string implements BaseEnum, CodelistEnum
{
    use HasEqualValues;
    use HasListableDetails;
    use HasListableValues;

    case CsC = 'CSc.';
    case DrSC = 'DrSc.';
    case PhD = 'PhD.';
    case ArtD = 'ArtD.';
    case DiS = 'DiS';
    case DiSArt = 'DiS.art';
    case FEBO = 'FEBO';
    case MPH = 'MPH';
    case BSBA = 'BSBA';
    case MBA = 'MBA';
    case DBA = 'DBA';
    case MHA = 'MHA';
    case FCCA = 'FCCA';
    case Msc = 'MSc.';
    case FEBU = 'FEBU';
    case LLM = 'LL.M';
}
