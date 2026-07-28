<?php

namespace Spatie\Holidays\Tests\Countries;

use Carbon\CarbonImmutable;
use Spatie\Holidays\Holidays;

it('can calculate nicaragua holidays', function () {
    CarbonImmutable::setTestNow('2024-01-01');

    $holidays = Holidays::for(country: 'ni')->get();

    expect($holidays)
        ->toBeArray()
        ->not()->toBeEmpty();

    expect(formatDates($holidays))->toMatchSnapshot();
});

it('includes holidays introduced by law 1272 from 2026', function () {
    $holidays = Holidays::for(country: 'ni', year: 2026)->get();

    expect(formatDates($holidays))
        ->toHaveCount(14)
        ->toContain(
            ['name' => 'Día de Rubén Darío', 'date' => '2026-01-18'],
            ['name' => 'Día nacional de la reconciliación y la paz', 'date' => '2026-02-02'],
            ['name' => 'Día de Augusto C. Sandino', 'date' => '2026-02-21'],
            ['name' => 'Día de Carlos Fonseca Amador', 'date' => '2026-11-08'],
        );
});

it('does not include law 1272 holidays before 2026', function () {
    $holidays = Holidays::for(country: 'ni', year: 2025)->get();

    expect(formatDates($holidays))
        ->toHaveCount(10)
        ->not->toContain(
            ['name' => 'Día de Rubén Darío', 'date' => '2025-01-18'],
            ['name' => 'Día nacional de la reconciliación y la paz', 'date' => '2025-02-02'],
            ['name' => 'Día de Augusto C. Sandino', 'date' => '2025-02-21'],
            ['name' => 'Día de Carlos Fonseca Amador', 'date' => '2025-11-08'],
        );
});
