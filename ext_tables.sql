# --------------------------------------------------------
#  Mounts
# --------------------------------------------------------

#
# Table structure for table 'tx_trees_mounts'
#
CREATE TABLE tx_trees_mounts (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    tstamp int(11) DEFAULT '0' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    cruser_id int(11) DEFAULT '0' NOT NULL,
    deleted tinyint(4) DEFAULT '0' NOT NULL,
    mountpoint blob NOT NULL,    
    PRIMARY KEY (uid),
    KEY parent (pid)
);

#
# Table structure for table 'be_groups_tx_trees_mounts_mm'
# 
#
CREATE TABLE be_groups_tx_trees_mounts_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'be_groups'
#
CREATE TABLE be_groups (
    tx_trees_mounts int(11) DEFAULT '0' NOT NULL
);

#
# Table structure for table 'be_users_tx_trees_mounts_mm'
# 
#
CREATE TABLE be_users_tx_trees_mounts_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'be_users'
#
CREATE TABLE be_users (
    tx_trees_mounts int(11) DEFAULT '0' NOT NULL
);

# --------------------------------------------------------
#  Examples
# --------------------------------------------------------


#
# Table structure for table 'tx_trees_examples'
#
CREATE TABLE tx_trees_examples (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    tstamp int(11) DEFAULT '0' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    cruser_id int(11) DEFAULT '0' NOT NULL,
	title tinytext NOT NULL,
    multiselect int(11) DEFAULT '0' NOT NULL,
    pagemultiselect int(11) DEFAULT '0' NOT NULL,
    singleselect tinytext NOT NULL,
    pagesingleselect tinytext NOT NULL,
        
    PRIMARY KEY (uid),
    KEY parent (pid)
);

#
# Table structure for table 'tx_trees_examples_regions'
#
CREATE TABLE tx_trees_examples_regions (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	parentid int(11) DEFAULT '0' NOT NULL,
	parenttable tinytext NOT NULL,
	title tinytext NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_trees_examples_entities'
#
CREATE TABLE tx_trees_examples_entities (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	parentid int(11) DEFAULT '0' NOT NULL,
	parenttable tinytext NOT NULL,
	title tinytext NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_trees_examples_products'
#
CREATE TABLE tx_trees_examples_products (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	parentid int(11) DEFAULT '0' NOT NULL,
	parenttable tinytext NOT NULL,
	header tinytext NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tx_trees_examples_buildings'
#
CREATE TABLE tx_trees_examples_buildings (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	parentid int(11) DEFAULT '0' NOT NULL,
	parenttable tinytext NOT NULL,
	header tinytext NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tx_trees_examples_multiselect_mm'
# 
#
CREATE TABLE tx_trees_examples_multiselect_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_trees_examples_pagemultiselect_mm'
# 
#
CREATE TABLE tx_trees_examples_pagemultiselect_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);

