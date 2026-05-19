<?php

declare(strict_types=1);

namespace BOA\Odds\Tests;

use BOA\Odds\OddsSaver;
use PHPUnit\Framework\TestCase;

/**
 * @author shimomo
 */
final class OddsSaverTest extends TestCase
{
    /**
     * @psalm-var non-empty-string
     *
     * @var string
     */
    private string $tempDir;

    /**
     * @psalm-return void
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->tempDir = sys_get_temp_dir() . '/odd_saver_test_' . bin2hex(random_bytes(8));
        if (!mkdir($this->tempDir, 0755, true) && !is_dir($this->tempDir)) {
            $this->fail('Failed to create temp dir: ' . $this->tempDir);
        }
    }

    /**
     * @psalm-return void
     *
     * @return void
     */
    protected function tearDown(): void
    {
        if (is_dir($this->tempDir)) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($this->tempDir, \FilesystemIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::CHILD_FIRST
            );

            foreach ($files as $file) {
                $file->isDir() ? rmdir($file->getRealPath()) : unlink($file->getRealPath());
            }

            rmdir($this->tempDir);
        }
    }

    /**
     * @psalm-return void
     *
     * @return void
     */
    public function testSave(): void
    {
        $saver = new OddsSaver();
        $path = $this->tempDir . '/odds.json';

        $odds = [
            [
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

        $saver->save($odds, $path);

        $this->assertFileExists($path);

        $content = json_decode(file_get_contents($path), true);
        $this->assertArrayHasKey('odds', $content);
        $this->assertSame($odds, $content['odds']);
    }
}
