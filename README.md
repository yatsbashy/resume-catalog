# ResumeCatalog

## 概要

これは Laravel + Vue.js を使用した「履歴書・職務経歴書 管理アプリケーション」のベータ版です。

ただし 2019/11/7 現在は，管理者 ([yatsubashi](https://github.com/yatsubashi)) を紹介するアプリケーションとしてのみ機能しています。

https://www.resume-catalog.net

## 機能

このアプリケーションには主に以下の機能が実装されています。

- 認証
- REST-like API
- SPA (Single Page Application)
- DB トランザクション
- AWS S3 からの画像ファイル読み込み
- ユニットテスト
- CSRF (Cross-Site Request Forgeries) 対策
- 401, 404, 422, 500 エラーハンドリング および ナビゲーションガード

## 使用技術

### アプリケーション

- Laravel
- Vue.js
  - Vue.js
  - VueRouter
  - Vuex
- Sass (SCSS)
- Docker
  - docker-compose

### アーキテクチャ

- AWS ECS
  - Docker コンテナのデプロイ
- AWS ECR
  - ECS で使用する Docker コンテナレジストリ
- AWS RDS
  - MySQL エンジンを使用した RDB
- AWS S3
  - 画像ファイル用ストレージ
- AWS ELB
  - Application Load Balancer を使用したロードバランシング
- AWS Route 53
  - 独自ドメインの取得と DNS

<img src="https://resume-catalog.s3-ap-northeast-1.amazonaws.com/production/images/about/ResumeCatalog_architecture.jpg" width="500px">

## 使用方法

Docker と Node.js (v12.11.1 で動作確認済み) がインストールされている必要があります。

また，事前に AWS S3 の設定も必要です。

Mac OS X のみで動作確認済み，Windows では未確認です。

### 準備

```bash
git clone git@github.com:yatsubashi/resume-catalog.git
cd resume-catalog
```

### フロントエンド

npm コマンドはホスト OS (`resume-catalog` ディレクトリ) で実行します。

```bash
npm install
npm run development
```

監視モードでコンパイルする場合は以下。

```bash
npm install
npm run watch
```

### 環境変数

```bash
cp ./laravel/.env.prod ./laravel/.env
```

上記で作成した `.env` を以下の通り編集します。

```
...
DB_HOST=db
DB_PORT=3306
DB_DATABASE=local
DB_USERNAME=<任意>
DB_PASSWORD=<任意>
...
AWS_ACCESS_KEY_ID=<S3のアクセスキーID>
AWS_SECRET_ACCESS_KEY=<S3のシークレットアクセスキー>
AWS_DEFAULT_REGION=<S3のリージョン名>
AWS_BUCKET=<S3バケット名>
...
```

### サーバーサイド

docker-compose で Docker コンテナを起動します。

```bash
docker-compose up -d
```

起動したら Dcoker コンテナに入ります。

```bash
docker-compose exec app ash
```

以下の操作は Docker コンテナ (PHP-FPM のコンテナ) 内で行います。

```bash
composer install
php artisan artisan key:generate
php artisan migrate
```

以上が完了すれば http://localhost:9000 でブラウザからアクセスできます。
