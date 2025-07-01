# Speed Clicker

Laravel 10 と Vanilla JS で作るリアクションタイム計測アプリ

---

## デモ

> **本番 URL**: [https://your-demo-url.example](https://your-demo-url.example)
>
> **スクリーンショット / GIF**: （後日追加予定）

---

## 目的

| なぜ作ったか                       | ポートフォリオで示したいこと                            |
| ---------------------------- | ----------------------------------------- |
| Laravel + JS のフルスタック実装力をアピール | 認証、REST API、Eloquent、Vite、Tailwind を一通り使用 |
| クリーンコードとテストの姿勢を示す            | Form Request、PHPUnit、ESLint を採用           |
| デプロイワークフローを体験                | CI→CD→Render/Fly.io へ無料公開                 |

---

## コア機能

* ゲーム: 5 回の反応時間を計測し平均を算出
* 認証: Breeze（セッションログイン）
* API: `POST /api/scores` で平均スコアを保存
* 履歴ページ: 自分のスコア一覧 （TODO）
* ランキング: 全体トップ10 （TODO）
* 管理者機能: ユーザー・スコア削除 （TODO）

---

## 技術スタック

| レイヤ     | 技術                                | 補足                         |
| ------- | --------------------------------- | -------------------------- |
| バックエンド  | Laravel 10.x / PHP 8.2            | Breeze + Blade、Sanctum（任意） |
| フロントエンド | Vanilla JS、Vite、Tailwind CSS      | Alpine.js で簡易 UI 制御        |
| データベース  | SQLite（開発） → MySQL/PostgreSQL（本番） | Eloquent ORM               |
| テスト     | PHPUnit、Vitest （TODO）             | GitHub Actions で CI        |
| ホスティング  | Render / Fly.io                   | Docker なしデプロイ              |

---

## ER 図 / アーキテクチャ

```
users
└─ id PK
   name
   email
   password

scores
└─ id PK
   user_id FK → users.id ON DELETE CASCADE
   average_score FLOAT
   created_at
```

（Mermaid 図を後日追加予定）

---

## ローカル環境構築

```
git clone https://github.com/yourname/speed-clicker.git
cd speed-clicker
composer install

npm install
npm run dev &

cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate

php artisan serve
```

---

## デプロイ手順（概要）

1. GitHub に push
2. Render か Fly.io と連携し環境変数を設定
3. Build コマンド: `composer install && npm ci && npm run build`
4. デプロイフックで `php artisan migrate --force` を実行

（詳細手順は後日追記予定）

---

## テスト

* PHPUnit: モデル・API のユニット / フィーチャテスト
* JS: 平均計算ロジックのユニットテスト （TODO）
* E2E: Playwright/Cypress でクリックフロー （Nice-to-have）

---

## TODO

* [ ] 履歴ページ (`/history`) の実装
* [ ] ランキングページ (`/ranking`) の実装
* [ ] 管理ダッシュボード
* [ ] ページネーションと CSV エクスポート
* [ ] レスポンシブ対応とダークモード
* [ ] CI: PHPStan、ESLint、PHPUnit を PR 時に実行
* [ ] 画面キャプチャとデモ URL を README に追加
* [ ] Mermaid ER 図を README に追加
* [ ] Vitest で平均計算ロジックをテスト

---

## 作者

* Name: Kumiko "くみちゃん" Doi
* TechAcademy ブートキャンプ（PHP/Laravelコース）卒業 2025
* Portfolio: [https://your-portfolio.example](https://your-portfolio.example)

---

バグ報告や改善提案は Issues/PR でお知らせください。
