<?php
$admin_options_defs=array();
$admin_options_defs['Administration']['Call_Scheduler']=array(
    'Schedulers',
    'LBL_SCHEDULER_ENTRY_TITLE',
    'LBL_SCHEDULER_ENTRY_DESC',
    'index.php?module=Contacts&action=Configure_Call_Scheduler'
);
$admin_group_header[] = array(
    'LBL_SCHEDULER_GROUP_TITLE',
    '',
    false,
    $admin_options_defs
);