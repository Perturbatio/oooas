<?php

declare(strict_types=1);

namespace GoldSpecDigital\ObjectOrientedOAS\Tests\Objects;

use GoldSpecDigital\ObjectOrientedOAS\Objects\ExternalDocs;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Tag;
use GoldSpecDigital\ObjectOrientedOAS\OpenApi;
use GoldSpecDigital\ObjectOrientedOAS\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(ExternalDocs::class)]
#[CoversClass(Tag::class)]
#[CoversClass(OpenApi::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Arr::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Extensions::class)]
class TagTest extends TestCase
{
    #[Test]
    public function create_with_all_parameters_works()
    {
        $tag = Tag::create()
            ->name('Users')
            ->description('All user endpoints')
            ->externalDocs(ExternalDocs::create());

        $openApi = OpenApi::create()
            ->tags($tag);

        $this->assertEquals([
            'tags' => [
                [
                    'name' => 'Users',
                    'description' => 'All user endpoints',
                    'externalDocs' => [],
                ],
            ],
        ], $openApi->toArray());
    }
}
