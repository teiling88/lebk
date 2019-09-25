<?php declare(strict_types=1);

namespace SwagLebk\Entity;

class WeeklyReportEntity
{
    public int $id;

    public int $weeknumber;

    public string $positive;

    public string $negative;

    public string $learned;

    public function toDatabaseArray(): array
    {
        return [
            'id' => (int) $this->id,
            'weeknumber' => (int) $this->weeknumber,
            'positive' => $this->positive,
            'negative' => $this->negative,
            'learned' => $this->learned,
        ];
    }

    public function fromDatabaseArray(array $data): WeeklyReportEntity
    {
        $this->id = (int) $data['id'];
        $this->weeknumber = (int) $data['weeknumber'];
        $this->positive = $data['positive'];
        $this->negative = $data['negative'];
        $this->learned = $data['learned'];

        return $this;
    }
}
