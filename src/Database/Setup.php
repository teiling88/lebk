<?php declare(strict_types=1);

namespace SwagLebk\Database;

use SQLite3;

class Setup
{
    /** @var SQLite3 */
    private $connection;

    public function __construct(SQLite3 $connection)
    {
        $this->connection = $connection;
    }

    public function setup(): void
    {
        $this->connection->exec(
            'CREATE TABLE IF NOT EXISTS weekly_reports
            (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                weeknumber INT,
                positive   TEXT,
                negative   TEXT,
                learned    TEXT
            );'
        );
    }

    public function drop(): void
    {
        $this->connection->exec('DROP TABLE IF EXISTS weekly_reports;');
    }
}
