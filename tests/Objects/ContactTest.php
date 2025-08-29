<?php

declare(strict_types=1);

namespace GoldSpecDigital\ObjectOrientedOAS\Tests\Objects;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Contact;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Info;
use GoldSpecDigital\ObjectOrientedOAS\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(Contact::class)]
#[CoversClass(Info::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Arr::class)]
#[CoversClass(\GoldSpecDigital\ObjectOrientedOAS\Utilities\Extensions::class)]
class ContactTest extends TestCase
{
    #[Test]
    public function create_with_all_parameters_works()
    {
        $contact = Contact::create()
            ->name('GoldSpec Digital')
            ->url('https://goldspecdigital.com')
            ->email('hello@goldspecdigital.com');

        $info = Info::create()
            ->contact($contact);

        $this->assertEquals([
            'contact' => [
                'name' => 'GoldSpec Digital',
                'url' => 'https://goldspecdigital.com',
                'email' => 'hello@goldspecdigital.com',
            ],
        ], $info->toArray());
    }
}
