<?php

class BookableCell
{
    /**
     * @var Booking
     */
    private $booking;
 
    private $currentURL;
 
    /**
     * BookableCell constructor.
     * @param $booking
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
        $this->currentURL = htmlentities($_SERVER['REQUEST_URI']);
    }
 
    public function update(Calendar $cal)
    {
        if ($this->isDateBooked($cal->getCurrentDate())) {
            return $cal->cellContent =
                $this->bookedCell($cal->getCurrentDate());
        }
 
        if (!$this->isDateBooked($cal->getCurrentDate())) {
            return $cal->cellContent =
                $this->openCell($cal->getCurrentDate());
        }
    }
 
    public function routeActions()
    {
        if (isset($_POST['delete'])) {
            $this->deleteBooking($_POST['id']);
        }
 
        if (isset($_POST['add'])) {
            $this->addBooking($_POST['date']);
        }
    }
 
    private function openCell($date)
    {
        return '<div class="open">' . $this->bookingForm($date) . '</div>';
    }
 
    private function bookedCell($date)
    {
        return '<div class="booked">' . $this->deleteForm($this->bookingId($date)) . '</div>';
    }
 
    private function isDateBooked($date)
    {
        return in_array($date, $this->bookedDates());
    }
 
    private function bookedDates()
    {
        return array_map(function ($record) {
            return $record['booking_date'];
        }, $this->booking->index());
    }
 
    private function bookingId($date)
    {
        $booking = array_filter($this->booking->index(), function ($record) use ($date) {
            return $record['booking_date'] == $date;
        });
 
        $result = array_shift($booking);
 
        return $result['id'];
    }
 
    private function deleteBooking($id)
    {
        $this->booking->delete($id);
    }
 
    private function addBooking($date)
    {
        $date = new DateTimeImmutable($date);
        $this->booking->add($date);
    }
 
    private function bookingForm($date)
    {
        return
            '<form  method="post" action="' . $this->currentURL . '">' .
            '<input type="hidden" name="add" />' .
            '<input type="hidden" name="date" value="' . $date . '" />' .
            '<input class="submit" type="submit" value="Book" />' .
            '</form>';
    }
 
    private function deleteForm($id)
    {
        return
            '<form onsubmit="return confirm(\'Are you sure to cancel?\');" method="post" action="' . $this->currentURL . '">' .
            '<input type="hidden" name="delete" />' .
            '<input type="hidden" name="id" value="' . $id . '" />' .
            '<input class="submit" type="submit" value="Delete" />' .
            '</form>';
    }
}
?>