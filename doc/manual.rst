************
Better Trees
************

============
Introduction
============

What does it do?
================

This extension contains a library to build trees and a bunch of tree applications, 
namely an alternative page navigation tree, category trees, and tree selects to use
in your BE Forms. 

The library is designed build tree structures from the database and other sources 
of nested data like XML files. The examples generate trees from the database table 
"pages" and some other database tables. The tree structure can be accessed as
a nested array and as a linearized array of the same nested data.

The object orientated library is divied into data objects and rendering objects,
so that you can easily extend the classes to access other data sources like XML 
or the directory tree. You can render the generated trees to any form of output
by extending the rendering objects.

A tutor module below the main BE module "Help" presents different usage examples 
of the elements and vizualizes the data model. It also does live benchmarking 
based on your own data.

Screenshots
===========

============
Users manual
============

This extension is targeted to administrators and programmers. Users
will only meet with this library in form of navigation trees, selects, 
or other elements that represent trees.

==============
Administration
==============

Alternative pagetree
====================

===========
Development
===========

Concepts of the architecture
============================

The overall structure of the objects implements the fundamental concepts
known from the graytree library. In contrary to the graytree library
this library doesn't depend directly or indirectly on t3lib_browsetree,
but is programmed from scratch.

The whole tree generation is divided in two phases, 
the loading of the data and the rendering of the output, 
model and view. The first phase we call model. 
Data is loaded from different tables and maybe from other 
sources like XML. From the data the internal structure of 
the tree is created. The view phase does the rendering of 
that internal structure to a visible tree as HTML, 
XML or other formats of output. This give us best flexibility 
to do diffent things with the tree.

Both phases, model and view are representated by a few classes 
that together do the job. To achieve best performances we reuse 
objects, whereever possible and store the data into a common array. 
Both in the model and the view there is one object per node type. 
Every node type is typically stored in one DB table, 
so that we can say simplifying that we have two objects 
per table one for the model and one for the view. 

As example we could have two objects for pages 
and two for addresses. All node objects of the models are kept 
in one container. It's the same for the view. The objects for 
the nodes derive from the classes nodeModel and nodeView. 
The containers derive from treeModel and treeView.

For an application you will typically make 4 or more classes 
that derive from this 4 "abstract" classes. (They are not really 
abstract in terms of PHP5).

1. treeModelAbstract
2. nodeModelAbstract
3. treeViewAbstract
4. nodeViewAbstract

Actual class hierarchies of the tree
------------------------------------

* tx_trees_treeModelAbstract

  - tx_trees_treeModelForSelects (HTML select formatting)
  - tx_trees_treeModelForPageTree (adds mounts and all Jingles)

* tx_trees_nodeModelAbstract

  - tx_trees_nodeModelForTables

* tx_trees_treeViewAbstract
* tx_trees_nodeViewAbstract

Other classes of the extension
------------------------------------

tx_trees 
	By this class the extension is called from external.
tx_trees_configuration 
	Configurations used by tx_trees.
tx_trees_configurationAbstract
	Generic configuration class.
tx_trees_defaultPageTreeConfiguration
	Settings to create pagetrees.
tx_trees_div
	Collection of static functions.


Configuration objects for the classes of the pagetree
=====================================================

The main advantage of configuration objects is that you can transport all 
configurations and the logic in one object instead of passing lots configuration 
arrays from function to function and form class to class and calling lots of 
setters for one object. In TYPO3 there are different configuration places 
that have to be merged: extension configuration, userTS, pageTS, TCA. 
All merging of configuration can be done within the configuration object instead
of doing it in differet places.

The classes of the pagetree contain no default configurations. The complete 
configuration is passed in form of a configuration object. If you want to work 
with default configurations, you can define default configuration objects. 
An example for such an object is the class tx_trees_defaultPageTreeConfiguration.

A class is configured by passing a configuration object to the method configure().

$configurationObject = t3lib_div::makeInstance('tx_trees_defaultPageTreeConfiguration');
$treeModel = t3lib_div::makeInstance('tx_trees_treeModelForPageTree');
$treeModel->configure($configurationObject);

The method configure() retrieves the settings from the configuration object by 
calling the method get() for the required keys.

$value = $configurationObject->get($key);

The required keys of an object are defined within the internal varibale $requiredSettings
in form of a comma separated list. There is a unusual concept with this, to assure 
that all settings are given and that the develper quickly learns about all 
possibile settings. For each of the required keys the get() function of the
configuration object must answer with a value that is not null. If get() returns 
a null value the script is terminated with an error message. 

There may be situtions, where you don't want to set a value, because you don't want the 
object to use it. In this case you can give a value like 0, false or the empty string, but
the configuration object must answer with a value, to indicate that the setting was 
considered.

You can program your own configuration objects or fill the generic configuration 
object tx_trees_configurationAbstract with your settings.

You find examples for specialized configuration objects in:

 * tx_trees_configuration
 * tx_trees_defaultPageTreeConfiguration
 
 The usageExample functions in the different classes teach you, how to work with
 configuration objects.


Alternative pagetree
====================

Selects for your own extensions
===============================


=============
Configuration
=============

========
Tutorial
========

After installation and reload of the frameset you find a tutor module "Trees" 
below the main BE module "Help".

==============
Known Problems
==============

==== 
TODO
==== 

* Moving linecreation to nodes for abstract and derived
* zweite selectbox anpassen
* Popup information 
* Selecttypen: Vollpfad, Abgekürzter Pfad, Baum mit Icons, Baum nested UL
* Query Zugriffsrechte
* Tutor vollenden
* Dokumentation
* Alte API

==============
Change Log
==============

See file ChangeLog

=========
Plannning
=========

Mount Configuration
===================

The developer defines mount types for trees of own tables. 
The admin configures the mounts for users and groups.

Mount Types
	Mount point configurations are added to the users and the groups configuration
	by extending the $TCA configuration of the tables be_users and be_groups by a 
	column (group field) to select the mount points. 

Mount Point Table
	The mount points are stored in the table tx_trees_mounts. The main 
	field "mountpoint"contains a combined value of the mounted table and 
	the entry id in this form: tabletype_id.
	
	This table is related to be_users and be_groups by the tables 
	be_users_tx_trees_mounts_mm and be_groups_tx_trees_mounts_mm 

New Mounts
	New Mount points (access points) are configured in the administration 
	of users and groups. To do this we use a TCA groups field.

Roots
	All table entries with a parent ID of 0 are Roots. They are automatically 
	listed for admins.
	
	
	
	













