<?php

declare(strict_types=1);

namespace GoldSpecDigital\ObjectOrientedOAS\Tests\Objects;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Operation;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Server;
use GoldSpecDigital\ObjectOrientedOAS\OpenApi;
use GoldSpecDigital\ObjectOrientedOAS\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(Operation::class)]
#[CoversClass(Parameter::class)]
#[CoversClass(PathItem::class)]
#[CoversClass(Server::class)]
#[CoversClass(OpenApi::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Arr::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Extensions::class)]
class PathItemTest extends TestCase
{
    #[Test]
    public function create_with_all_parameters_works()
    {
        $pathItem = PathItem::create()
            ->route('/users')
            ->summary('User endpoints')
            ->description('Get the users')
            ->operations(Operation::get())
            ->servers(Server::create()->url('https://goldspecdigital.com'))
            ->parameters(Parameter::create()->name('Test parameter'));

        $openApi = OpenApi::create()
            ->paths($pathItem);

        $this->assertEquals([
            'paths' => [
                '/users' => [
                    'summary' => 'User endpoints',
                    'description' => 'Get the users',
                    'get' => [],
                    'servers' => [
                        ['url' => 'https://goldspecdigital.com'],
                    ],
                    'parameters' => [
                        ['name' => 'Test parameter'],
                    ],
                ],
            ],
        ], $openApi->toArray());
    }
}
