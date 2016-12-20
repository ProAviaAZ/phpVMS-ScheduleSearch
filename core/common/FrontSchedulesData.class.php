<?php
//simpilotgroup addon module for phpVMS virtual airline system
//
//Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
//To view full license text visit http://creativecommons.org/licenses/by-nc-sa/3.0/
//
//@author David Clark (simpilot)
//@copyright Copyright (c) 2009-2016, David Clark
//@license http://creativecommons.org/licenses/by-nc-sa/3.0/

class FrontSchedulesData extends CodonData {
    public static function findschedules($arricao, $depicao, $airline, $aircraft, $enabled) {
       	$sql = "SELECT ".TABLE_PREFIX."schedules.*, ".TABLE_PREFIX."aircraft.name AS aircraft, ".TABLE_PREFIX."aircraft.registration
                FROM ".TABLE_PREFIX."schedules, ".TABLE_PREFIX."aircraft
                WHERE ".TABLE_PREFIX."schedules.depicao LIKE '$depicao'
                AND ".TABLE_PREFIX."schedules.arricao LIKE '$arricao'
                AND ".TABLE_PREFIX."schedules.code LIKE '$airline'
                AND ".TABLE_PREFIX."schedules.aircraft LIKE '$aircraft'
                AND ".TABLE_PREFIX."aircraft.id LIKE '$aircraft'";
	
	if(isset($enabled) && $enabled == 1) {
		$sql .= " AND ".TABLE_PREFIX."schedules.enabled = '1' ";
	}
		
        return DB::get_results($sql);
    }

     public static function findschedule($arricao, $depicao, $airline, $enabled) {
        $sql = "SELECT ".TABLE_PREFIX."schedules.*, ".TABLE_PREFIX."aircraft.name AS aircraft, ".TABLE_PREFIX."aircraft.registration
                FROM ".TABLE_PREFIX."schedules, ".TABLE_PREFIX."aircraft
                WHERE ".TABLE_PREFIX."schedules.depicao LIKE '$depicao'
                AND ".TABLE_PREFIX."schedules.arricao LIKE '$arricao'
                AND ".TABLE_PREFIX."schedules.code LIKE '$airline'
                AND ".TABLE_PREFIX."aircraft.id LIKE ".TABLE_PREFIX."schedules.aircraft";
				
	if(isset($enabled) && $enabled == 1) {
		$sql .= " AND ".TABLE_PREFIX."schedules.enabled = '1'";	
	}

        return DB::get_results($sql);
    }

    public static function findaircrafttypes() {
        $sql = "SELECT DISTINCT icao FROM ".TABLE_PREFIX."aircraft";
        return DB::get_results($sql);
    }

    public static function findaircraft($aircraft) {
        $sql = "SELECT id FROM ".TABLE_PREFIX."aircraft WHERE icao = '$aircraft'";
        return DB::get_results($sql);
    }
}