<?php

namespace Calendar;

class Export extends Events
{
    
    /**
     * Returns a JSON encode string with a list of events
     * @param array $events This should be an array of events
     * @param boolean $instructor If the current user is an instructor set to true else set to false (default = false)
     */
    public function getFullCalenendarJSON($events, $instructor = false)
    {
        header("Content-type: text/javascript");
        $array = [];
        foreach ($events as $i => $event) {
            $eventColors = $this->eventColors($event['type']);
            $array[$i]['id'] = intval($event['id']);
            $array[$i]['title'] = $event['event'].($instructor === false ? ' - '.$this->getEventType($event['type']) : '');
            $array[$i]['start'] = date('Y-m-d H:i', strtotime($event['start']));
            $array[$i]['end'] = date('Y-m-d H:i', strtotime($event['end']));
            $array[$i]['allDay'] = false;
            $array[$i]['color'] = $eventColors['background'];
            if (isset($eventColors['font'])) {
                $array[$i]['textColor'] = $eventColors['font'];
            }
            $array[$i]['className'] = $event['type'];
            if ($instructor !== false) {
                $array[$i]['url'] = "/student/lessons?editid=".$event['id']."#editevent";
            }
        }
        echo(json_encode($array));
    }
    
    /**
     * Produces a CSV export feature for calendar events
     * @param int $userID This should be the users unique ID
     * @param string $type The type of user you are retrieving the events for
     * @param string $exportName The name that you want to give to the file you are exporting
     */
    public function csvExport($userID, $type, $exportName = 'LDC_Calendar_Export')
    {
        header("Content-type: text/csv");
        header('Content-disposition: attachment; filename='.$exportName.'.csv');
        
        $data = '';
        $events = $this->getEvents($userID, $type);
        if (is_array($events)) {
            foreach ($events as $event) {
                $data.= strintf($event['event'], date('d/m/y', strtotime($event['start'])), date('H:i:s', strtotime($event['start'])), date('d/m/y', strtotime($event['end'])), date('H:i:s', strtotime($event['end'])), $this->getEventType(($event['type'] - 1)));
            }
        }
        printr(file_get_contents('exports\csv_export.txt'), $data);
    }
    
    /**
     * Produces a iCal export feature for calendar events (iOS devices)
     * @param int $userID This should be the users unique ID
     * @param string $type The type of user you are retrieving the events for
     * @param string $exportName The name that you want to give to the file you are exporting
     */
    public function iCalExport($userID, $type, $exportName = 'LDC_Calendar_Export')
    {
        header("Content-type: text/calendar");
        header('Content-disposition: attachment; filename='.$exportName.'.ics');
        $data = '';
        $events = $this->getEvents($userID, $type);
        if (is_array($events)) {
            foreach ($events as $event) {
                $data.= $this->iCalEvent($event);
            }
        }
        printf(file_get_contents('exports\ical_export.txt'), 'Europe/London', $data);
    }
    
    /**
     * Returns a single formatted event in iCal format
     * @param array $event This should be a single events details
     * @return string This will be a formatted event in iCal format
     */
    private function iCalEvent($event)
    {
        return sprintf(
            file_get_contents('exports\ical_event.txt'),
            date('Ymd\THis', strtotime($event['start'])),
            date('Ymd\THis', strtotime($event['end'])),
            $this->getEventType(($event['type'] - 1)),
            $event['event'],
            "LDC".md5($event['id'].$event['last_updated'])
        );
    }
}
