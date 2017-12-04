<?php

namespace Calendar;

use PupilManagement\Pupils;

class Events extends Pupils{
    
    public $events = array('Driving Lesson', 'Theory Test', 'Driving Test', 'Other', 'Draft/Provisional Booking', 'Home Visit', 'Cancellation');
    public $tutorevents = array('Part 2 Training', 'Part 3 Training', 'ORDIT Training');
    
    protected $calendarTable = 'lessons_calendar';
    
    protected $colors = array(
        1 => array('background' => '#058dc7'/* Blue */),
        2 => array('background' => '#77ab13'/* Green */),
        3 => array('background' => '#ff3333'/* Red */),
        4 => array('background' => '#ffcc33'/* Yellow */, 'font' => '#000000'),
        5 => array('background' => '#4d4d4d'/* Black */),
        6 => array('background' => '#cc6633'/* Brown */),
        7 => array('background' => '#ff9933'/* Orange */, 'font' => '#000000'),
        8 => array('background' => '#ff0099'/* Pink */),
        9 => array('background' => '#2C4B76'/* Dark Blue */),
        10 => array('background' => '#755E00'/* Dark Yellow */),
        11 => array('background' => '#364800'/* Dark Green */)
    );
    
    /**
     * Set the table that the events are store in
     * @param string $table This should be the table name
     * @return $this Return the object for method chaining
     */
    public function setEventsTable($table){
        if(!empty(trim($table))){
            $this->calendarTable = trim($table);
        }
        return $this;
    }
    
    /**
     * Get the table that events are stored in
     * @return string This will be the events table
     */
    public function getEventsTable(){
        return $this->calendarTable;
    }
    
    /**
     * Gets all of the events for a given instructor
     * @param int $fino This should be the instructors unique fino
     * @return array|false If any events exist they will be returned as an array else if nothing exists will return false
     */
    public function instructorEvents($fino){
        return $this->getEvents($fino);
    }
    
    /**
     * Gets all of the events for a given student
     * @param int $pupil This should be the user unique user ID
     * @return array|false If any events exist they will be returned as an array else if nothing exists will return false
     */
    public function studentEvents($pupil){
        return $this->getEvents($pupil, 'pupil');
    }

    public function addLessonEvent($fino, $pupilID, $event, $startDate, $type){
        $dates = $this->getEventStartEndDates($date, $start_hour, $start_min, $length_hour, $length_min);
        return $this->db->insert($this->getEventsTable(), array('fino' => $fino, 'pupil' => $pupilID, 'event' => $event, 'start' => $dates['startdate'], 'end' => $dates['enddate'], 'type' => $type));
    }
    
    public function updateLessonEvent($fino, $eventID, $pupil, $event, $start, $end, $type){
        $dates = $this->getEventStartEndDates($date, $start_hour, $start_min, $length_hour, $length_min);
        return $this->db->update($this->getEventsTable(), array('pupil' => $pupil, 'event' => $event, 'start' => $dates['startdate'], 'end' => $dates['enddate'], 'type' => $type), array('id' => $eventID));
    }
    
    /**
     * Deletes an event from the database
     * @param int $fino This should be the instructors fino that is logged in or that you wish to delete the event for
     * @param int $lessonID This should be the unique ID of the event you are deleting 
     * @return boolean If the event is deleted will return true else returns false
     */
    public function deleteLessonEvent($fino, $lessonID){
        return $this->db->delete($this->getEventsTable(), array('fino' => $fino, 'id' => $lessonID));
    }
    
    /**
     * Changes the pupil ID associated with an event
     * @param int $origUserID This should be the pupil ID currently assigned to the events 
     * @param int $newUserID This should be the pupil ID you wish to now assign the events to
     * @return boolean If the update carries out successfully will return true else returns false
     */
    public function changeEventPupil($origUserID, $newUserID){
        return $this->db->update($this->getEventsTable(), array('pupil' => intval($newUserID)), array('pupil' => intval($origUserID)));
    }
    
