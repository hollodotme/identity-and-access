-- // Structure event store
-- Migration SQL that makes the change goes here.

USE `IdentityAndAccess`;
DROP TABLE IF EXISTS `EventStore`;
CREATE TABLE IF NOT EXISTS `EventStore` (
	`sequence`       BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
	COMMENT 'Sequence of global stream',
	`streamName`     VARCHAR(50)     NOT NULL
	COMMENT 'Name of a stream',
	`streamId`       VARCHAR(100)    NOT NULL
	COMMENT 'ID of a stream',
	`streamSequence` BIGINT UNSIGNED NOT NULL
	COMMENT 'Sequence of a stream',
	`eventId`        VARCHAR(500)    NOT NULL
	COMMENT 'Identifier of the event',
	`eventName`      VARCHAR(500)    NOT NULL
	COMMENT 'Plain text name of the event',
	`eventPayload`   LONGTEXT        NOT NULL
	COMMENT 'Payload of the event',
	`occurredOn`     DATETIME        NOT NULL
	COMMENT 'Timestamp the event occurred on',
	`actorName`      VARCHAR(100)    NOT NULL
	COMMENT 'Name of the actor who triggered the event',
	`serverId`       VARCHAR(100)    NOT NULL
	COMMENT 'Identitfier of the server which processed the event'
);

ALTER TABLE `EventStore`
	ADD UNIQUE KEY `Stream` (`streamName`, `streamId`, `streamSequence`);

-- //@UNDO
-- SQL to undo the change goes here.

USE `IdentityAndAccess`;

DROP TABLE IF EXISTS `EventStore`;