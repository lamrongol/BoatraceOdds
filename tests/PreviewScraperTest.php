<?php

declare(strict_types=1);

namespace BOA\Odds\Tests;

use BOA\Odds\OddsScraper;
use BOA\Odds\ScraperInterface;
use Carbon\CarbonImmutable as Carbon;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-import-type ScrapedStadiumRaces from ScraperInterface
 *
 * @author shimomo
 */
final class OddsScraperTest extends TestCase
{
    /**
     * @psalm-return void
     *
     * @return void
     */
    public function testScrape(): void
    {
        $mockScraper = $this->createMock(ScraperInterface::class);
        $mockScraper->method('scrapeOdds')
            ->with(Carbon::create(2025, 7, 15))
            ->willReturn([
                $this->testScrapeData(0),
            ]);
        $scraper = new OddsScraper($mockScraper);
        $odds = $scraper->scrape(Carbon::create(2025, 7, 15));
        $this->assertSame($this->testScrapeData(0), $odds);
    }

    /**
     * @psalm-param int $keyIndex
     * @psalm-return ScrapedStadiumRaces
     *
     * @param int $keyIndex
     * @return array
     */
    private function testScrapeData(int $keyIndex): array
    {
        return [
            $keyIndex => [
                'date' => '2025-01-01',
                'stadium_number' => 24,
                'number' => 1,
                'win_odds' => [
                    [
                        1 => 1.6,
                        2 => 3.7,
                        3 => 6,
                        4 => 7.6,
                        5 => 13,
                        6 => 12.2,
                    ],
                ],
            ],
        ];
    }
}
