<?php
//simpilotgroup addon module for phpVMS virtual airline system
//
//Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
//To view full license text visit http://creativecommons.org/licenses/by-nc-sa/3.0/
//
//@author David Clark (simpilot)
//@copyright Copyright (c) 2009-2016, David Clark
//@license http://creativecommons.org/licenses/by-nc-sa/3.0/

class FrontSchedules extends CodonModule
{
	public $title = 'Schedules Search';
	protected $version = '2.0';
	protected $enabled = 1;
	/**
	* 
	*
	**/
	
	public function index() {
		if(isset($this->post->action)) {
			switch($this->post->action) {
				case 'search':
				$this->search_schedules();
				break;	
			}
		} else {
			$this->set('allairports', OperationsData::GetAllAirports());
			$this->set('allairlines', OperationsData::getAllAirlines());
			$this->set('allaircraft', FrontSchedulesData::findaircrafttypes());
			$this->show('airport_search');
		}
     }

    public function search_schedules() {
		$arricao = DB::escape($this->post->arricao);
        $depicao = DB::escape($this->post->depicao);
        $airline = DB::escape($this->post->airline);
        $aircraft = DB::escape($this->post->aircraft);
                
		if(!$airline) {
			$airline = '%';
		}
		if(!$arricao) {
			$arricao = '%';
		}
		if(!$depicao) {
			$depicao = '%';
		}
		if($aircraft !== '') {
			$aircrafts = FrontSchedulesData::findaircraft($aircraft);
			foreach($aircrafts as $aircraft) {
				$route = FrontSchedulesData::findschedules($arricao, $depicao, $airline, $aircraft->id, $this->enabled);
				if(!$route) { $route = array(); }
				if(!$routes) { $routes = array(); }
				$routes = array_merge($routes, $route);
			}
		} else {
			$routes = FrontSchedulesData::findschedule($arricao, $depicao, $airline, $this->enabled);
		}

		$this->set('schedule_list', $routes);
		$this->show('schedule_results');
	}
	
	public function version() {
		echo 'Front Schedules Module Current Version: <strong>'.$this->version.'</strong>';	
	}
}