    /**
     * Alias of changeEventPupil for legacy versions
     * @param int $origUserID This should be the pupil ID currently assigned to the events 
     * @param int $newUserID This should be the pupil ID you wish to now assign the events to
     * @return boolean If the update carries out successfully will return true else returns false
     */
    public function changeEventUser($origUserID, $newUserID){
        return $this->changeEventPupil($origUserID, $newUserID);
    }
    
    /**
     * 
     * @param int $fino
     * @param type $pupil
     * @param type $date
     * @return type
     */
    public function getDaysEvents($fino, $pupil = 0, $date = ''){
        if(empty($date)){$date = date('Y-m-d');}
        return $this->db->query("SELECT * FROM `".$this->getEventsTable()."` WHERE `fino` = ? AND (`start` >= ? AND `end` <= ?) OR (`start` <= ? AND `end` >= ?) ORDER BY `start` ASC;", array($fino, $date.' 00:00:00', $date.' 24:00:00', $date.' 00:00:00', $date.' 00:00:01'));
    }
    
    
    public function getLessonEvents($fino = 0, $id = 0, $startdate = '', $enddate = '', $type = 0, $pupil = 0, $order = 'ASC'){
        if(!empty($fino)){$where['fino'] = $fino;}
        if(!empty($startdate)){$where['start'] = $startdate;}
        if(!empty($enddate)){$where['end'] = $enddate;}
        if($id != 0){$where['id'] = $id; $limit = 1;}
        if($pupil != 0){$where['pupil'] = $pupil;}
        if($type != 0){$where['type'] = $type;}
        
        $events = $this->db->selectAll($this->getEventsTable(), $where, '*', array('start' => $order), intval($limit));
        if($limit == 1){
            $events['typeName'] = $this->getEventType($events['type']);
        }
        else{
            foreach($events as $i => $event){
                $events[$i]['typeName'] = $this->getEventType($event['type']);
            }
        }
        return $events;
    }
    
    /**
     * Returns the start and end dates formatted for suitably for the datetime field in the database
     * @param date $date
     * @param int $start_hour
     * @param int $start_min
     * @param int $length_hour
     * @param int $length_min
     * @return array
     */
    protected function getEventStartEndDates($date, $start_hour, $start_min, $length_hour, $length_min){
        $eventTimes = array();
        list($d, $m, $y) = explode('/', $date);
        $yankdate = sprintf('%4d-%02d-%02d', $y, $m, $d);
        $starttime = strtotime($yankdate." ".$start_hour.":".$start_min.":00");
        $eventTimes['startdate'] = $yankdate." ".$start_hour.":".$start_min.":00";
        $addseconds = ((intval($length_hour)*60*60) + (intval($length_min)*60));
        $eventTimes['enddate'] = date('Y-m-d H:i:s', ($starttime + $addseconds));
        return $eventTimes;
    }
    
    /**
     * Returns all of the events for a given instructor or student
     * @param int $userID This should be the user ID of the person you are getting the events for
     * @param string $type If the events are for a instructor set to 'fino' (default) else a student set to 'pupil'
     * @return array|false If any events exist an array of the events will be returned else false will be returned if nothing exists
     */
    protected function getEvents($userID, $type = 'fino'){
        return $this->db->selectAll($this->getEventsTable(), array($type => intval($userID)));
    }
    
    /**
     * Returns the event type name
     * @param int $type This should be the event type ID
     * @return string The event type name will be returned
     */
    public function getEventType($type){
        $events = array_merge($this->events, $this->tutorevents);
        return $events[intval($type - 1)];
    }
    
    /**
     * Returns the corresponding colours for the event type given
     * @param int $type This should be the event type
     * @return array Returns the background colour for the event type and if present will return text colour
     */
    protected function eventColors($type = 1){
        return $this->colors[intval($type)];
    }
}
