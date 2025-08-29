<?php

declare(strict_types=1);

namespace GoldSpecDigital\ObjectOrientedOAS\Tests\Objects;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use GoldSpecDigital\ObjectOrientedOAS\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(MediaType::class)]
#[CoversClass(OneOf::class)]
#[CoversClass(Schema::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Arr::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Extensions::class)]
class OneOfTest extends TestCase
{
    #[Test]
    public function two_schemas_work()
    {
        $schema1 = Schema::string();
        $schema2 = Schema::integer();

        $oneOf = OneOf::create()
            ->schemas($schema1, $schema2);

        $this->assertEquals([
            'oneOf' => [
                [
                    'type' => 'string',
                ],
                [
                    'type' => 'integer',
                ],
            ],
        ], $oneOf->toArray());
    }

    #[Test]
    public function two_schemas_as_response_work()
    {
        $schema1 = Schema::string();
        $schema2 = Schema::integer();

        $oneOf = OneOf::create()
            ->schemas($schema1, $schema2);

        $response = MediaType::json()
            ->schema($oneOf);

        $this->assertEquals([
            'schema' => [
                'oneOf' => [
                    [
                        'type' => 'string',
                    ],
                    [
                        'type' => 'integer',
                    ],
                ],
            ],
        ], $response->toArray());
    }
}
