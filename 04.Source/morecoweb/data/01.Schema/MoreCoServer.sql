\encoding utf8

-- Project Name : MoreCo
-- Date/Time    : 2016/07/03 2:14:05
-- Author       : Thanh
-- RDBMS Type   : PostgreSQL
-- Application  : A5:SQL Mk-2

-- 辞書バージョン
drop table if exists "dict_version" cascade;

create table "dict_version" (
  "id" serial not null
  , "version" text not null
  , "comment" text
  , "data_status" integer default 1 not null
  , "create_time" timestamp
  , "create_user_id" integer
  , "update_time" timestamp
  , "update_user_id" integer
  , constraint "dict_version_PKC" primary key ("id")
) ;

-- ユーザ
drop table if exists "app_user" cascade;

create table "app_user" (
  "id" serial not null
  , "account" text not null
  , "password" text
  , "email" text not null
  , "role" integer default 0 not null
  , "data_status" integer default 1 not null
  , "create_time" timestamp
  , "create_user_id" integer
  , "update_time" timestamp
  , "update_user_id" integer
  , constraint "app_user_PKC" primary key ("id")
) ;

-- 回答
drop table if exists "reply" cascade;

create table "reply" (
  "id" serial not null
  , "ask_id" integer not null
  , "reply_content" text not null
  , "parent_reply_id" integer
  , "reply_user_id" integer not null
  , "vote" integer
  , "data_status" integer default 1 not null
  , "create_time" timestamp
  , "create_user_id" integer
  , "update_time" timestamp
  , "update_user_id" integer
  , constraint "reply_PKC" primary key ("id")
) ;

-- 質問
drop table if exists "ask" cascade;

create table "ask" (
  "id" serial not null
  , "from_language_id" integer not null
  , "to_language_id" integer not null
  , "ask_content" text not null
  , "ask_user_id" integer
  , "answer_status" integer default 0 not null
  , "answer_dict_sentence_id" integer
  , "answer_dict_sentence_param" text
  , "data_status" integer default 1 not null
  , "create_time" timestamp
  , "create_user_id" integer
  , "update_time" timestamp
  , "update_user_id" integer
  , constraint "ask_PKC" primary key ("id")
) ;

-- 翻訳文
drop table if exists "dict_sentence_translation" cascade;

create table "dict_sentence_translation" (
  "id" serial not null
  , "dict_language_id" integer not null
  , "dict_sentence_id" integer not null
  , "translated_sentence" text not null
  , "searching_text" text
  , "data_status" integer default 1 not null
  , "create_time" timestamp
  , "create_user_id" integer
  , "update_time" timestamp
  , "update_user_id" integer
  , constraint "dict_sentence_translation_PKC" primary key ("id")
) ;

-- 文
drop table if exists "dict_sentence" cascade;

create table "dict_sentence" (
  "id" serial not null
  , "data_status" integer default 1 not null
  , "create_time" timestamp
  , "create_user_id" integer
  , "update_time" timestamp
  , "update_user_id" integer
  , constraint "dict_sentence_PKC" primary key ("id")
) ;

-- 言語名
drop table if exists "dict_language_name" cascade;

create table "dict_language_name" (
  "id" serial not null
  , "dict_language_id" integer not null
  , "in_language_id" integer not null
  , "name" text not null
  , "data_status" integer default 1 not null
  , "create_time" timestamp
  , "create_user_id" integer
  , "update_time" timestamp
  , "update_user_id" integer
  , constraint "dict_language_name_PKC" primary key ("id")
) ;

-- 言語マスタ
drop table if exists "dict_language" cascade;

create table "dict_language" (
  "id" serial not null
  , "code" text not null
  , "data_status" integer default 1 not null
  , "create_time" timestamp
  , "create_user_id" integer
  , "update_time" timestamp
  , "update_user_id" integer
  , constraint "dict_language_PKC" primary key ("id")
) ;

comment on table "dict_version" is '辞書バージョン	 辞書バージョン';
comment on column "dict_version"."id" is 'ID';
comment on column "dict_version"."version" is 'バージョン番号';
comment on column "dict_version"."comment" is 'コメント';
comment on column "dict_version"."data_status" is '1: new, 2: update, 9: delete';

comment on table "app_user" is 'ユーザ';
comment on column "app_user"."id" is 'ID';
comment on column "app_user"."account" is '回答内容';
comment on column "app_user"."password" is '回答親ID';
comment on column "app_user"."email" is '回答者ID';
comment on column "app_user"."role" is '権限	 0: normal, 1: admin';
comment on column "app_user"."data_status" is '1: new, 2: update, 9: delete';

comment on table "reply" is '回答';
comment on column "reply"."id" is 'ID';
comment on column "reply"."ask_id" is '質問ID';
comment on column "reply"."reply_content" is '回答内容';
comment on column "reply"."parent_reply_id" is '回答親ID';
comment on column "reply"."reply_user_id" is '回答者ID';
comment on column "reply"."vote" is '投票	 For only reply level 1';
comment on column "reply"."data_status" is '1: new, 2: update, 9: delete';

comment on table "ask" is '質問';
comment on column "ask"."id" is 'ID';
comment on column "ask"."from_language_id" is 'from言語ID';
comment on column "ask"."to_language_id" is 'to言語ID';
comment on column "ask"."ask_content" is '質問内容';
comment on column "ask"."ask_user_id" is '質問者';
comment on column "ask"."answer_status" is '回答状況	 0: not reply, 1: replied, 2: closed';
comment on column "ask"."answer_dict_sentence_id" is '回答辞書ID';
comment on column "ask"."answer_dict_sentence_param" is '回答辞書パラメータ';
comment on column "ask"."data_status" is '1: new, 2: update, 9: delete';

comment on table "dict_sentence_translation" is '翻訳文	 言語別の分の翻訳';
comment on column "dict_sentence_translation"."id" is 'ID';
comment on column "dict_sentence_translation"."dict_language_id" is '言語ID';
comment on column "dict_sentence_translation"."dict_sentence_id" is '文ID';
comment on column "dict_sentence_translation"."translated_sentence" is '翻訳';
comment on column "dict_sentence_translation"."searching_text" is '検索テキスト';
comment on column "dict_sentence_translation"."data_status" is '1: new, 2: update, 9: delete';

comment on table "dict_sentence" is '文	 文のマスタID';
comment on column "dict_sentence"."id" is 'ID';
comment on column "dict_sentence"."data_status" is '1: new, 2: update, 9: delete';

comment on table "dict_language_name" is '言語名	 言語別での言語名';
comment on column "dict_language_name"."id" is 'ID';
comment on column "dict_language_name"."dict_language_id" is '言語ID';
comment on column "dict_language_name"."in_language_id" is '翻訳言語	 指定する言語';
comment on column "dict_language_name"."name" is '言語名	 指定した言語での言語名前';
comment on column "dict_language_name"."data_status" is '1: new, 2: update, 9: delete';

comment on table "dict_language" is '言語マスタ	 全ての言語のID';
comment on column "dict_language"."id" is 'ID';
comment on column "dict_language"."code" is '言語コード	 2 characters of language code, for example en, jp, vn';
comment on column "dict_language"."data_status" is '1: new, 2: update, 9: delete';

