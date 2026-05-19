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
     * @param array $odds
     * @return array
     */
    private function normalize(array $odds): array
    {
        $newOdds = [];

        foreach (array_values($odds) as $data) {
            foreach (array_values($data) as $odd) {
                $oddsKeys = ['trifecta_odds', 'trio_odds', 'exacta_odds', 'quinella_place_odds', 'quinella_odds', 'win_odds', 'place_odds'];
                foreach ($oddsKeys as $key) {
                    $odds[$key] = isset($odds[$key])
                        ? array_values($odds[$key])
                        : [];
                }

                $newOdds[] = $odd;
            }
        }

        /** @psalm-var ScrapedRaces */
        return $newOdds;
    }
}
