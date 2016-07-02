# MoreCo（モア子）＠SBCloud Hackathon 2016

## システム・アプリのインストール／ビルド／テスト方法

### Androidアプリのビルド／インストール
* 開発環境の必要な条件: Android Studio ver2.0 がおすすめです.  
  最新のAndroid SDK ,Android WearのSDKをダウンロードすることは必要です。 
* 下記のプロジェクトをFork and cloneする

#### Adnroid Wearアプリのビルド／インストール  

* Android Studioでプロジェクトを開いてビルドモードを「wear」を選択する
* Android Wearの設定を選択し、「開発者向けオプション」を設定する
* Android Studioで「ビルド」を選択して Android Wearでアプリケージョンが起動する


#### Android Phoneアプリのビルド／インストール

* Android Studioでプロジェクトを開いてビルドモードを「mobile」を選択する  
* Android 端末の設定を選択し、「開発者向けオプション」を設定する  
* Android Studioで「ビルド」を選択して Android端末でアプリケージョンが起動する

#### Androidアプリのテスト方法  

* Android端末で「Android Wear」というアプリをGoogle PlayからダウンロードしてAndroid端末とAndroid Wear の
ペリングを設定する   
* Android　端末でアプリを起動して母国語と通訳語を簡単に設定する   
* テスト入力枠に簡単な母国語の単語を入力して質問文を検索する。    
* 質問文を選択してから、アプリが自動的に通訳し、通知した質問文をAndroid Wearアプリに送って相手に見せる、
同時にAndroid端末で通訳語で質問文を読み上げる。

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

* Androidアプリからクエスチョンマーク（？）アイコンを押下して開く。

## 利用するオープンソースライブラリ一覧

|ライブラリ名|用途|配置場所若しくは依存性管理ファイル|URL|
|---|---|---|---|
|yii2 framework|ウェブシステムを開発する用PHPフレームワーク|https://github.com/umbalaconmeogia/MoreCo/blob/master/04.Source/morecoweb/composer.json|http://yiiframework.com|
|TinySegmenter（java移植版）|日本語の文章を分かち書きする|https://github.com/umbalaconmeogia/MoreCo/tree/master/04.Source/morecoandroid/mobile/src/main/java/moreco/eas/evolable/asia/moreco/searchtext/net/moraleboost|https://github.com/takscape/cmecab-java|

## Reference

Hackathon Project URL: http://www.hackathon.io/projects/11673
