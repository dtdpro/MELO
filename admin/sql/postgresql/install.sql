CREATE TABLE "#__melo_links" (
  "link_id" serial NOT NULL,
  "link_cat" bigint DEFAULT 0 NOT NULL,
  "link_name" character varying(100) DEFAULT '' NOT NULL,
  "link_alias" character varying(255) DEFAULT '' NOT NULL,
  "link_url" character varying(200) DEFAULT '' NOT NULL,
  "link_desc" text NOT NULL,
  "link_hits" bigint DEFAULT 0 NOT NULL,
  "state" smallint DEFAULT 0 NOT NULL,
  "checked_out" bigint DEFAULT 0 NOT NULL,
  "checked_out_time" timestamp without time zone DEFAULT '1970-01-01 00:00:00' NOT NULL,
  "ordering" bigint DEFAULT 0 NOT NULL,
  "access" bigint DEFAULT 1 NOT NULL,
  "created" timestamp without time zone DEFAULT '1970-01-01 00:00:00' NOT NULL,
  "created_by" integer DEFAULT 0 NOT NULL,
  "created_by_alias" character varying(255) DEFAULT '' NOT NULL,
  "modified" timestamp without time zone DEFAULT '1970-01-01 00:00:00' NOT NULL,
  "modified_by" integer DEFAULT 0 NOT NULL,
  "publish_up" timestamp without time zone DEFAULT '1970-01-01 00:00:00' NOT NULL,
  "publish_down" timestamp without time zone DEFAULT '1970-01-01 00:00:00' NOT NULL,
  PRIMARY KEY ("link_id")
);
CREATE INDEX "#__melo_links_access" ON "#__melo_links" ("access");
CREATE INDEX "#__melo_links_idx_checkout" ON "#__melo_links" ("checked_out");
CREATE INDEX "#__melo_links_idx_state" ON "#__melo_links" ("state");
CREATE INDEX "#__melo_links_idx_catid" ON "#__melo_links" ("link_cat");
CREATE INDEX "#__melo_links_idx_createdby" ON "#__melo_links" ("created_by");


