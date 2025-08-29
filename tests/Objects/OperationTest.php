<?php

declare(strict_types=1);

namespace GoldSpecDigital\ObjectOrientedOAS\Tests\Objects;

use GoldSpecDigital\ObjectOrientedOAS\Objects\ExternalDocs;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Operation;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityRequirement;
use GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityScheme;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Server;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Tag;
use GoldSpecDigital\ObjectOrientedOAS\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(ExternalDocs::class)]
#[CoversClass(Operation::class)]
#[CoversClass(Parameter::class)]
#[CoversClass(PathItem::class)]
#[CoversClass(RequestBody::class)]
#[CoversClass(Response::class)]
#[CoversClass(SecurityRequirement::class)]
#[CoversClass(SecurityScheme::class)]
#[CoversClass(Server::class)]
#[CoversClass(Tag::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Arr::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Extensions::class)]
class OperationTest extends TestCase
{
    #[Test]
    public function create_with_all_parameters_works()
    {
        $securityScheme = SecurityScheme::create('OAuth2')
            ->type(SecurityScheme::TYPE_OAUTH2);

        $callback = PathItem::create('MyEvent')
            ->route('{$request.query.callbackUrl}')
            ->operations(
                Operation::post()->requestBody(
                    RequestBody::create()
                        ->description('something happened')
                )
            );

        $operation = Operation::create()
            ->action(Operation::ACTION_GET)
            ->tags(Tag::create()->name('Users'))
            ->summary('Lorem ipsum')
            ->description('Dolar sit amet')
            ->externalDocs(ExternalDocs::create())
            ->operationId('users.show')
            ->parameters(Parameter::create())
            ->requestBody(RequestBody::create())
            ->responses(Response::create())
            ->deprecated()
            ->security(SecurityRequirement::create()->securityScheme($securityScheme))
            ->servers(Server::create())
            ->callbacks($callback);

        $pathItem = PathItem::create()
            ->operations($operation);

        $this->assertEquals([
            'get' => [
                'tags' => ['Users'],
                'summary' => 'Lorem ipsum',
                'description' => 'Dolar sit amet',
                'externalDocs' => [],
                'operationId' => 'users.show',
                'parameters' => [
                    [],
                ],
                'requestBody' => [],
                'responses' => [
                    'default' => [],
                ],
                'deprecated' => true,
                'security' => [
                    [
                        'OAuth2' => [],
                    ],
                ],
                'servers' => [
                    [],
                ],
                'callbacks' => [
                    'MyEvent' => [
                        '{$request.query.callbackUrl}' => [
                            'post' => [
                                'requestBody' => [
                                    'description' => 'something happened',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ], $pathItem->toArray());
    }

    #[Test]
    public function update_with_all_parameters_works()
    {
        $securityScheme = SecurityScheme::create('OAuth2')
            ->type(SecurityScheme::TYPE_OAUTH2);

        $callback = PathItem::create('MyEvent')
            ->route('{$request.query.callbackUrl}')
            ->operations(
                Operation::put()->requestBody(
                    RequestBody::create()
                        ->description('something happened')
                )
            );

        $operation = Operation::create()
            ->action(Operation::ACTION_GET)
            ->tags(Tag::create()->name('Users'))
            ->summary('Lorem ipsum')
            ->description('Dolar sit amet')
            ->externalDocs(ExternalDocs::create())
            ->operationId('users.show')
            ->parameters(Parameter::create())
            ->requestBody(RequestBody::create())
            ->responses(Response::create())
            ->deprecated()
            ->security(SecurityRequirement::create()->securityScheme($securityScheme))
            ->servers(Server::create())
            ->callbacks($callback);

        $pathItem = PathItem::create()
            ->operations($operation);

        $this->assertEquals([
            'get' => [
                'tags' => ['Users'],
                'summary' => 'Lorem ipsum',
                'description' => 'Dolar sit amet',
                'externalDocs' => [],
                'operationId' => 'users.show',
                'parameters' => [
                    [],
                ],
                'requestBody' => [],
                'responses' => [
                    'default' => [],
                ],
                'deprecated' => true,
                'security' => [
                    [
                        'OAuth2' => [],
                    ],
                ],
                'servers' => [
                    [],
                ],
                'callbacks' => [
                    'MyEvent' => [
                        '{$request.query.callbackUrl}' => [
                            'put' => [
                                'requestBody' => [
                                    'description' => 'something happened',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ], $pathItem->toArray());
    }

    #[Test]
    public function create_with_no_security_works()
    {
        $operation = Operation::get()
            ->noSecurity();

        $pathItem = PathItem::create()->operations($operation);

        $this->assertEquals([
            'get' => [
                'security' => [],
            ],
        ], $pathItem->toArray());
    }
}
