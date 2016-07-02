# MoreCo（モア子）＠SBCloud Hackathon 2016

## システム・アプリのインストール／ビルド／テスト方法

### Androidアプリのビルド／インストール
#### Adnroid Wearアプリのビルド／インストール

TODO (Trung)

#### Android Phoneアプリのビルド／インストール

TODO (Trung)

#### Androidアプリのテスト方法

### Webシステム

#### SBCloudにウェブサーバ（ECS）とDBサーバ（RDS）を作成する。

#### ウェブサーバ設定

* ウェブサーバ（ECS）に以下のソフトウェアをインストールする。
```sh
yum -y install php php-pdo php-pdo_pgsql php-mbstring
```
* /etc/hostsファイルに、morecowebとmorecodbのホスト名を定義する。
```
<ウェブサーバIP> morecoweb
<DBサーバIP> morecodb
```
* /etc/httpd/conf.d/morecoweb.chauhai.com.confを作成
```
NameVirtualHost *:443

<VirtualHost *:80>
  ServerName morecoweb.chauhai.com
  DocumentRoot /home/moreco/web/morecoweb/web
  ErrorLog "logs/morecoweb-error.log"
  CustomLog "logs/morecoweb-access.log" common

  <Directory /home/moreco/web/morecoweb/web>
    Require all granted
    AllowOverride all
    Order deny,allow
    Options -MultiViews
  </Directory>
</VirtualHost>
```

#### DBサーバ設定

* DBサーバ（RDS）にPostgreSQLをインストールし、ウェブサーバからPostgreSQLに接続できるように設定する。
データベースとユーザを作成する。

|情報|設定値|
|---|---|
|DB名|moreco|
|ユーザアカウント|moreco|
|パスワード|QZoNYD2nbp|
|ポート|3433|

#### 本プロジェクトのウェブアプリケーションのインストール

* システムのユーザmorecoを作成する。
* /home/moreco/web/フォルダに、本ソースコードのフォルダ04.Source/morecowebを配置する（/home/moreco/web/morecowebができる）
* フォルダ/home/moreco/web/morecoweb/runtimeのアクセスモードを777に設定する。
```
chmod 777 /home/moreco/web/morecoweb/runtime
```

#### テスト

httpdに設定したウェブドメインからアクセスする。
上記の設定では、http://morecoweb.chauhai.com
Androidアプリからもアクセスできる。

## 利用するオープンソースライブラリ一覧

TODO (Thanh)

## Reference

Hackathon Project URL: http://www.hackathon.io/projects/11673
