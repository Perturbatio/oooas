<?php

namespace GoldSpecDigital\ObjectOrientedOAS\Tests\Objects;

use GoldSpecDigital\ObjectOrientedOAS\Objects\BaseObject;
use GoldSpecDigital\ObjectOrientedOAS\Utilities\Arr;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(BaseObject::class)]
#[CoversClass(Arr::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Extensions::class)]
class BaseObjectTest extends TestCase
{
    #[Test]
    public function create_with_no_parameters_fails()
    {
        $baseObject = SampleObject::create();
        $this->expectExceptionMessage('Typed property GoldSpecDigital\ObjectOrientedOAS\Tests\Objects\SampleObject::$name must not be accessed before initialization');
        $this->assertEquals([], $baseObject->toArray());
    }

    #[Test]
    public function create_with_all_parameters_works()
    {
        $baseObject = SampleObject::create()
            ->name('Sample Name');
        $this->assertEquals([
            'name' => 'Sample Name',
        ], $baseObject->toArray());
    }

    #[Test]
    public function object_id_generates_new_object_with_different_id()
    {
        $baseObject1 = SampleObject::create('object-1')
            ->name('Sample Name');
        $baseObject2 = $baseObject1->objectId('object-2');
        // object 1 should not have an objectId
        $this->assertEqualsCanonicalizing([
            'name' => 'Sample Name',
            'objectId' => 'object-1'
        ], $baseObject1->toArray());

        // object 2 should have an objectId of 'new-id'
        $this->assertEqualsCanonicalizing([
            'name' => 'Sample Name',
            'objectId' => 'object-2',
        ], $baseObject2->toArray());
    }

    #[Test]
    public function get_magic_method_returns_extensions()
    {
        $baseObject = SampleObject::create()
            ->name('Sample Name')
            ->x('x-custom', 'Custom Value')
            ->x('x-another', 'Another Value')
        ;

        $this->assertEqualsCanonicalizing([
            'x-custom' => 'Custom Value',
            'x-another' => 'Another Value',
        ], $baseObject->x);
    }

    #[Test]
    public function get_magic_method_returns_single_extension()
    {
        $baseObject = SampleObject::create()
            ->name('Sample Name')
            ->x('x-custom', 'Custom Value')
            ->x('x-another', 'Another Value')
        ;

        $this->assertEquals('Custom Value', $baseObject->{'x-custom'});
    }

    #[Test]
    public function get_magic_method_throws_exception_for_non_existent_property()
    {
        $baseObject = SampleObject::create()
            ->name('Sample Name')
            ->x('x-custom', 'Custom Value')
            ->x('x-another', 'Another Value')
        ;

        $this->expectExceptionMessage('[nonExistent] is not a valid property');
        $value = $baseObject->nonExistent;
    }
}

class SampleObject extends BaseObject
{
    protected mixed $name;

    /**
     * @param string|null $name
     * @return static
     */
    public function name(?string $name): self
    {
        $instance = clone $this;

        $instance->name = $name;

        return $instance;
    }
    protected function generate(): array
    {
        return Arr::filter([
            'name' => $this->name,
            'objectId' => $this->objectId,
        ]);
    }
}
