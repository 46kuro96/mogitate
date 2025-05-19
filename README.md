# 確認テスト＿もぎたて

## 環境構築
**Dockerビルド**
1. `git clone git@github.com:estra-inc/mogitate.git`
2. DockerDesktopアプリを立ち上げる
3. `docker-compose up -d --build`

bash
mysql:
    platform: linux/x86_64
    image: mysql:8.0.26
    environment:


**Laravel環境構築**
1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルをコピーし、新しく.envファイルを作成
4. .envに以下の環境変数を追加
text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

5. アプリケーションキーの作成
bash
php artisan key:generate


6. マイグレーションの実行
bash
php artisan migrate


7. シーディングの実行
bash
php artisan db:seed


## 使用技術(実行環境)
- nginx:1.21.1
- PHP:7.4.9
- Laravel:8.83.8
- MySQL:8.0.26

## ER図


## URL
- 開発環境：http://localhost/
- phpMyAdmin:：http://localhost:8080/
