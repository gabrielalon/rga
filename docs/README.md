Poprawiona baza danych:


```mysql
CREATE TABLE `rga_state` (
  `id` CHAR(36) NOT NULL COMMENT '(DC2Type:guid)' PRIMARY KEY,
  `is_editable` tinyint(1) NULL DEFAULT '0',
  `is_deletable` tinyint(1) NULL DEFAULT '0',
  `is_rejectable` tinyint(1) NULL DEFAULT '0',
  `is_finishable` tinyint(1) NULL DEFAULT '0',
  `is_closeable` tinyint(1) NULL DEFAULT '0',
  `is_sending_email` tinyint(1) NULL DEFAULT '1',
  `color_code` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `rga_dictionary` (
  `id` CHAR(36) NOT NULL COMMENT '(DC2Type:guid)' PRIMARY KEY,
  `type` varchar(128) NOT NULL,
  `is_deletable` tinyint(1) NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `rga_dictionary_lang` (
  `rga_dictionary_id` CHAR(36) NOT NULL COMMENT '(DC2Type:guid)',
  `country_code` varchar(2) NOT NULL,
  `entry` text NULL DEFAULT NULL,
  UNIQUE KEY `rga_dictionary_country_code` (`rga_dictionary_id`, `country_code`),
  CONSTRAINT `fk_rga_dictionary_lang_to_rga_dictionary` FOREIGN KEY (`rga_dictionary_id`) REFERENCES `rga_dictionary` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `rga_behaviour` (
  `id` CHAR(36) NOT NULL COMMENT '(DC2Type:guid)' PRIMARY KEY,
  `type` varchar(32) NOT NULL,
  `is_active` tinyint(1) NULL DEFAULT '0',
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `rga_behaviour_lang` (
  `rga_behaviour_id` CHAR(36) NOT NULL COMMENT '(DC2Type:guid)',
  `country_code` varchar(2) NOT NULL,
  `name` varchar(255) NULL DEFAULT NULL,
  UNIQUE KEY `rga_behaviour_country_code` (`rga_behaviour_id`, `country_code`),
  CONSTRAINT `fk_rga_behaviour_lang_to_rga_behaviour` FOREIGN KEY (`rga_behaviour_id`) REFERENCES `rga_behaviour` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `rga_transport_method` (
  `id` CHAR(36) NOT NULL COMMENT '(DC2Type:guid)' PRIMARY KEY,
  `courier` varchar(128) NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  KEY `is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `rga_transport_method_lang` (
  `rga_transport_method_id` CHAR(36) NOT NULL COMMENT '(DC2Type:guid)',
  `country_code` varchar(2) NOT NULL,
  `name` varchar(255) NULL DEFAULT NULL,
  UNIQUE KEY `rga_transport_method_country_code` (`rga_transport_method_id`, `country_code`),
  CONSTRAINT `fk_rga_transport_method_lang_to_rga_transport_method` FOREIGN KEY (`rga_transport_method_id`) REFERENCES `rga_transport_method` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `rga_transport_method_alias` (
  `id` CHAR(36) NOT NULL COMMENT '(DC2Type:guid)' PRIMARY KEY,
  `rga_transport_method_id` CHAR(36) NOT NULL COMMENT '(DC2Type:guid)',
  `name` int(10) unsigned NOT NULL,
  UNIQUE KEY `rga_transport_method_alias` (`rga_transport_method_id`,`name`),
  CONSTRAINT `fk_rga_transport_method_alias_to_rga_transport_method` FOREIGN KEY (`rga_transport_method_id`) REFERENCES `rga_transport_method` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_rga_transport_method_alias_to_core_domain_handler_alias` FOREIGN KEY (`name`) REFERENCES `core_domain_handler_alias` (`name`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `rga_event_stream` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `playhead` int(10) unsigned NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `metadata` longtext COLLATE utf8_unicode_ci NOT NULL,
  `recorded_on` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `type` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid_playhead` (`uuid`,`playhead`),
  KEY `recorded_on` (`recorded_on`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `rga` (
  `id` CHAR(36) NOT NULL COMMENT '(DC2Type:guid)' PRIMARY KEY,

  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  
  `date_of_creation` datetime NOT NULL,
  `object_item_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NULL DEFAULT '',
  `product_variant_id` int(10) unsigned NULL DEFAULT NULL,

  `rga_state_id` CHAR(36) NOT NULL COMMENT '(DC2Type:guid)',
  `rga_behaviour_id` CHAR(36) NOT NULL COMMENT '(DC2Type:guid)',
  `rga_transport_method_id` CHAR(36) NULL COMMENT '(DC2Type:guid)',

  `source_object_type` varchar(255) NOT NULL DEFAULT '',
  `source_object_id` int(10) NULL DEFAULT 0,

  `applicant_given_source_object_id` varchar(255) NULL DEFAULT '',
  `applicant_given_source_identification` varchar(255) NOT NULL,
  `applicant_given_product_name` varchar(255) NULL DEFAULT '',

  `applicant_reasons` text NULL,
  `applicant_expectations` text NULL,
  `applicant_descriptions_of_incident` text NULL,

  `applicant_email` varchar(255) NOT NULL DEFAULT '',
  `applicant_telephone` varchar(32) NOT NULL DEFAULT '',
  `applicant_full_name` varchar(255) NOT NULL DEFAULT '',
  `applicant_street_name` varchar(255) NOT NULL DEFAULT '',
  `applicant_building_number` varchar(10) NOT NULL DEFAULT '',
  `applicant_apartment_number` varchar(10) DEFAULT NULL,
  `applicant_postal_code` varchar(10) NOT NULL DEFAULT '',
  `applicant_city` varchar(255) NOT NULL DEFAULT '',
  `applicant_country_id` int(10) unsigned NOT NULL,

  `applicant_bank_account_number` varchar(255) NULL DEFAULT NULL,
  `applicant_bank_name` varchar(255) NULL DEFAULT NULL,

  `admin_notes` text NULL,
  `admin_notes_for_customer` text NULL,

  `is_product_received` tinyint(1) NULL DEFAULT '0',
  `is_cash_returned` tinyint(1) NULL DEFAULT '0',
  `is_product_returned` tinyint(1) NULL DEFAULT '0' COMMENT 'it means returned to customer',
  `is_deleted` tinyint(1) NULL DEFAULT '0',

  `package_sent` tinyint(1) NULL DEFAULT 0,
  `package_no` varchar(255) NULL DEFAULT NULL,
  `package_sent_at` datetime NULL DEFAULT NULL,

  `hash` varchar(64) NOT NULL,
  `individual_number` int(10) NOT NULL,
  `update_sequence` int(10) NULL DEFAULT 0,
  UNIQUE `hash` (`hash`),
  KEY `individual_number` (`individual_number`),
  KEY `rga_state_id` (`rga_state_id`),
  KEY `rga_behaviour_id` (`rga_behaviour_id`),
  KEY `rga_transport_method_id` (`rga_transport_method_id`),
  KEY `is_deleted` (`is_deleted`),
  KEY `update_sequence` (`update_sequence`),
  CONSTRAINT `fk_rga_to_rga_state` FOREIGN KEY (`rga_state_id`) REFERENCES `rga_state` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rga_to_rga_behaviour` FOREIGN KEY (`rga_behaviour_id`) REFERENCES `rga_behaviour` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rga_to_country` FOREIGN KEY (`applicant_country_id`) REFERENCES `country` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rga_to_rga_transport_method` FOREIGN KEY (`rga_transport_method_id`) REFERENCES `rga_transport_method` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `rga_applicant` (
  `id` CHAR(36) NOT NULL COMMENT '(DC2Type:guid)' PRIMARY KEY,
  `rga_id` CHAR(36) NOT NULL COMMENT '(DC2Type:guid)',
  `object_type` varchar(255) NOT NULL DEFAULT '',
  `object_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `rga_id` (`rga_id`),
  KEY `object` (`object_id`),
  CONSTRAINT `fk_rga_customer_integration_to_rga` FOREIGN KEY (`rga_id`) REFERENCES `rga` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `rga_attachment` (
  `id` CHAR(36) NOT NULL COMMENT '(DC2Type:guid)' PRIMARY KEY,
  `rga_id` CHAR(36) NOT NULL COMMENT '(DC2Type:guid)',
  `original_file_name` varchar(255) NOT NULL,
  `file_type` varchar(64) NOT NULL DEFAULT '',
  `file_name` varchar(48) NOT NULL DEFAULT '',
  KEY `rga_id` (`rga_id`),
  CONSTRAINT `fk_rga_attachment_to_rga` FOREIGN KEY (`rga_id`) REFERENCES `rga` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TRIGGER IF EXISTS rga_update_counter_trg;
DELIMITER $$
CREATE TRIGGER rga_update_counter_trg BEFORE UPDATE ON `rga`
	FOR EACH ROW
	BEGIN
		IF @skip_trigger IS NULL THEN
			SET @cv = 0;
			CALL `GetNextUpdateCounterFor`('rga', @cv);
			SET NEW.update_sequence = @cv;
		END IF;
	END; $$
DELIMITER ;

DROP TRIGGER IF EXISTS rga_insert_counter_trg;
DELIMITER $$
CREATE TRIGGER rga_insert_counter_trg BEFORE INSERT ON `rga`
	FOR EACH ROW
	BEGIN
		IF @skip_trigger IS NULL THEN
			SET @cv = 0;
			CALL `GetNextUpdateCounterFor`('rga', @cv);
			SET NEW.update_sequence = @cv;
		END IF;
	END; $$
DELIMITER ;

INSERT INTO object_update_counter ( object_type, `counter` ) VALUES ( 'rga', 0 );
UPDATE `rga` SET `update_sequence` = 0;
```
