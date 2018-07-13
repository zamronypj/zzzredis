# zzzredis
Redis-based cache storage implementation for ZzzCache

# Requirement
- [PHP >= 5.4](https://php.net)
- [Redis](https://redis.io)
- [Composer](https://getcomposer.org)
- [Predis](https://github.com/nrk/predis)
- [ZzzCache](https://github.com/zamronypj/zzzcache)

# Installation
Run through composer

    $ composer require juhara/zzzredis

# How to use

    <?php

    $redisClient = new \Predis\Client();
    $redisCache = new \Juhara\ZzzCache\Storages\Redis($redisClient);

    $cache = new \Juhara\ZzzCache\Cache(
        $redisCache,
        new \Juhara\ZzzCache\Helpers\ExpiryCalculator()
    );

# Contributing

If you have any improvement or issues please submit PR.

Thank you.
