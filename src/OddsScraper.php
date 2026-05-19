<?php

declare(strict_types=1);

namespace BOA\Odds;

use Carbon\CarbonImmutable as Carbon;
use Carbon\CarbonInterface;

/**
 * @psalm-import-type ScrapedRaces from ScraperInterface
 * @psalm-import-type ScrapedStadiumRaces from ScraperInterface
 *
 * @author shimomo
 */
final class OddsScraper
{
    /**
     * @psalm-param \BOA\Odds\ScraperInterface $scraper
     *
     * @param \BOA\Results\ScraperInterface $scraper
     */
    public function __construct(private readonly ScraperInterface $scraper)
    {
        //
    }

    /**
     * @psalm-param \Carbon\CarbonInterface|string $date
     * @psalm-return ScrapedRaces
     *
     * @param \Carbon\CarbonInterface|string $date
     * @return array<int, NormalizedRaces>
     */
    public function scrape(CarbonInterface|string $date = 'today'): array
    {
        $date = Carbon::parse($date, 'Asia/Tokyo');
        /** @psalm-var ScrapedStadiumRaces $odds */
        $odds = $this->scraper->scrapeOdds($date);
        return $this->normalize($odds);
    }

    /**
     * @psalm-param ScrapedStadiumRaces $odds
     * @psalm-return ScrapedRaces
     *
     * @param array $results
     * @return array
     */
    private function normalize(array $odds): array
    {
        $newOdds = [];

        foreach (array_values($odds) as $data) {
            foreach (array_values($data) as $odd) {
                $odds['boats'] = isset($odd['boats'])
                    ? array_values($odd['boats'])
                    : [];

                $newOdds[] = $odd;
            }
        }

        /** @psalm-var ScrapedRaces */
        return $newOdds;
    }
}
