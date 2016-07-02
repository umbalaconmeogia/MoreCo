-- Project Name : MoreCo
-- Date/Time    : 2016/06/26 4:36:58
-- Author       : Thanh
-- RDBMS Type   : Sqlite
-- Application  : A5:SQL Mk-2

-- 設定
create table setting (
  _id integer not null
  , from_language_id integer not null
  , to_language_id integer not null
  , data_status integer not null
) ;

-- DL辞書
create table download_dict (
  _id integer not null
  , language_id integer not null
  , version integer not null
  , data_status integer not null
) ;

-- 使用履歴
create table use_history (
  _id integer not null
  , language_id integer not null
  , sentence_id integer not null
  , use_count integer default 0
  , last_use datetime
  , data_status integer not null
) ;

-- 翻訳文
create table sentance_translation (
  _id integer not null
  , language_id integer not null
  , sentence_id integer not null
  , translated_sentence text
  , searching_text text
  , data_status integer not null
) ;

-- 文
create table sentence (
  _id integer not null
  , data_status integer not null
) ;

-- 言語名
create table language_name (
  _id integer not null
  , language_id integer not null
  , name text not null
  , data_status integer not null
) ;

-- 言語マスタ
create table language (
  _id integer not null
  , code text not null
  , data_status integer not null
) ;
/*
comment on table setting is '設定	 アプリ設定';
comment on column setting._id is 'ID';
comment on column setting.from_language_id is 'from言語ID';
comment on column setting.to_language_id is 'to言語ID';
comment on column setting.data_status is 'レコード状態	 1: new, 2: update, 9: delete';

comment on table download_dict is 'DL辞書	 辞書ダウンロード管理';
comment on column download_dict._id is 'ID';
comment on column download_dict.language_id is '言語ID';
comment on column download_dict.version is 'バージョン	 指定した言語での言語名前';
comment on column download_dict.data_status is 'レコード状態	 1: new, 2: update, 9: delete';

comment on table use_history is '使用履歴	 文の送信履歴';
comment on column use_history._id is 'ID';
comment on column use_history.language_id is '言語ID';
comment on column use_history.sentence_id is '文ID';
comment on column use_history.use_count is '使用回数';
comment on column use_history.last_use is 'ラスト使用';
comment on column use_history.data_status is 'レコード状態	 1: new, 2: update, 9: delete';

comment on table sentance_translation is '翻訳文	 言語別の分の翻訳';
comment on column sentance_translation._id is 'ID';
comment on column sentance_translation.language_id is '言語ID';
comment on column sentance_translation.sentence_id is '文ID';
comment on column sentance_translation.translated_sentence is '翻訳';
comment on column sentance_translation.searching_text is '検索テキスト';
comment on column sentance_translation.data_status is 'レコード状態	 1: new, 2: update, 9: delete';

comment on table sentence is '文	 文のマスタID';
comment on column sentence._id is 'ID';
comment on column sentence.data_status is 'レコード状態	 1: new, 2: update, 9: delete';

comment on table language_name is '言語名	 言語別での言語名';
comment on column language_name._id is 'ID';
comment on column language_name.language_id is '言語ID';
comment on column language_name.name is '言語名	 指定した言語での言語名前';
comment on column language_name.data_status is 'レコード状態	 1: new, 2: update, 9: delete';

comment on table language is '言語マスタ	 全ての言語のID';
comment on column language._id is 'ID';
comment on column language.code is '言語コード	 2 characters of language code, for example en, jp, vn';
comment on column language.data_status is 'レコード状態	 1: new, 2: update, 9: delete';
*/
