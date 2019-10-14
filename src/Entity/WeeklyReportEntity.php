<?php declare(strict_types=1);

namespace SwagLebk\Entity;

class WeeklyReportEntity
{
    /** @var null|int */
    public $id;

    /** @var int */
    public $weeknumber;

    /** @var string */
    public $positive;

    /** @var string */
    public $negative;

    /** @var string */
    public $learned;

    public function __construct(int $weeknumber, string $positive, string $negative, string $learned)
    {
        $this->weeknumber = $weeknumber;
        $this->positive = $positive;
        $this->negative = $negative;
        $this->learned = $learned;
    }

    public static function fromPostValues(array $data): WeeklyReportEntity
    {
        return new self((int)$data['weeknumber'], $data['positive'], $data['negative'], $data['learned']);
    }

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

    public static function fromDatabaseArray(array $data): WeeklyReportEntity
    {
        $new = new self((int) $data['weeknumber'],$data['positive'],$data['negative'],$data['learned']);
        $new->setId((int) $data['id']);

        return $new;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getWeeknumber(): int
    {
        return $this->weeknumber;
    }

    public function setWeeknumber(int $weeknumber): void
    {
        $this->weeknumber = $weeknumber;
    }

    public function getPositive(): string
    {
        return $this->positive;
    }

    public function setPositive(string $positive): void
    {
        $this->positive = $positive;
    }

    public function getNegative(): string
    {
        return $this->negative;
    }

    public function setNegative(string $negative): void
    {
        $this->negative = $negative;
    }

    public function getLearned(): string
    {
        return $this->learned;
    }

    public function setLearned(string $learned): void
    {
        $this->learned = $learned;
    }
}
