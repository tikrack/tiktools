<?php return array(
    'root' => array(
        'name' => '__root__',
        'pretty_version' => 'dev-main',
        'version' => 'dev-main',
        'reference' => '542fb40204f075503e0f6a4e147ceeab4e5ceaf7',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        '__root__' => array(
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '542fb40204f075503e0f6a4e147ceeab4e5ceaf7',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'flightphp/core' => array(
            'pretty_version' => 'v3.14.0',
            'version' => '3.14.0.0',
            'reference' => '2762daf4f4725eae784291ac4ef21b04a6863be6',
            'type' => 'library',
            'install_path' => __DIR__ . '/../flightphp/core',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'laravel/pint' => array(
            'pretty_version' => 'v1.21.0',
            'version' => '1.21.0.0',
            'reference' => '531fa0871fbde719c51b12afa3a443b8f4e4b425',
            'type' => 'project',
            'install_path' => __DIR__ . '/../laravel/pint',
            'aliases' => array(),
            'dev_requirement' => true,
        ),
        'mikecao/flight' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '2.0.2',
            ),
        ),
    ),
);
