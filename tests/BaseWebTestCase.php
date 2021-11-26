<?php

namespace App\Tests;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BaseWebTestCase extends WebTestCase
{
    /**
     * @var bool
     */
    protected bool $purge = false;

    protected static ?KernelBrowser $client = null;

    public function setUp(): void
    {
        parent::setUp();

        if (null === self::$client) {
            self::$client = static::createClient();
        }

        if ($this->purge) {
            $this->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->executeQuery();

            $tables = $this->getConnection()->fetchAllAssociative('SELECT Concat(\'TRUNCATE TABLE \',table_schema,\'.\',TABLE_NAME, \';\') as st
                FROM INFORMATION_SCHEMA.TABLES where  table_schema in (\'taskapp_test\');');

            foreach ($tables as $table) {
                if ($table['st'] === 'TRUNCATE TABLE taskapp_test.doctrine_migration_versions;') {
                    continue;
                }
                $this->executeSql($table['st']);
            }

            $this->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->executeQuery();


            /** @var EntityManager $entityManager */
            $entityManager = $this->getContainer()->get('doctrine.orm.default_entity_manager');
            $entityManager->clear();
        }
    }

    public function getConnection()
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine');
        return $entityManager->getConnection();
    }

    /**
     * @param $sql
     */
    private function executeSql($sql)
    {
        $orm = $this->getContainer()->get('doctrine');
        $orm->getConnection()->exec($sql);
    }
}
