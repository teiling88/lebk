<?php declare(strict_types=1);

namespace SwagLebk\Repository;

use SQLite3;
use SwagLebk\Entity\WeeklyReportEntity;

class WeeklyReportRepository
{
    /** @var SQLite3 */
    private $connection;

    public function __construct(SQLite3 $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return WeeklyReportEntity[]
     */
    public function read(): array
    {
        $rawData = $this->connection->query('SELECT * FROM weekly_reports');
        $entities = [];
        while ($row = $rawData->fetchArray(SQLITE3_ASSOC)) {
            $weeklyReport = WeeklyReportEntity::fromDatabaseArray($row);
            $entities[] = $weeklyReport;
        }

        return $entities;
    }

    public function readById(int $reportId): WeeklyReportEntity
    {
        $query = $this->connection->prepare('SELECT * FROM weekly_reports WHERE id = :id');
        $query->bindValue(':id', $reportId, SQLITE3_INTEGER);

        $row = $query->execute()->fetchArray(SQLITE3_ASSOC);

        return WeeklyReportEntity::fromDatabaseArray($row);
    }

    public function create(WeeklyReportEntity $entity): bool
    {
        $sql = 'INSERT INTO weekly_reports VALUES (null, :week, :positive, :negative, :learned)';

        $query = $this->connection->prepare($sql);
        $query->bindValue(':week', $entity->getWeeknumber());
        $query->bindValue(':positive', $entity->getPositive());
        $query->bindValue(':negative', $entity->getNegative());
        $query->bindValue(':learned', $entity->getLearned());

        $result = $query->execute();
        return false !== $result;
    }

    public function update(WeeklyReportEntity $entity): bool
    {
        $sql = 'UPDATE weekly_reports 
                SET weeknumber = :week,
                    positive = :positive,
                    negative = :negative,
                    learned = :learned
                WHERE id = :id';

        $query = $this->connection->prepare($sql);
        $query->bindValue(':week', $entity->getWeeknumber());
        $query->bindValue(':positive', $entity->getPositive());
        $query->bindValue(':negative', $entity->getNegative());
        $query->bindValue(':learned', $entity->getLearned());
        $query->bindValue(':id', $entity->getId());

        $result = $query->execute();
        return false !== $result;
    }

    public function deleteById(int $reportId): void
    {
        $sql = 'DELETE FROM weekly_reports WHERE id = :id';
        $query = $this->connection->prepare($sql);
        $query->bindValue(':id', $reportId);

        $query->execute();
    }
}
