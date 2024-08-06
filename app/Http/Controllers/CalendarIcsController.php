<?php

namespace App\Http\Controllers;

use App\Models\Reserve;

class CalendarIcsController extends Controller
{
    public function downloadICS($id)
    {
        $reserve    = Reserve::findOrFail($id);
        $icsContent = $this->generateICS($reserve);

        return response($icsContent)
            ->header('Content-Type', 'text/calendar')
            ->header('Content-Disposition', 'attachment; filename=evento.ics');
    }

    private function generateICS($event)
    {
        $start = \Carbon\Carbon::parse($event->start)->format('Ymd\THis\Z');
        $end   = \Carbon\Carbon::parse($event->end)->format('Ymd\THis\Z');

        $ics = "BEGIN:VCALENDAR\r\n";
        $ics .= "VERSION:2.0\r\n";
        $ics .= "PRODID:-//Your Company//Your App//EN\r\n";
        $ics .= "BEGIN:VEVENT\r\n";
        $ics .= 'UID:' . uniqid() . "\r\n";
        $ics .= 'DTSTAMP:' . gmdate('Ymd\THis\Z') . "\r\n";
        $ics .= 'DTSTART:' . $start . "\r\n";
        $ics .= 'DTEND:' . $end . "\r\n";
        $ics .= 'SUMMARY:' . $event->title . "\r\n";
        $ics .= 'DESCRIPTION:' . $event->description . "\r\n";
        $ics .= 'LOCATION:' . $event->location . "\r\n";
        $ics .= "END:VEVENT\r\n";
        $ics .= "END:VCALENDAR\r\n";

        return $ics;
    }
}
