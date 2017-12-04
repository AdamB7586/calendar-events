<?php

namespace Calendar;

class Export extends Events{
    
    public function getFullCalenendarJSON($events, $instructor = false){
        header("Content-type: text/javascript");
        $array = array();
        foreach($events as $i => $event){
            $eventColors = $this->eventColors($event['type']);
            $array[$i]['id'] = intval($event['id']);
            $array[$i]['title'] = $event['event'].($instructor === false ? ' - '.$this->event->getEventType($event['type']) : '');
            $array[$i]['start'] = date('Y-m-d H:i', strtotime($event['start']));
            $array[$i]['end'] = date('Y-m-d H:i', strtotime($event['end']));
            $array[$i]['allDay'] = false;
            $array[$i]['color'] = $eventColors['background'];
            if(isset($eventColors['font'])){$array[$i]['textColor'] = $eventColors['font'];}
            $array[$i]['className'] = $event['type'];
            if($instructor !== false){$array[$i]['url'] = "/student/lessons?editid=".$event['id']."#editevent";}
        }
        echo(json_encode($array));
    }
    
    public function csvExport($userID, $type){
        header("Content-type: text/csv");
        header('Content-disposition: attachment; filename=LDC_Calendar_Export.csv');
        
        $data = "Subject, Start Date, Start Time, End Date, End Time, All Day Event, Description, Location, Private\r\n";
        foreach($this->getEvents($userID, $type) as $event){
            $data.= $event['event'].','.date('d/m/y', strtotime($event['start'])).','.date('H:i:s', strtotime($event['start'])).','.date('d/m/y', strtotime($event['end'])).','.date('H:i:s', strtotime($event['end'])).",False,".$this->getEventType(($event['type'] - 1)).", ,True\r\n";
        }
        echo($data);
    }
    
    public function iCalExport($userID, $type){
        header("Content-type: text/calendar");
        header('Content-disposition: attachment; filename=LDC_Calendar_Export.ics');
        $data = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//LDC/StudentPortal//NONSGML v1.0//EN
CALSCALE:GREGORIAN
METHOD:PUBLISH
X-PUBLISHED-TTL:PT15M
X-WR-TIMEZONE:Europe/London
";
        foreach($this->getEvents($userID, $type) as $event){
            $data.= $this->iCalEvent($event);
        }
        $data.= "END:VCALENDAR";
        echo($data);
    }
    
    private function iCalEvent($event){
        return "BEGIN:VEVENT
DTSTART:".date('Ymd\THis', strtotime($event['start']))."
DTEND:".date('Ymd\THis', strtotime($event['end']))."
DTSTAMP:".date('Ymd\THis', strtotime($event['start']))."
DESCRIPTION:".$this->getEventType(($event['type'] - 1))."
STATUS:CONFIRMED
SUMMARY:".$event['event']."
TRANSP:OPAQUE
SEQUENCE:0
UID:LDC".md5($event['id'].$event['last_updated'])."
END:VEVENT
";
    }
}
