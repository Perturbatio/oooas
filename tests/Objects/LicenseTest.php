<?php

declare(strict_types=1);

namespace GoldSpecDigital\ObjectOrientedOAS\Tests\Objects;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Info;
use GoldSpecDigital\ObjectOrientedOAS\Objects\License;
use GoldSpecDigital\ObjectOrientedOAS\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(Info::class)]
#[CoversClass(License::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Arr::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Extensions::class)]
class LicenseTest extends TestCase
{
    #[Test]
    public function create_with_all_parameters_works()
    {
        $license = License::create()
            ->name('MIT')
            ->url('https://goldspecdigital.com');

        $info = Info::create()
            ->license($license);

        $this->assertEquals([
            'license' => [
                'name' => 'MIT',
                'url' => 'https://goldspecdigital.com',
            ],
        ], $info->toArray());
    }
}
