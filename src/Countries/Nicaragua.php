<?php

namespace Spatie\Holidays\Countries;

use Spatie\Holidays\Holiday;

class Nicaragua extends Country
{
    public function countryCode(): string
    {
        return 'ni';
    }

    protected function allHolidays(int $year): array
    {
        return array_merge([
            Holiday::national('Año nuevo', "{$year}-01-01"),
            Holiday::national('Día internacional de los trabajadores', "{$year}-05-01"),
            Holiday::national('Día de las madres', "{$year}-05-30"),
            Holiday::national('Aniversario de la revolución', "{$year}-07-19"),
            Holiday::national('Aniversario de la batalla de san jacinto', "{$year}-09-14"),
            Holiday::national('Aniversario de la independencia', "{$year}-09-15"),
            Holiday::national('Día de la inmaculada concepción', "{$year}-12-08"),
            Holiday::national('Navidad', "{$year}-12-25"),
        ], $this->holidaysIntroducedIn2026($year), $this->variableHolidays($year));
    }

    /** @return array<Holiday> */
    protected function holidaysIntroducedIn2026(int $year): array
    {
        if ($year < 2026) {
            return [];
        }

        return [
            Holiday::national('Día de Rubén Darío', "{$year}-01-18"),
            Holiday::national('Día nacional de la reconciliación y la paz', "{$year}-02-02"),
            Holiday::national('Día de Augusto C. Sandino', "{$year}-02-21"),
            Holiday::national('Día de Carlos Fonseca Amador', "{$year}-11-08"),
        ];
    }

    /** @return array<Holiday> */
    protected function variableHolidays(int $year): array
    {
        $easter = $this->easter($year);

        return [
            Holiday::national('Jueves santo', $easter->subDays(3)),
            Holiday::national('Viernes santo', $easter->subDays(2)),
        ];
    }
}
