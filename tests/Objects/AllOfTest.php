<?php

declare(strict_types=1);

namespace GoldSpecDigital\ObjectOrientedOAS\Tests\Objects;

use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use GoldSpecDigital\ObjectOrientedOAS\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(Schema::class)]
#[CoversClass(AllOf::class)]
#[CoversClass(MediaType::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Arr::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Extensions::class)]
class AllOfTest extends TestCase
{
    #[Test]
    public function two_schemas_work()
    {
        $schema1 = Schema::string();
        $schema2 = Schema::integer();

        $allOf = AllOf::create()
            ->schemas($schema1, $schema2);

        $this->assertEquals([
            'allOf' => [
                [
                    'type' => 'string',
                ],
                [
                    'type' => 'integer',
                ],
            ],
        ], $allOf->toArray());
    }

    #[Test]
    public function two_schemas_as_response_work()
    {
        $schema1 = Schema::string();
        $schema2 = Schema::integer();

        $allOf = AllOf::create()
            ->schemas($schema1, $schema2);

        $response = MediaType::json()
            ->schema($allOf);

        $this->assertEquals([
            'schema' => [
                'allOf' => [
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
