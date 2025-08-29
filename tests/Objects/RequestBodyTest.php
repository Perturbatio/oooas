<?php

declare(strict_types=1);

namespace GoldSpecDigital\ObjectOrientedOAS\Tests\Objects;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Operation;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(MediaType::class)]
#[CoversClass(Operation::class)]
#[CoversClass(RequestBody::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Arr::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Extensions::class)]
class RequestBodyTest extends TestCase
{
    #[Test]
    public function create_with_all_parameters_works()
    {
        $requestBody = RequestBody::create()
            ->description('Standard request')
            ->content(MediaType::json())
            ->required();

        $operation = Operation::create()
            ->requestBody($requestBody);

        $this->assertEquals([
            'requestBody' => [
                'description' => 'Standard request',
                'content' => [
                    'application/json' => [],
                ],
                'required' => true,
            ],
        ], $operation->toArray());
    }
}
