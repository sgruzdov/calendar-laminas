<?php

namespace Laminas\Cache\Storage;

use Laminas\Cache\Exception\RuntimeException;
use Laminas\ServiceManager\AbstractPluginManager;
use Laminas\ServiceManager\Exception\InvalidServiceException;
use Laminas\ServiceManager\Factory\InvokableFactory;

/**
 * Plugin manager implementation for cache storage adapters
 *
 * Enforces that adapters retrieved are instances of
 * StorageInterface. Additionally, it registers a number of default
 * adapters available.
 */
class AdapterPluginManager extends AbstractPluginManager
{
    protected $aliases = [
        'apc'              => Adapter\Apc::class,
        'Apc'              => Adapter\Apc::class,
        'APC'              => Adapter\Apc::class,
        'apcu'             => Adapter\Apcu::class,
        'ApcU'             => Adapter\Apcu::class,
        'Apcu'             => Adapter\Apcu::class,
        'APCu'             => Adapter\Apcu::class,
        'black_hole'       => Adapter\BlackHole::class,
        'blackhole'        => Adapter\BlackHole::class,
        'blackHole'        => Adapter\BlackHole::class,
        'BlackHole'        => Adapter\BlackHole::class,
        'dba'              => Adapter\Dba::class,
        'Dba'              => Adapter\Dba::class,
        'DBA'              => Adapter\Dba::class,
        'ext_mongo_db'     => Adapter\ExtMongoDb::class,
        'extmongodb'       => Adapter\ExtMongoDb::class,
        'ExtMongoDb'       => Adapter\ExtMongoDb::class,
        'ExtMongoDB'       => Adapter\ExtMongoDb::class,
        'extMongoDb'       => Adapter\ExtMongoDb::class,
        'extMongoDB'       => Adapter\ExtMongoDb::class,
        'filesystem'       => Adapter\Filesystem::class,
        'Filesystem'       => Adapter\Filesystem::class,
        'memcache'         => Adapter\Memcache::class,
        'Memcache'         => Adapter\Memcache::class,
        'memcached'        => Adapter\Memcached::class,
        'Memcached'        => Adapter\Memcached::class,
        'memory'           => Adapter\Memory::class,
        'Memory'           => Adapter\Memory::class,
        'mongo_db'         => Adapter\MongoDb::class,
        'mongodb'          => Adapter\MongoDb::class,
        'MongoDb'          => Adapter\MongoDb::class,
        'MongoDB'          => Adapter\MongoDb::class,
        'mongoDb'          => Adapter\MongoDb::class,
        'mongoDB'          => Adapter\MongoDb::class,
        'redis'            => Adapter\Redis::class,
        'Redis'            => Adapter\Redis::class,
        'session'          => Adapter\Session::class,
        'Session'          => Adapter\Session::class,
        'xcache'           => Adapter\XCache::class,
        'xCache'           => Adapter\XCache::class,
        'Xcache'           => Adapter\XCache::class,
        'XCache'           => Adapter\XCache::class,
        'win_cache'        => Adapter\WinCache::class,
        'wincache'         => Adapter\WinCache::class,
        'winCache'         => Adapter\WinCache::class,
        'WinCache'         => Adapter\WinCache::class,
        'zend_server_disk' => Adapter\ZendServerDisk::class,
        'zendserverdisk'   => Adapter\ZendServerDisk::class,
        'zendServerDisk'   => Adapter\ZendServerDisk::class,
        'ZendServerDisk'   => Adapter\ZendServerDisk::class,
        'zend_server_shm'  => Adapter\ZendServerShm::class,
        'zendservershm'    => Adapter\ZendServerShm::class,
        'zendServerShm'    => Adapter\ZendServerShm::class,
        'zendServerSHM'    => Adapter\ZendServerShm::class,
        'ZendServerShm'    => Adapter\ZendServerShm::class,
        'ZendServerSHM'    => Adapter\ZendServerShm::class,

        // Legacy Zend Framework aliases
        \Zend\Cache\Storage\Adapter\Apc::class => Adapter\Apc::class,
        \Zend\Cache\Storage\Adapter\Apcu::class => Adapter\Apcu::class,
        \Zend\Cache\Storage\Adapter\BlackHole::class => Adapter\BlackHole::class,
        \Zend\Cache\Storage\Adapter\Dba::class => Adapter\Dba::class,
        \Zend\Cache\Storage\Adapter\ExtMongoDb::class => Adapter\ExtMongoDb::class,
        \Zend\Cache\Storage\Adapter\Filesystem::class => Adapter\Filesystem::class,
        \Zend\Cache\Storage\Adapter\Memcache::class => Adapter\Memcache::class,
        \Zend\Cache\Storage\Adapter\Memcached::class => Adapter\Memcached::class,
        \Zend\Cache\Storage\Adapter\Memory::class => Adapter\Memory::class,
        \Zend\Cache\Storage\Adapter\MongoDb::class => Adapter\MongoDb::class,
        \Zend\Cache\Storage\Adapter\Redis::class => Adapter\Redis::class,
        \Zend\Cache\Storage\Adapter\Session::class => Adapter\Session::class,
        \Zend\Cache\Storage\Adapter\WinCache::class => Adapter\WinCache::class,
        \Zend\Cache\Storage\Adapter\XCache::class => Adapter\XCache::class,
        \Zend\Cache\Storage\Adapter\ZendServerDisk::class => Adapter\ZendServerDisk::class,
        \Zend\Cache\Storage\Adapter\ZendServerShm::class => Adapter\ZendServerShm::class,

        // v2 normalized FQCNs
        'zendcachestorageadapterapc' => Adapter\Apc::class,
        'zendcachestorageadapterapcu' => Adapter\Apcu::class,
        'zendcachestorageadapterblackhole' => Adapter\BlackHole::class,
        'zendcachestorageadapterdba' => Adapter\Dba::class,
        'zendcachestorageadapterextmongodb' => Adapter\ExtMongoDb::class,
        'zendcachestorageadapterfilesystem' => Adapter\Filesystem::class,
        'zendcachestorageadaptermemcache' => Adapter\Memcache::class,
        'zendcachestorageadaptermemcached' => Adapter\Memcached::class,
        'zendcachestorageadaptermemory' => Adapter\Memory::class,
        'zendcachestorageadaptermongodb' => Adapter\MongoDb::class,
        'zendcachestorageadapterredis' => Adapter\Redis::class,
        'zendcachestorageadaptersession' => Adapter\Session::class,
        'zendcachestorageadapterwincache' => Adapter\WinCache::class,
        'zendcachestorageadapterxcache' => Adapter\XCache::class,
        'zendcachestorageadapterzendserverdisk' => Adapter\ZendServerDisk::class,
        'zendcachestorageadapterzendservershm' => Adapter\ZendServerShm::class,
    ];

