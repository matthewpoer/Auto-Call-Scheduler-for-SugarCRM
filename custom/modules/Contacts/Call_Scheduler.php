<?php
class Scheduler {
    function Schedule_Contact_Call($bean, $event, $arguments){
        if($this->ShouldWeScheduleTheCall($bean)){
            $call_bean = $this->Create_Call($bean);
            $call_bean->load_relationship('contacts');
            $call_bean->contacts->add($bean->id);
        }
    }
    function Schedule_Lead_Call($bean, $event, $arguments){
       if($this->ShouldWeScheduleTheCall($bean)){
            $call_bean = $this->Create_Call($bean);
            $call_bean->load_relationship('leads');
            $call_bean->leads->add($bean->id);
        }
    }
    function Create_Call($bean){
        $call = new Call();
        $tomorrow = new DateTime();
        $tomorrow->modify('+'.$this->WhenToScheduleTheCall($bean->module_dir).' Hours');
        $call->date_start = $tomorrow->format('Y-m-d H:i:s');
        $call->duration_hours = '0';
        $call->duration_minutes = '30';
        $call->contact_id = $bean->id;
        $call->parent_id = $bean->id;
        $call->contact_name = $bean->name;
        $call->parent_name = $bean->name;
        $call->parent_type = $bean->module_dir;
        $call->direction = 'Outbound';
        $call->name = 'Introduction Call';
        $call->save();
        return $call;
    }
    function ShouldWeScheduleTheCall($bean){
        global $sugar_config;
        $active = $sugar_config['call_scheduler']['active'];
        if(!$bean->fetched_row && $active == 'on'){
            return true;
        } else {
            return false;
        }
    }
    function WhenToScheduleTheCall($type){
        //$leads = $sugar_config['call_scheduler']['leads'];
        //$contacts = $sugar_config['call_scheduler']['contacts'];
        global $sugar_config;
        switch($type){
            case 'Contacts':
                $time = $sugar_config['call_scheduler']['contacts'];
                break;
            case 'Leads':
                $time = $sugar_config['call_scheduler']['leads'];
                break;
            default:
                $time = "24";
                break;
        }
        return $time;
    }
}