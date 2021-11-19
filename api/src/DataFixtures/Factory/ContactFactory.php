<?php

namespace App\DataFixtures\Factory;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Contact>
 *
 * @method static        Contact|Proxy createOne(array $attributes = [])
 * @method static        Contact[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static        Contact|Proxy find(object|array|mixed $criteria)
 * @method static        Contact|Proxy findOrCreate(array $attributes)
 * @method static        Contact|Proxy first(string $sortedField = 'id')
 * @method static        Contact|Proxy last(string $sortedField = 'id')
 * @method static        Contact|Proxy random(array $attributes = [])
 * @method static        Contact|Proxy randomOrCreate(array $attributes = [])
 * @method static        Contact[]|Proxy[] all()
 * @method static        Contact[]|Proxy[] findBy(array $attributes)
 * @method static        Contact[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static        Contact[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static        ContactRepository|RepositoryProxy repository()
 * @method Contact|Proxy create(array|callable $attributes = [])
 */
final class ContactFactory extends ModelFactory
{
    protected static function getClass(): string
    {
        return Contact::class;
    }

    /**
     * @return array<string, AddressFactory|string>
     */
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->text(),
            'address.value' => self::faker()->text(),
        ];
    }
}
