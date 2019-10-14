<?php

namespace SwagLebk\Test\Integration;

use PHPUnit\Framework\TestCase;
use SQLite3;
use SwagLebk\Database\Setup;
use SwagLebk\Entity\WeeklyReportEntity;
use SwagLebk\Repository\WeeklyReportRepository;

class WeeklyReportRepositoryTest extends TestCase
{
    /**
     * @var SQLite3
     */
    private $connection;

    protected function setUp() :void
    {
        $this->connection = new SQLite3(__DIR__ . '/../../db/lebk_test.sqlite3');
        $db = new Setup($this->connection);
        $db->drop();
        $db->setup();
    }
    public function test_it_creates_entity(): void
    {
        $entity = new WeeklyReportEntity('42', 'something very positive', 'nothing negative', 'dunno');

        $b = $this->getRepository()->create($entity);

        $this->assertTrue($b);
        $result = $this->connection->query("SELECT * FROM weekly_reports WHERE `weeknumber` = '42'")->fetchArray(SQLITE3_ASSOC);
        $this->assertArrayHasKey('id', $result);
        unset($result['id']);
        $expected = [
            'weeknumber' => 42,
            'positive' => 'something very positive',
            'negative' => 'nothing negative',
            'learned' => 'dunno',
        ];
        $this->assertEquals($expected, $result);
    }

    public function test_it_updates_entity(): void
    {
        $this->connection->exec('INSERT INTO weekly_reports VALUES (42, null, null, null, null)');
        $entity = WeeklyReportEntity::fromDatabaseArray([
            'id' => 42,
            'weeknumber' => 52,
            'positive' => 'something very positive',
            'negative' => 'nothing negative',
            'learned' => 'dunno',
        ]);

        $b = $this->getRepository()->update($entity);

        $this->assertTrue($b);
        $result = $this->connection->query("SELECT * FROM weekly_reports WHERE `id` = '42'")->fetchArray(SQLITE3_ASSOC);
        $expected = [
            'id' => 42,
            'weeknumber' => 52,
            'positive' => 'something very positive',
            'negative' => 'nothing negative',
            'learned' => 'dunno',
        ];
        $this->assertEquals($expected, $result);
    }

    public function tes_it_deletes_entity(): void
    {
        $this->connection->exec('INSERT INTO weekly_reports VALUES (42, null, null, null, null)');

        $this->getRepository()->deleteById(42);

        $result = $this->connection->query("SELECT * FROM weekly_reports WHERE `weeknumber` = '42'")->fetchArray(SQLITE3_ASSOC);
        $this->assertFalse($result);
    }

    public function test_it_reads_all_entities(): void
    {
        $this->connection->exec('INSERT INTO weekly_reports VALUES
            (1, \'\', \'\', \'\', \'\'),
            (2, \'\', \'\', \'\', \'\'),
            (3, \'\', \'\', \'\', \'\'),
            (4, \'\', \'\', \'\', \'\')');

        $result = $this->getRepository()->read();

        $this->assertCount(4, $result);
    }

    public function test_it_reads_single_entity(): void
    {
        $this->connection->exec('INSERT INTO weekly_reports VALUES (42, 52, \'FOO\', \'BAR\', \'BAZ\')');

        $result = $this->getRepository()->readById(42);

        $this->assertEquals(42, $result->getId());
        $this->assertEquals(52, $result->getWeeknumber());
        $this->assertEquals('FOO', $result->getPositive());
        $this->assertEquals('BAR', $result->getNegative());
        $this->assertEquals('BAZ', $result->getLearned());
    }

    private function getRepository(): WeeklyReportRepository
    {
        return new WeeklyReportRepository($this->connection);
    }
}
