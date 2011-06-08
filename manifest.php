<?php
$manifest = array(
    'acceptable_sugar_versions' => array(),
    'acceptable_sugar_flavors' => array(
		'CE','PRO','ENT'
	),
    'key'=>'PSI',
	'author' => 'Matthew Poer, Profiling Solutions',
	'description' => 'Automatically schedule calls when new Contacts and Leads are created',
    'is_uninstallable' => true,
	'name' => 'Call Auto-Schedule (from Profiling Solutions)',
	'published_date' => '2011-06-07 08:00:00',
	'type' => 'module',
	'version' => '1.0',
);
$installdefs = array (
    'id' => 'PSI_Call_Schedule',
    'copy' => array(
        array(
            'from' => '<basepath>/custom',
            'to' => 'custom',
        ),
    ),
    'language' => array(
        array(
            'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Language/en_us.Call_Scheduler.php',
            'to_module' => 'Administration',
            'language' => 'en_us',
        ),
    ),
    'logic_hooks' => array(
        array(
            'module' => 'Contacts',
            'hook' => 'before_save',
            'order' => 99,
            'description' => 'Automatically Schedule a Call to this Contact',
            'file' => 'custom/modules/Contacts/Call_Scheduler.php',
            'class' => 'Scheduler',
            'function' => 'Schedule_Contact_Call',
        ),
        array(
            'module' => 'Leads',
            'hook' => 'before_save',
            'order' => 99,
            'description' => 'Automatically Schedule a Call to this Lead',
            'file' => 'custom/modules/Contacts/Call_Scheduler.php',
            'class' => 'Scheduler',
            'function' => 'Schedule_Lead_Call',
        ),
    ),
);

