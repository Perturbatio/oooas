<?php

declare(strict_types=1);

namespace GoldSpecDigital\ObjectOrientedOAS\Tests\Objects;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Link;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(Link::class)]
#[CoversClass(Response::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Arr::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Extensions::class)]
class LinkTest extends TestCase
{
    #[Test]
    public function create_with_all_parameters_works()
    {
        $link = Link::create('LinkName')
            ->operationId('goldspecdigital')
            ->description('The GoldSpec Digital website');

        $response = Response::create()
            ->links($link);

        $this->assertEquals([
            'links' => [
                'LinkName' => [
                    'operationId' => 'goldspecdigital',
                    'description' => 'The GoldSpec Digital website',
                ],
            ],
        ], $response->toArray());
    }
}
