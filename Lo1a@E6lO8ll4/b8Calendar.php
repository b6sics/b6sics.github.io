<?php
 
class Calendar
{
 
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }
 
    /********************* PROPERTY ********************/
    public $cellContent = '';
    protected $observers = array();
 
    private $dayLabels = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
    private $currentYear = 0;
    private $currentMonth = 0;
    private $currentDay = 0;
    private $currentDate = null;
    private $daysInMonth = 0;
    private $sundayFirst = true;
    private $naviHref = null;
 
    /********************* PUBLIC **********************/
    /* @return void
     * @access public
     */
    public function attachObserver($type, $observer)
    {
        $this->observers[$type][] = $observer;
    }
 
    /*
    *
    * @return void
    * @access public
    */
    public function notifyObserver($type)
    {
        if (isset($this->observers[$type])) {
            foreach ($this->observers[$type] as $observer) {
                $observer->update($this);
            }
        }
    }
 
    public function getCurrentDate()
    {
        return $this->currentDate;
    }
 
    /**
     * Set week labels' order.
     * When it is set to false,
     * monday will be listed as the first day.
     *
     * @param boolean
     * @return              void
     * @author              The-Di-Lab <thedilab@gmail.com>
     * @access              public
     */
    public function setSundayFirst($bool = true)
    {
        $this->sundayFirst = $bool;
    }
 
    /**
     * print out the calendar
     *
     * @param string
     * @param string
     * @param array
     * @return              string
     * @author              The-Di-Lab <thedilab@gmail.com>
     * @access              public
     */
    public function show($month = null, $year = null, $attributes = false)
    {
        if (null == $year && isset($_GET['year'])) {
            $year = $_GET['year'];
        } else if (null == $year) {
            $year = date("Y", time());
        }
 
        if (null == $month && isset($_GET['month'])) {
            $month = $_GET['month'];
        } else if (null == $month) {
            $month = date("m", time());
        }
 
        $this->currentYear = $year;
        $this->currentMonth = $month;
        $this->daysInMonth = $this->_daysInMonth($month, $year);
 
        $content = '<div id="calendar">' .
            '<div class="box">' .
            $this->_createNavi() .
            '</div>' .
            '<div class="box-content">' .
            '<ul class="label">' . $this->_createLabels() . '</ul>';
        $content .= '<div class="clear"></div>';
        $content .= '<ul class="dates">';
        for ($i = 0; $i < $this->_weeksInMonth($month, $year); $i++) {
            for ($j = 1; $j <= 7; $j++) {
                $content .= $this->_showDay($i * 7 + $j, $attributes);
            }
        }
        $content .= '</ul>';
        $content .= '<div class="clear"></div>';
        $content .= '</div>';
        $content .= '</div>';
        return $content;
    }
 
    /********************* PRIVATE **********************/
    /**
     * create the li element for ul
     *
     * @param string
     * @param array
     * @return              string
     * @author              The-Di-Lab <thedilab@gmail.com>
     * @access              private
     */
    private function _showDay($cellNumber, $attributes = false)
    {
        if ($this->currentDay == 0) {
            //1 (for Monday) through 7 (for Sunday)
            $firstDayOfTheWeek = date('N', strtotime($this->currentYear . '-' . $this->currentMonth . '-01'));
            if ($this->sundayFirst) {
                if ($firstDayOfTheWeek == 7) {
                    $firstDayOfTheWeek = 1;
                } else {
                    $firstDayOfTheWeek++;
                }
            }
            if (intval($cellNumber) == intval($firstDayOfTheWeek)) {
                $this->currentDay = 1;
            }
        }
 
        if (($this->currentDay != 0) && ($this->currentDay <= $this->daysInMonth)) {
            $this->currentDate = date('Y-m-d', strtotime($this->currentYear . '-' . $this->currentMonth . '-' . ($this->currentDay)));
            $cellContent = $this->_createCellContent($attributes);
            $this->currentDay++;
        } else {
            $this->currentDate = null;
            $cellContent = null;
        }
 
 
        return '<li id="li-' . $this->currentDate . '" class="' . ($cellNumber % 7 == 1 ? ' start ' : ($cellNumber % 7 == 0 ? ' end ' : ' ')) .
            ($cellContent == null ? 'mask' : '') . '">' . $cellContent . '</li>';
    }
 
    /**
     * create navigation
     *
     * @return              string
     * @author              The-Di-Lab <thedilab@gmail.com>
     * @access              private
     */
    private function _createNavi()
    {
        $nextMonth = $this->currentMonth == 12 ? 1 : intval($this->currentMonth) + 1;
        $nextYear = $this->currentMonth == 12 ? intval($this->currentYear) + 1 : $this->currentYear;
 
        $preMonth = $this->currentMonth == 1 ? 12 : intval($this->currentMonth) - 1;
        $preYear = $this->currentMonth == 1 ? intval($this->currentYear) - 1 : $this->currentYear;
 
        return
            '<div class="header">' .
            '<a class="prev" href="' . $this->naviHref . '?month=' . sprintf('%02d', $preMonth) . '&year=' . $preYear . '">Prev</a>' .
            '<span class="title">' . date('Y M', strtotime($this->currentYear . '-' . $this->currentMonth . '-1')) . '</span>' .
            '<a class="next" href="' . $this->naviHref . '?month=' . sprintf("%02d", $nextMonth) . '&year=' . $nextYear . '">Next</a>' .
            '</div>';
    }
 
    /**
     * create calendar week labels
     *
     * @return              string
     * @author              The-Di-Lab <thedilab@gmail.com>
     * @access              private
     */
    private function _createLabels()
    {
        if ($this->sundayFirst) {
            $temp = $this->dayLabels[0];
            for ($i = 1; $i < sizeof($this->dayLabels); $i++) {
                $tmp = $this->dayLabels[$i];
                $this->dayLabels[$i] = $temp;
                $temp = $tmp;
            }
            $this->dayLabels[0] = $temp;
        }
 
 
        $content = '';
        foreach ($this->dayLabels as $index => $label) {
            $content .= '<li class="' . ($label == 6 ? 'end title' : 'start title') . ' title">' . $label . '</li>';
        }
 
        return $content;
    }
 
    /**
     * create content for li element
     *
     * @param array
     * @return              string
     * @author              The-Di-Lab <thedilab@gmail.com>
     * @access              private
     */
    private function _createCellContent($setting = false)
    {
        $this->cellContent = '';
 
        $this->cellContent = $this->currentDay;
 
        //observer
        $this->notifyObserver('showCell');
 
        return $this->cellContent;
    }
 
    /**
     * calculate number of weeks in a particular month
     *
     * @param number
     * @param number
     * @return              number
     * @author              The-Di-Lab <thedilab@gmail.com>
     * @access              private
     */
    private function _weeksInMonth($month = null, $year = null)
    {
        if (null == ($year))
            $year = date("Y", time());
 
        if (null == ($month))
            $month = date("m", time());
 
        // find number of weeks in this month
        $daysInMonths = (int)($this->_daysInMonth($month, $year));
 
        $numOfweeks = ($daysInMonths % 7 == 0 ? 0 : 1) + intval($daysInMonths / 7);
        $monthEndingDay = date('N', strtotime($year . '-' . $month . '-' . $daysInMonths));
        $monthStartDay = date('N', strtotime($year . '-' . $month . '-01'));
        $monthEndingDay == 7 ? $monthEndingDay = 0 : '';
        $monthStartDay == 7 ? $monthStartDay = 0 : '';
 
        if ($monthEndingDay < $monthStartDay) {
            $numOfweeks++;
        }
        return $numOfweeks;
 
    }
 
    /**
     * calculate number of days in a particular month
     *
     * @param number
     * @param number
     * @return              number
     * @author              The-Di-Lab <thedilab@gmail.com>
     * @access              private
     */
    private function _daysInMonth($month = null, $year = null)
    {
        if (null == ($year))
            $year = date("Y", time());
 
        if (null == ($month))
            $month = date("m", time());
 
        return date('t', strtotime($year . '-' . $month . '-01'));
    }
 
}
?>