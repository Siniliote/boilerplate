<?php

namespace App\Factory;

use App\Entity\Post;
use App\Repository\PostRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Post>
 *
 * @method static     Post|Proxy createOne(array $attributes = [])
 * @method static     Post[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static     Post|Proxy find(object|array|mixed $criteria)
 * @method static     Post|Proxy findOrCreate(array $attributes)
 * @method static     Post|Proxy first(string $sortedField = 'id')
 * @method static     Post|Proxy last(string $sortedField = 'id')
 * @method static     Post|Proxy random(array $attributes = [])
 * @method static     Post|Proxy randomOrCreate(array $attributes = [])
 * @method static     Post[]|Proxy[] all()
 * @method static     Post[]|Proxy[] findBy(array $attributes)
 * @method static     Post[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static     Post[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static     PostRepository|RepositoryProxy repository()
 * @method Post|Proxy create(array|callable $attributes = [])
 * @method Post|Proxy object()
 */
final class PostFactory extends ModelFactory
{
    protected static function getClass(): string
    {
        return Post::class;
    }

    /**
     * @return array<string, string>
     */
    protected function getDefaults(): array
    {
        return [
            'title' => self::faker()->unique()->sentence(),
            'body' => self::faker()->sentence(),
        ];
    }

    public function published(): self
    {
        // call setPublishedAt() and pass a random DateTime
        return $this->addState(function () {
            return ['published_at' => self::faker()->dateTime()];
        });
    }

    public function unpublished(): self
    {
        return $this->addState(['published_at' => null]);
    }

    public function withViewCount(int $count = null): self
    {
        return $this->addState(function () use ($count) {
            return ['view_count' => $count ?? self::faker()->numberBetween(0, 10000)];
        });
    }
}
