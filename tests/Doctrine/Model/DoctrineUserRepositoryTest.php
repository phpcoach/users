<?php

namespace Infra\Tests\Doctrine\Model;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Domain\Model\UserRepository;
use Domain\Tests\Model\UserRepositoryTest;
use Infra\Doctrine\Model\DoctrineUserRepository;

/**
 * Class InMemoryUserRepositoryTest
 */
class DoctrineUserRepositoryTest extends UserRepositoryTest
{
    /**
     * @inheritDoc
     */
    public function getEmptyUserRepository(): UserRepository
    {
        $config = new Configuration();

        $params = [
            'user' => 'root',
            'password' => 'root',
            'driver' => 'pdo_sqlite',
            'path' => ":memory:",
        ];

        $connection = DriverManager::getConnection($params, $config);
        $schemaManager = $connection->getSchemaManager();

        $schema = $schemaManager->createSchema();
        $table = $schema->createTable('users');
        $table->addColumn('id', 'string');
        $table->addColumn('name', 'string');
        $table->addColumn('age', 'integer');
        $sql = $schema->toSql($connection->getDatabasePlatform());

        foreach ($sql as $query) {
            $connection->executeQuery($query);
        }

        return new DoctrineUserRepository($connection);
    }
}