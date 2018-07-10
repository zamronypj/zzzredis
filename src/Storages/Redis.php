<?php
namespace Juhara\ZzzCache\Storages;

use Juhara\ZzzCache\Contracts\CacheStorageInterface;
use Predis\Client;

/**
 * Redis storage implementation using Predis library
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
final class Redis implements CacheStorageInterface
{
    /**
     * predis client instance
     * @var Predis\Client
     */
    private $redisClient;

    /**
     * constructor
     * @param Client $redisClient predis client instance
     */
    public function __construct(Client $redisClient)
    {
        $this->redisClient = $redisClient;
    }

    /**
     * test availability of cache
     * @param  string $cacheId cache identifier
     * @return boolean true if available or false otherwise
     */
    public function exists($cacheId)
    {
        return $this->redisClient->exists($cacheId);
    }

    /**
     * read data from storage by cache name
     * @param  string $cacheId cache identifier
     * @return string data from storage in serialized format
     */
    public function read($cacheId)
    {
        return unserialize($this->redisClient->get($cacheId));
    }

    /**
     * write data to storage by cache name
     * @param  string $cacheId cache identifier
     * @param  string $data item to cache in serialized format
     * @param  int $ttl time to live
     * @return int number of bytes written
     */
    public function write($cacheId, $data, $ttl)
    {
        $serializedData = serialize($data);
        return $this->redisClient->setex($cacheId, $ttl, $serializedData);
    }

    /**
     * remove data from storage by cache id
     * @param  string $cacheId cache identifier
     * @return boolean true if cache is successfully removed
     */
    public function remove($cacheId)
    {
        return ($this->redisClient->del($cacheId) === 1);
    }

    /**
     * remove all data from storage
     */
    public function clear()
    {
        $this->redisClient->flushall();
    }
}
