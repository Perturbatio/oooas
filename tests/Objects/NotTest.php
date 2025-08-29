<?php

declare(strict_types=1);

namespace GoldSpecDigital\ObjectOrientedOAS\Tests\Objects;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use GoldSpecDigital\ObjectOrientedOAS\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(MediaType::class)]
#[CoversClass(Not::class)]
#[CoversClass(Schema::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Arr::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Extensions::class)]
class NotTest extends TestCase
{
    #[Test]
    public function as_response_works()
    {
        $not = Not::create()
            ->schema(Schema::string());

        $response = MediaType::json()
            ->schema($not);

        $this->assertEquals([
            'schema' => [
                'not' => [
                    'type' => 'string',
                ],
            ],
        ], $response->toArray());
    }
}
