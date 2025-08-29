<?php

namespace GoldSpecDigital\ObjectOrientedOAS\Tests\Utilities;

use GoldSpecDigital\ObjectOrientedOAS\OpenApi;
use GoldSpecDigital\ObjectOrientedOAS\Tests\TestCase;
use GoldSpecDigital\ObjectOrientedOAS\Utilities\Arr;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(Arr::class)]
#[CoversClass(OpenApi::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Extensions::class)]
class ArrTest extends TestCase
{
    #[Test]
    public function null_values_are_removed_from_array()
    {
        $array = ['test' => null];

        $array = Arr::filter($array);

        $this->assertCount(0, $array);
    }

    #[Test]
    public function non_null_values_remain()
    {
        $array = [
            'false' => false,
            '0' => 0,
            'string' => 'string',
            'object' => OpenApi::create(),
        ];

        $array = Arr::filter($array);

        $this->assertCount(4, $array);
        $this->assertArrayHasKey('false', $array);
        $this->assertArrayHasKey('0', $array);
        $this->assertArrayHasKey('string', $array);
        $this->assertArrayHasKey('object', $array);
    }
}
