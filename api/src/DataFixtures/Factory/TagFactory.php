<?php

namespace App\DataFixtures\Factory;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Tag>
 *
 * @method static    Tag|Proxy createOne(array $attributes = [])
 * @method static    Tag[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static    Tag|Proxy find(object|array|mixed $criteria)
 * @method static    Tag|Proxy findOrCreate(array $attributes)
 * @method static    Tag|Proxy first(string $sortedField = 'id')
 * @method static    Tag|Proxy last(string $sortedField = 'id')
 * @method static    Tag|Proxy random(array $attributes = [])
 * @method static    Tag|Proxy randomOrCreate(array $attributes = [])
 * @method static    Tag[]|Proxy[] all()
 * @method static    Tag[]|Proxy[] findBy(array $attributes)
 * @method static    Tag[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static    Tag[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static    TagRepository|RepositoryProxy repository()
 * @method Tag|Proxy create(array|callable $attributes = [])
 */
final class TagFactory extends ModelFactory
{
    protected static function getClass(): string
    {
        return Tag::class;
    }

    /**
     * @return array<string, string>
     */
    protected function getDefaults(): array
    {
        return ['name' => self::faker()->sentence()];
    }
}
