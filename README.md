# お問い合わせフォーム

## 環境構築

### Docker ビルド

1. git clone git@github.com:torch29/matsumoto-kadai1.git
2. docker-compose up -d --buiild

### Laravel 環境構築

1. docker-compose exec php bash
2. composer install を実行
3. cp .env.example .env を実行し、.env.example を .env にコピーする。
4. .env 内ファイルを開き、
   - DB_HOST=127.0.0.1 を DB_HOST=mysql に変更する。
   - DB_DATABASE, DB_USERNAME, DB_PASSWORD を任意に変更する。
5. php artisan key:generate
6. php artisan migrate
7. php artisan db:seed

## 使用技術

- PHP 7.4.9
- Laravel 8.83.8
- MySQL 8.0.26

## ER 図

```
categoriesテーブルとcontactsテーブルがあり、
category_idでリレーションされています。
```

![ER図](ER.drawio.png)

## 使用方法

- '/' から、お問い合わせの入力・送信ができます。
- '/admin' から、お問い合わせの管理画面に入れます。
  - 管理画面に入るためにはログインが必要です。
  - 初回利用時は管理者登録が必要です。ログイン画面右上の register から、登録してください。

## URL

- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/
