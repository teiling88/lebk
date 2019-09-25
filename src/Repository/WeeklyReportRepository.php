<?php declare(strict_types=1);

namespace SwagLebk\Repository;

use SwagLebk\Entity\WeeklyReportEntity;

class WeeklyReportRepository
{
    private \SQLite3 $connection;

    public function __construct(\SQLite3 $connection)
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
            $weeklyReport = new WeeklyReportEntity();
            $weeklyReport->id = $row['id'];
            $weeklyReport->weeknumber = $row['weeknumber'];
            $weeklyReport->positive = $row['positive'];
            $weeklyReport->negative = $row['negative'];
            $weeklyReport->learned = $row['learned'];
            $entities[] = $weeklyReport;
        }

        return $entities;
    }

    public function readById(int $reportId): WeeklyReportEntity
    {
        $query = $this->connection->prepare('SELECT * FROM weekly_reports WHERE id = :id');
        $query->bindValue(':id', $reportId, SQLITE3_INTEGER);

        $row = $query->execute()->fetchArray(SQLITE3_ASSOC);

        $weeklyReport = new WeeklyReportEntity();
        $weeklyReport->id = $row['id'];
        $weeklyReport->weeknumber = $row['weeknumber'];
        $weeklyReport->positive = $row['positive'];
        $weeklyReport->negative = $row['negative'];
        $weeklyReport->learned = $row['learned'];

        return $weeklyReport;
    }

    public function create(WeeklyReportEntity $entity): bool
    {
        $sql = 'INSERT INTO weekly_reports 
                VALUES (
                        null,
                        ' . $entity->weeknumber . ",
                        '" . $entity->positive . "',
                        '" . $entity->negative . "',
                        '" . $entity->learned . "'
                        )";

        return $this->connection->exec($sql);
    }

    public function update(WeeklyReportEntity $entity): bool
    {
        $sql = 'UPDATE weekly_reports 
                SET weeknumber = ' . $entity->weeknumber . ",
                    positive = '" . $entity->positive . "',
                    negative = '" . $entity->negative . "',
                    learned = '" . $entity->learned . "'
                WHERE id = " . $entity->id;

        return $this->connection->exec($sql);
    }

    public function deleteById(int $reportId)
    {
        $sql = 'DELETE FROM weekly_reports WHERE id = :id';
        $query = $this->connection->prepare($sql);
        $query->bindValue(':id', $reportId);

        $query->execute();
    }
}
