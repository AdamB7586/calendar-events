<?php

namespace Calendar;

class Calendar extends Events
{
      
    public $minutes = ['00', '15', '30', '45'];
    
    /**
     * Produces a drop-down menu for the number of hours
     * @param string $name The name you wish to give to the select menu
     * @param int $selected The hour which should be set as selected
     * @param int $hours The maximum hour to display
     * @param int $start Which hour should be that starting point
     * @return string Returns a select menu for the given values
     */
    public function hoursDropdown($name, $selected, $hours = 24, $start = 0)
    {
        $options = '';
        for ($i = $start; $i <= $hours; $i++) {
            $value = str_pad($i, 2, '0', STR_PAD_LEFT);
            $options.= '<option value="'.$value.'"'.($selected == $value ? ' selected="selected"' : '').'>'.$value.'</option>';
        }
        return '<select name="'.$name.'" id="'.$name.'" class="form-control">'.$options.'</select>';
    }
    
    /**
     * Produces a drop-down menu for the minutes
     * @param string $name The name you wish to give to the select menu
     * @param string $selected The value which should be set as selected
     * @return string The select menu will be returned as a string
     */
    public function minutesDropdown($name, $selected)
    {
        $options = '';
        foreach ($this->minutes as $value) {
            $options.= '<option value="'.$value.'"'.($selected == $value ? ' selected="selected"' : '').'>'.$value.'</option>';
        }
        return '<select name="'.$name.'" id="'.$name.'" class="form-control">'.$options.'</select>';
    }
    
    /**
     * Returns an array of different event types
     * @param boolean $tutor If the instructor is a tutor should be set to true to add additional event types
     * @return array An array of available event types will be returned
     */
    public function getEventTypes($tutor = false)
    {
        if ($tutor !== false) {
            return array_merge($this->events, $this->tutorevents);
        }
        return $this->events;
    }
    
    /**
     * Returns the location of the template files
     * @return string This will be the location of the template files
     */
    public function getTemplateDir()
    {
        return dirname(__FILE__).'templates';
    }
}