    protected $factories = [
        Adapter\Apc::class                      => InvokableFactory::class,
        Adapter\Apcu::class                     => InvokableFactory::class,
        Adapter\BlackHole::class                => InvokableFactory::class,
        Adapter\Dba::class                      => InvokableFactory::class,
        Adapter\ExtMongoDb::class               => InvokableFactory::class,
        Adapter\Filesystem::class               => InvokableFactory::class,
        Adapter\Memcache::class                 => InvokableFactory::class,
        Adapter\Memcached::class                => InvokableFactory::class,
        Adapter\Memory::class                   => InvokableFactory::class,
        Adapter\MongoDb::class                  => InvokableFactory::class,
        Adapter\Redis::class                    => InvokableFactory::class,
        Adapter\Session::class                  => InvokableFactory::class,
        Adapter\WinCache::class                 => InvokableFactory::class,
        Adapter\XCache::class                   => InvokableFactory::class,
        Adapter\ZendServerDisk::class           => InvokableFactory::class,
        Adapter\ZendServerShm::class            => InvokableFactory::class,

        // v2 normalized FQCNs
        'laminascachestorageadapterapc'            => InvokableFactory::class,
        'laminascachestorageadapterapcu'           => InvokableFactory::class,
        'laminascachestorageadapterblackhole'      => InvokableFactory::class,
        'laminascachestorageadapterdba'            => InvokableFactory::class,
        'laminascachestorageadapterextmongodb'     => InvokableFactory::class,
        'laminascachestorageadapterfilesystem'     => InvokableFactory::class,
        'laminascachestorageadaptermemcache'       => InvokableFactory::class,
        'laminascachestorageadaptermemcached'      => InvokableFactory::class,
        'laminascachestorageadaptermemory'         => InvokableFactory::class,
        'laminascachestorageadaptermongodb'        => InvokableFactory::class,
        'laminascachestorageadapterredis'          => InvokableFactory::class,
        'laminascachestorageadaptersession'        => InvokableFactory::class,
        'laminascachestorageadapterwincache'       => InvokableFactory::class,
        'laminascachestorageadapterxcache'         => InvokableFactory::class,
        'laminascachestorageadapterzendserverdisk' => InvokableFactory::class,
        'laminascachestorageadapterzendservershm'  => InvokableFactory::class,
    ];

    /**
     * Do not share by default (v3)
     *
     * @var array
     */
    protected $sharedByDefault = false;

    /**
     * Don't share by default (v2)
     *
     * @var boolean
     */
    protected $shareByDefault = false;

    /**
     * @var string
     */
    protected $instanceOf = StorageInterface::class;

    /**
     * Validate the plugin is of the expected type (v3).
     *
     * Validates against `$instanceOf`.
     *
     * @param mixed $instance
     * @throws InvalidServiceException
     */
    public function validate($instance)
    {
        if (! $instance instanceof $this->instanceOf) {
            throw new InvalidServiceException(sprintf(
                '%s can only create instances of %s; %s is invalid',
                get_class($this),
                $this->instanceOf,
                (is_object($instance) ? get_class($instance) : gettype($instance))
            ));
        }
    }

    /**
     * Validate the plugin is of the expected type (v2).
     *
     * Proxies to `validate()`.
     *
     * @param mixed $instance
     * @throws InvalidServiceException
     */
    public function validatePlugin($instance)
    {
        try {
            $this->validate($instance);
        } catch (InvalidServiceException $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
