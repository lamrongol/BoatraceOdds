<?php

declare(strict_types=1);

namespace BOA\Odds;

/**
 * @psalm-import-type ScrapedStadiumRaces from ScraperInterface
 *
 * @author shimomo
 */
final class OddsSaver
{
    /**
     * @psalm-param ScrapedStadiumRaces $odds
     * @psalm-param non-empty-string $path
     * @psalm-return void
     *
     * @param array $odds
     * @param string $path
     * @return void
     * @throws \RuntimeException
     */
    public function save(array $odds, string $path): void
    {
        $contents = json_encode(['odds' => $odds]);
        if ($contents === false) {
            throw new \RuntimeException("Failed to encode odds to JSON");
        }

        $dir = dirname($path);
        if (!is_dir($dir) && !mkdir($dir, 0755, true) && !is_dir($dir)) {
            throw new \RuntimeException("Failed to create directory: {$dir}");
        }

        if (file_put_contents($path, $contents) === false) {
            throw new \RuntimeException("Failed to save results to {$path}");
        }
    }
}
