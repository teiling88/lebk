<?php declare(strict_types=1);

namespace SwagLebk\Test\Unit;

use PHPUnit\Framework\TestCase;
use SwagLebk\Entity\WeeklyReportEntity;

class WeeklyReportEntityTest extends TestCase
{
    public function test_it_builds_entity_from_database_array(): void
    {
        $data = [
            'id' => 42,
            'weeknumber' => 52,
            'positive' => 'Not very much',
            'negative' => 'Everything',
            'learned' => 'i love php',
        ];

        $entity = WeeklyReportEntity::fromDatabaseArray($data);

        $this->assertEquals(42, $entity->getId());
        $this->assertEquals(52, $entity->getWeeknumber());
        $this->assertEquals('Not very much', $entity->getPositive());
        $this->assertEquals('Everything', $entity->getNegative());
        $this->assertEquals('i love php', $entity->getLearned());
    }
}
