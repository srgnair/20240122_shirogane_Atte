# アプリケーション名
Atte（アット）

## 概要
勤怠管理システムアプリ
<img width="960" alt="スクリーンショット 2024-01-21 163058" src="https://github.com/srgnair/20240122_shirogane_Atte/assets/143247574/42a15fca-8ba3-4971-95e2-d2b8ee57cb82">


## サービスを作成した背景
勤怠管理による人事評価のために作りました。

## ~~アプリケーションURL~~
デプロイされていません。

## メイン機能
#### 新規会員登録
- 名前：メールアドレス・パスワードで新規会員登録ができます。
#### ログイン・ログアウト
- ヘッダーからログアウトができます。
#### 認証機能を利用
- メール認証で本人確認されたユーザーのみ機能が使えます。
#### 打刻（勤務開始・勤務終了）
- トップページから勤務開始・勤務終了の打刻ができます。
- 日をまたいだ時点で翌日の出勤に切り替えます。
#### 打刻（休憩開始・休憩終了）
- トップページから休憩開始・休憩終了の打刻ができます。	
- 1日で何度も休憩が可能です。
#### 日付別勤怠情報取得
- 日付ことに勤怠情報（勤務開始・勤務終了・休憩時間・~~勤務時間~~）の一覧を確認できます。
- （勤務時間取得の部分で、休憩時間を引く計算の処理が完成しませんでした。）
- ページネーション・表示件数が多い場合、5件ずつの取得になります。
#### ユーザー別勤怠情報取得
- ユーザーごとに1カ月ごとの勤怠情報（勤務開始・勤務終了・休憩時間・勤務時間）の一覧を確認できます。
#### ユーザー一覧
- ユーザー一覧からユーザー別勤怠情報取得ページへ移動できます。

## 使用技術

| カテゴリ       | 技術  |
| :------------- | :------------ |
| フレームワーク | Laravel version:3.8 |
| フロントエンド | blade / CSS |
| バックエンド   | php |
| データベース   | mySQL / phpmyadmin |
| 認証           | Fortify / mailhog |
| サーバー       | nginx:1.21.1 |

## テーブル設計
#### <img width="495" alt="スクリーンショット 2024-01-21 164125" src="https://github.com/srgnair/20240122_shirogane_Atte/assets/143247574/ef802118-39fa-48fa-b8fe-b7505c1e429c">  
  
#### <img width="495" alt="スクリーンショット 2024-01-21 164146" src="https://github.com/srgnair/20240122_shirogane_Atte/assets/143247574/4a226376-621d-4d3f-a7a4-478d5b4e84c3">  
  
#### <img width="494" alt="スクリーンショット 2024-01-21 164228" src="https://github.com/srgnair/20240122_shirogane_Atte/assets/143247574/b636ee62-8f90-4898-9f61-8d3b12adda46">  
  
## ER図
<img width="429" alt="スクリーンショット 2024-01-21 163809" src="https://github.com/srgnair/20240122_shirogane_Atte/assets/143247574/596a453e-1c44-4025-bcb0-d187209201b6">


## 環境構築

#### ディレクトリ構成
atte  
├── docker  
│&emsp;&emsp;├── mysql  
│&emsp;&emsp;│&emsp;&emsp;├── data  
│&emsp;&emsp;│&emsp;&emsp;└── my.cnf  
│&emsp;&emsp;├── nginx  
│&emsp;&emsp;│&emsp;&emsp;└── default.conf  
│&emsp;&emsp;└── php  
│&emsp;&emsp;&emsp;&emsp;&emsp;├── Dockerfile  
│&emsp;&emsp;&emsp;&emsp;&emsp;└── php.ini  
├── docker-compose.yml  
└── src  

#### パッケージのインストール
$ composer -v

#### プロジェクトの作成
$ composer create-project "laravel/laravel=8.*" . --prefer-dist

下記のローカル環境にアクセス
http://localhost/

## ほかに記載すること
時間が足りず、AWSまでできませんでした。
