<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use BOA\Odds\OddsScraper;
use BOA\Odds\OddsSaver;
use BOA\Odds\ScraperAdapter;
use BVP\Scraper\Scraper;
use Carbon\CarbonImmutable as Carbon;

// コマンドライン引数からバージョンを取得（デフォルトは v3）
$version = $argv[1] ?? 'v3';

// 本日の日付を東京時間で取得
$date = Carbon::today('Asia/Tokyo');

// v2 or v3 の場合のみ OddsScraper を利用してオッズデータを取得
if ($version === 'v2' || $version === 'v3') {
    $scraperInstance = Scraper::getInstance();
    $scraperAdapter = new ScraperAdapter($scraperInstance);
    $scraper = new OddsScraper($scraperAdapter);

    // 指定日付のオッズデータをスクレイピング
    $odds = $scraper->scrape($date);
}

// オッズデータが取得できなかった場合は処理終了
if (empty($odds ?? [])) {
    exit;
}

// オッズデータを JSON ファイルとして保存
// 日付付きの JSON ファイルとして保存（例: docs/v3/2026/20260322.json）
// 最新データとして today.json にも保存
$storage = new OddsSaver();
$storage->save($odds, "docs/{$version}/" . $date->format('Y') . '/' . $date->format('Ymd') . '.json');
$storage->save($odds, "docs/{$version}/today.json");
