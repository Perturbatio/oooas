<?php

declare(strict_types=1);

namespace GoldSpecDigital\ObjectOrientedOAS\Tests\Objects;

use GoldSpecDigital\ObjectOrientedOAS\Objects\ExternalDocs;
use GoldSpecDigital\ObjectOrientedOAS\OpenApi;
use GoldSpecDigital\ObjectOrientedOAS\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(ExternalDocs::class)]
#[CoversClass(OpenApi::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Arr::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Extensions::class)]
class ExternalDocsTest extends TestCase
{
    #[Test]
    public function create_with_all_parameters_works()
    {
        $externalDocs = ExternalDocs::create()
            ->description('GitHub Repo')
            ->url('https://github.com/goldspecdigital/oooas');

        $openApi = OpenApi::create()
            ->externalDocs($externalDocs);

        $this->assertEquals([
            'externalDocs' => [
                'description' => 'GitHub Repo',
                'url' => 'https://github.com/goldspecdigital/oooas',
            ],
        ], $openApi->toArray());
    }
}
