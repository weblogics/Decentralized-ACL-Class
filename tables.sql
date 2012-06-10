CREATE TABLE IF NOT EXISTS `aclpermissions` (
  `roleId` int(11) NOT NULL,
  `permissions` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `aclroles` (
  `identifier` int(11) NOT NULL,
  `roles` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
