<?php
global $current_user,$db,$mod_strings,$sugar_config;
if(!$current_user->is_admin){
    sugar_die('You must be an administrator to configure the Call Scheduler');
}
if(isset($_POST['call'])){
    require_once('modules/Configurator/Configurator.php');
    $configurator = new Configurator();
    $call = $_POST['call'];
    foreach($call as $key => $value){
        $configurator->config['call_scheduler'][$key] = $value;
    }
    // checkboxes aren't submitted if they aren't checked... check if it's unchecked
    if(!isset($call['active'])){
        $configurator->config['call_scheduler']['active'] = FALSE;
    }
    $configurator->saveConfig();
    echo "<h2 style='color:red'>Configureation Saved, Thanks</h2>";
}

// get customized values if they exist
$leads = (isset($sugar_config['call_scheduler']['leads'])) ? $sugar_config['call_scheduler']['leads'] : '24';
$contacts = (isset($sugar_config['call_scheduler']['contacts'])) ? $sugar_config['call_scheduler']['contacts'] : '24';
$checked = (isset($sugar_config['call_scheduler']['active'])) ? $sugar_config['call_scheduler']['active'] : false;
$checkit = ($checked == 'on') ? 'checked="true"' : '';

// show the form
echo "<h2>Configure Call Auto-Scheduler</h2>";
echo <<<EOFORM
<form id='call_scheduler' action='index.php?module=Contacts&action=Configure_Call_Scheduler' method='POST'>
    <h3>Schedule the Call...</h3>
    <br>
    <input type='input' name='call[leads]' value="$leads" maxlength="5" size="3" /> <label for='call[leads]'>Hours after Lead is created.</label><br>
    <br>
    <input type='input' name='call[contacts]' value="$contacts" maxlength="5" size="3" /> <label for='call[contacts]'>Hours after Contact is created.</label><br>
    <br>
    <input type='checkbox' name='call[active]' $checkit /> <label for='call[active]'>Call Auto-Scheduler is Active</label><br>
    <br>
    <input type='submit' value='Save' />
</form>
EOFORM;

?>