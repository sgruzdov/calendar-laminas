<?php
return [
    'service_manager' => [
        'aliases' => [
            'HttpRouter' => 'Laminas\\Router\\Http\\TreeRouteStack',
            'router' => 'Laminas\\Router\\RouteStackInterface',
            'Router' => 'Laminas\\Router\\RouteStackInterface',
            'RoutePluginManager' => 'Laminas\\Router\\RoutePluginManager',
            'Zend\\Router\\Http\\TreeRouteStack' => 'Laminas\\Router\\Http\\TreeRouteStack',
            'Zend\\Router\\RoutePluginManager' => 'Laminas\\Router\\RoutePluginManager',
            'Zend\\Router\\RouteStackInterface' => 'Laminas\\Router\\RouteStackInterface',
            'ValidatorManager' => 'Laminas\\Validator\\ValidatorPluginManager',
            'Zend\\Validator\\ValidatorPluginManager' => 'Laminas\\Validator\\ValidatorPluginManager'
        ],
        'factories' => [
            'Laminas\\Router\\Http\\TreeRouteStack' => 'Laminas\\Router\\Http\\HttpRouterFactory',
            'Laminas\\Router\\RoutePluginManager' => 'Laminas\\Router\\RoutePluginManagerFactory',
            'Laminas\\Router\\RouteStackInterface' => 'Laminas\\Router\\RouterFactory',
            'Laminas\\Validator\\ValidatorPluginManager' => 'Laminas\\Validator\\ValidatorPluginManagerFactory',
            'doctrine.cli' => 'DoctrineModule\\Service\\CliFactory',
            'DoctrineORMModule\\CliConfigurator' => 'DoctrineORMModule\\Service\\CliConfiguratorFactory',
            'Doctrine\\ORM\\EntityManager' => 'DoctrineORMModule\\Service\\EntityManagerAliasCompatFactory',
            'doctrine.dbal_cmd.runsql' => 'DoctrineORMModule\\Service\\RunSqlCommandFactory',
            'Application\\Service\\DateManager' => 'Laminas\\Mvc\\Controller\\LazyControllerAbstractFactory',
            'Application\\Service\\ClientManager' => 'Laminas\\Mvc\\Controller\\LazyControllerAbstractFactory',
            'Application\\Service\\DbManager' => 'Laminas\\Mvc\\Controller\\LazyControllerAbstractFactory'
        ],
        'invokables' => [
            'DoctrineModule\\Authentication\\Storage\\Session' => 'Laminas\\Authentication\\Storage\\Session',
            'doctrine.dbal_cmd.import' => 'Doctrine\\DBAL\\Tools\\Console\\Command\\ImportCommand',
            'doctrine.orm_cmd.clear_cache_metadata' => 'Doctrine\\ORM\\Tools\\Console\\Command\\ClearCache\\MetadataCommand',
            'doctrine.orm_cmd.clear_cache_result' => 'Doctrine\\ORM\\Tools\\Console\\Command\\ClearCache\\ResultCommand',
            'doctrine.orm_cmd.clear_cache_query' => 'Doctrine\\ORM\\Tools\\Console\\Command\\ClearCache\\QueryCommand',
            'doctrine.orm_cmd.schema_tool_create' => 'Doctrine\\ORM\\Tools\\Console\\Command\\SchemaTool\\CreateCommand',
            'doctrine.orm_cmd.schema_tool_update' => 'Doctrine\\ORM\\Tools\\Console\\Command\\SchemaTool\\UpdateCommand',
            'doctrine.orm_cmd.schema_tool_drop' => 'Doctrine\\ORM\\Tools\\Console\\Command\\SchemaTool\\DropCommand',
            'doctrine.orm_cmd.convert_d1_schema' => 'Doctrine\\ORM\\Tools\\Console\\Command\\ConvertDoctrine1SchemaCommand',
            'doctrine.orm_cmd.generate_entities' => 'Doctrine\\ORM\\Tools\\Console\\Command\\GenerateEntitiesCommand',
            'doctrine.orm_cmd.generate_proxies' => 'Doctrine\\ORM\\Tools\\Console\\Command\\GenerateProxiesCommand',
            'doctrine.orm_cmd.convert_mapping' => 'Doctrine\\ORM\\Tools\\Console\\Command\\ConvertMappingCommand',
            'doctrine.orm_cmd.run_dql' => 'Doctrine\\ORM\\Tools\\Console\\Command\\RunDqlCommand',
            'doctrine.orm_cmd.validate_schema' => 'Doctrine\\ORM\\Tools\\Console\\Command\\ValidateSchemaCommand',
            'doctrine.orm_cmd.info' => 'Doctrine\\ORM\\Tools\\Console\\Command\\InfoCommand',
            'doctrine.orm_cmd.ensure_production_settings' => 'Doctrine\\ORM\\Tools\\Console\\Command\\EnsureProductionSettingsCommand',
            'doctrine.orm_cmd.generate_repositories' => 'Doctrine\\ORM\\Tools\\Console\\Command\\GenerateRepositoriesCommand'
        ],
        'abstract_factories' => [
            'DoctrineModule' => 'DoctrineModule\\ServiceFactory\\AbstractDoctrineServiceFactory'
        ]
    ],
    'route_manager' => [
        'factories' => [
            'symfony_cli' => 'DoctrineModule\\Service\\SymfonyCliRouteFactory'
        ]
    ],
    'router' => [
        'routes' => [
            'doctrine_orm_module_yuml' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/ocra_service_manager_yuml',
                    'defaults' => [
                        'controller' => 'DoctrineORMModule\\Yuml\\YumlController',
                        'action' => 'index'
                    ]
                ]
            ],
            'home' => [
                'type' => 'Laminas\\Router\\Http\\Literal',
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => 'Application\\Controller\\IndexController',
                        'action' => 'index'
                    ]
                ]
            ],
            'singleEvent' => [
                'type' => 'Laminas\\Router\\Http\\Literal',
                'options' => [
                    'route' => '/single-event',
                    'defaults' => [
                        'controller' => 'Application\\Controller\\IndexController',
                        'action' => 'singleEvent'
                    ]
                ]
            ],
            'addClient' => [
                'type' => 'Laminas\\Router\\Http\\Literal',
                'options' => [
                    'route' => '/add-client',
                    'defaults' => [
                        'controller' => 'Application\\Controller\\IndexController',
                        'action' => 'addClient'
                    ]
                ]
            ]
        ]
    ],
    'doctrine' => [
        'cache' => [
            'apc' => [
                'class' => 'Doctrine\\Common\\Cache\\ApcCache',
                'namespace' => 'DoctrineModule'
            ],
            'apcu' => [
                'class' => 'Doctrine\\Common\\Cache\\ApcuCache',
                'namespace' => 'DoctrineModule'
            ],
            'array' => [
                'class' => 'Doctrine\\Common\\Cache\\ArrayCache',
                'namespace' => 'DoctrineModule'
            ],
            'filesystem' => [
                'class' => 'Doctrine\\Common\\Cache\\FilesystemCache',
                'directory' => 'data/DoctrineModule/cache',
                'namespace' => 'DoctrineModule'
            ],
            'memcache' => [
                'class' => 'Doctrine\\Common\\Cache\\MemcacheCache',
                'instance' => 'my_memcache_alias',
                'namespace' => 'DoctrineModule'
            ],
            'memcached' => [
                'class' => 'Doctrine\\Common\\Cache\\MemcachedCache',
                'instance' => 'my_memcached_alias',
                'namespace' => 'DoctrineModule'
            ],
            'predis' => [
                'class' => 'Doctrine\\Common\\Cache\\PredisCache',
                'instance' => 'my_predis_alias',
                'namespace' => 'DoctrineModule'
            ],
            'redis' => [
                'class' => 'Doctrine\\Common\\Cache\\RedisCache',
                'instance' => 'my_redis_alias',
                'namespace' => 'DoctrineModule'
            ],
            'wincache' => [
                'class' => 'Doctrine\\Common\\Cache\\WinCacheCache',
                'namespace' => 'DoctrineModule'
            ],
            'xcache' => [
                'class' => 'Doctrine\\Common\\Cache\\XcacheCache',
                'namespace' => 'DoctrineModule'
            ],
            'zenddata' => [
                'class' => 'Doctrine\\Common\\Cache\\ZendDataCache',
                'namespace' => 'DoctrineModule'
            ]
        ],
        'authentication' => [
            'odm_default' => [],
            'orm_default' => [
                'objectManager' => 'doctrine.entitymanager.orm_default'
            ]
        ],
        'authenticationadapter' => [
            'odm_default' => true,
            'orm_default' => true
        ],
        'authenticationstorage' => [
            'odm_default' => true,
            'orm_default' => true
        ],
        'authenticationservice' => [
            'odm_default' => true,
            'orm_default' => true
        ],
        'connection' => [
            'orm_default' => [
                'configuration' => 'orm_default',
                'eventmanager' => 'orm_default',
                'params' => [
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'username',
                    'password' => 'password',
                    'dbname' => 'database'
                ]
            ]
        ],
        'configuration' => [
            'orm_default' => [
                'metadata_cache' => 'array',
                'query_cache' => 'array',
                'result_cache' => 'array',
                'hydration_cache' => 'array',
                'driver' => 'orm_default',
                'generate_proxies' => true,
                'proxy_dir' => 'data/DoctrineORMModule/Proxy',
                'proxy_namespace' => 'DoctrineORMModule\\Proxy',
                'filters' => [],
                'datetime_functions' => [],
                'string_functions' => [],
                'numeric_functions' => [],
                'second_level_cache' => []
            ]
        ],
        'driver' => [
            'orm_default' => [
                'class' => 'Doctrine\\Persistence\\Mapping\\Driver\\MappingDriverChain',
                'drivers' => [
                    'Application\\Entity' => 'Application_driver'
                ]
            ],
            'Application_driver' => [
                'class' => 'Doctrine\\ORM\\Mapping\\Driver\\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    '/home/laminas/htdocs/module/Application/config/../src/Entity'
                ]
            ]
        ],
        'entitymanager' => [
            'orm_default' => [
                'connection' => 'orm_default',
                'configuration' => 'orm_default'
            ]
        ],
        'eventmanager' => [
            'orm_default' => []
        ],
        'sql_logger_collector' => [
            'orm_default' => []
        ],
        'mapping_collector' => [
            'orm_default' => []
        ],
        'entity_resolver' => [
            'orm_default' => []
        ],
        'migrations_configuration' => [
            'orm_default' => [
                'table_storage' => [
                    'table_name' => 'DoctrineMigrationVersions',
                    'version_column_name' => 'version',
                    'version_column_length' => 1024,
                    'executed_at_column_name' => 'executedAt',
                    'execution_time_column_name' => 'executionTime'
                ],
                'migrations_paths' => [],
                'migrations' => [],
                'all_or_nothing' => false,
                'check_database_platform' => true,
                'custom_template' => null,
                'dependency_factory_services' => []
            ]
        ],
        'migrations_cmd' => [
            'current' => [],
            'dumpschema' => [],
            'diff' => [],
            'generate' => [],
            'execute' => [],
            'latest' => [],
            'list' => [],
            'migrate' => [],
            'rollup' => [],
            'status' => [],
            'syncmetadatastorage' => [],
            'uptodate' => [],
            'version' => []
        ]
    ],
    'doctrine_factories' => [
        'cache' => 'DoctrineModule\\Service\\CacheFactory',
        'eventmanager' => 'DoctrineModule\\Service\\EventManagerFactory',
        'driver' => 'DoctrineModule\\Service\\DriverFactory',
        'authenticationadapter' => 'DoctrineModule\\Service\\Authentication\\AdapterFactory',
        'authenticationstorage' => 'DoctrineModule\\Service\\Authentication\\StorageFactory',
        'authenticationservice' => 'DoctrineModule\\Service\\Authentication\\AuthenticationServiceFactory',
        'connection' => 'DoctrineORMModule\\Service\\DBALConnectionFactory',
        'configuration' => 'DoctrineORMModule\\Service\\ConfigurationFactory',
        'entitymanager' => 'DoctrineORMModule\\Service\\EntityManagerFactory',
        'entity_resolver' => 'DoctrineORMModule\\Service\\EntityResolverFactory',
        'sql_logger_collector' => 'DoctrineORMModule\\Service\\SQLLoggerCollectorFactory',
        'mapping_collector' => 'DoctrineORMModule\\Service\\MappingCollectorFactory',
        'migrations_cmd' => 'DoctrineORMModule\\Service\\MigrationsCommandFactory'
    ],
    'controllers' => [
        'factories' => [
            'DoctrineModule\\Controller\\Cli' => 'DoctrineModule\\Service\\CliControllerFactory',
            'Application\\Controller\\IndexController' => 'Laminas\\Mvc\\Controller\\LazyControllerAbstractFactory'
        ]
    ],
    'console' => [
        'router' => [
            'routes' => [
                'doctrine_cli' => [
                    'type' => 'symfony_cli'
                ]
            ]
        ]
    ],
    'validators' => [
        'aliases' => [
            'DoctrineNoObjectExists' => 'DoctrineModule\\Validator\\NoObjectExists',
            'DoctrineObjectExists' => 'DoctrineModule\\Validator\\ObjectExists',
            'DoctrineUniqueObject' => 'DoctrineModule\\Validator\\UniqueObject'
        ],
        'factories' => [
            'DoctrineModule\\Validator\\NoObjectExists' => 'DoctrineModule\\Validator\\Service\\NoObjectExistsFactory',
            'DoctrineModule\\Validator\\ObjectExists' => 'DoctrineModule\\Validator\\Service\\ObjectExistsFactory',
            'DoctrineModule\\Validator\\UniqueObject' => 'DoctrineModule\\Validator\\Service\\UniqueObjectFactory'
        ]
    ],
    'form_elements' => [
        'aliases' => [
            'objectselect' => 'DoctrineModule\\Form\\Element\\ObjectSelect',
            'objectradio' => 'DoctrineModule\\Form\\Element\\ObjectRadio',
            'objectmulticheckbox' => 'DoctrineModule\\Form\\Element\\ObjectMultiCheckbox'
        ],
        'factories' => [
            'DoctrineModule\\Form\\Element\\ObjectSelect' => 'DoctrineORMModule\\Service\\ObjectSelectFactory',
            'DoctrineModule\\Form\\Element\\ObjectRadio' => 'DoctrineORMModule\\Service\\ObjectRadioFactory',
            'DoctrineModule\\Form\\Element\\ObjectMultiCheckbox' => 'DoctrineORMModule\\Service\\ObjectMultiCheckboxFactory'
        ]
    ],
    'hydrators' => [
        'factories' => [
            'Doctrine\\Laminas\\Hydrator\\DoctrineObject' => 'DoctrineORMModule\\Service\\DoctrineObjectHydratorFactory'
        ]
    ],
    'view_manager' => [
        'template_map' => [
            'laminas-developer-tools/toolbar/doctrine-orm-queries' => '/home/laminas/htdocs/vendor/doctrine/doctrine-orm-module/config/../view/laminas-developer-tools/toolbar/doctrine-orm-queries.phtml',
            'laminas-developer-tools/toolbar/doctrine-orm-mappings' => '/home/laminas/htdocs/vendor/doctrine/doctrine-orm-module/config/../view/laminas-developer-tools/toolbar/doctrine-orm-mappings.phtml',
            'layout/layout' => '/home/laminas/htdocs/module/Application/config/../view/layout/layout.phtml',
            'application/index/index' => '/home/laminas/htdocs/module/Application/config/../view/application/index/index.phtml',
            'error/404' => '/home/laminas/htdocs/module/Application/config/../view/error/404.phtml',
            'error/index' => '/home/laminas/htdocs/module/Application/config/../view/error/index.phtml'
        ],
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_path_stack' => [
            '/home/laminas/htdocs/module/Application/config/../view'
        ],
        'strategies' => [
            'ViewJsonStrategy'
        ]
    ],
    'laminas-developer-tools' => [
        'profiler' => [
            'collectors' => [
                'doctrine.sql_logger_collector.orm_default' => 'doctrine.sql_logger_collector.orm_default',
                'doctrine.mapping_collector.orm_default' => 'doctrine.mapping_collector.orm_default'
            ]
        ],
        'toolbar' => [
            'entries' => [
                'doctrine.sql_logger_collector.orm_default' => 'laminas-developer-tools/toolbar/doctrine-orm-queries',
                'doctrine.mapping_collector.orm_default' => 'laminas-developer-tools/toolbar/doctrine-orm-mappings'
            ]
        ]
    ]
];
