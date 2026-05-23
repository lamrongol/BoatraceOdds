[![cron](https://github.com/lamrongol/BoatraceOdds/actions/workflows/cron.yml/badge.svg)](https://github.com/lamrongol/BoatraceOdds/actions/workflows/cron.yml)
# 🚤 Boatrace Open API for Odds
こちらは https://github.com/BoatraceOpenAPI/previews を元にしたオッズ版です

## ⚠️ 注意事項
>
> ⚡ 本 API は**非公式**であり、BOATRACE 公式サイト・団体とは一切関係ありません。<br>
> 🕒 データはリアルタイム更新ではなく、**約30分間隔で更新**されます。（ GitHub Actions のスケジュールは cron.yml を参照 ）<br>
> 🔍 データの正確性・完全性を保証するものではありません。<br>
> 🙇‍♂️ 利用は自己責任でお願いします。

## 📌 概要
この API では、ボートレース（ 競艇 ）の直前情報データを取得できます。<br>
データは GitHub Pages 上で公開されており、JSON 形式で提供されます。

## 🌐 エンドポイント

### [v3](https://github.com/lamrongol/BoatraceOdds/tree/gh-pages/docs/v3)

```bash
https://lamrongol.github.io/BoatraceOdds/v3/YYYY/YYYYMMDD.json
```

📅 YYYY → 年<br>
📅 YYYYMMDD → 年月日<br>
（ 日付は日本標準時 JST〔UTC+9〕基準 ）

※ 仕様上の欠陥により v1 は破棄されました。

## 🧩 サンプル

### [v3](https://github.com/lamrongol/BoatraceOdds/tree/gh-pages/docs/v3)

 - 2026年05月18日のオッズ
  - [https://lamrongol.github.io/BoatraceOdds/v3/2026/20260518.json](https://lamrongol.github.io/BoatraceOdds/v3/2026/20260518.json)
 本日のオッズ（ JST〔UTC+9〕基準 ）
  - [https://lamrongol.github.io/BoatraceOdds/v3/today.json](https://lamrongol.github.io/BoatraceOdds/v3/today.json) 

## 🔗 関連リポジトリ
| 🏷️ 対象 | 📂 リポジトリ |
|:--|:--|
| 🐆 出走表 | [Boatrace Open API for Programs](https://github.com/BoatraceOpenAPI/programs) |
| 🏆 結果 | [Boatrace Open API for Results](https://github.com/BoatraceOpenAPI/results) |

## 📄 ライセンス
Boatrace Open API for Previews は [MITライセンス](LICENSE) の元で公開されています。
