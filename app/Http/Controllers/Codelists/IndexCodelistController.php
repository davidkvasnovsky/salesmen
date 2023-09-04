<?php

declare(strict_types=1);

namespace App\Http\Controllers\Codelists;

use App\Http\Exceptions\BadRequestException;
use App\Http\Exceptions\ForbiddenException;
use Domains\Support\Data\CodelistResourceData;
use Domains\Support\Enums\GenderEnum;
use Domains\Support\Enums\MaritalStatusEnum;
use Domains\Support\Enums\TitleAfterEnum;
use Domains\Support\Enums\TitleBeforeEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Throwable;

final readonly class IndexCodelistController
{
    /**
     * @throws BadRequestException
     */
    #[Get(
        uri: 'codelists',
        name: 'codelists.index',
        middleware: 'api'
    )]
    public function __invoke(Request $request): CodelistResourceData|JsonResponse
    {
        if (!$request->user()) {
            throw new ForbiddenException(
                object: 'Codelist'
            );
        }

        try {
            return (new CodelistResourceData(
                marital_statuses: MaritalStatusEnum::all(),
                genders: GenderEnum::all(),
                titles_before: TitleBeforeEnum::all(),
                titles_after: TitleAfterEnum::all(),
            ))->withoutWrapping();
        } catch (Throwable) {
            throw new BadRequestException();
        }
    }
}
