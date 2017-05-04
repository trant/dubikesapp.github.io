<?php

include('lib/httpful.phar');


class DetailItem
{
	public $bikes;
	public $name;
	public $lat;
	public $timestamp;
	public $lng;
	public $free;
	public $number;
	
	public static function getAllItems($id)
	{
		$uri = 'http://api.citybik.es/dublinbikes.json';
		$response = Request::get($uri)  // Will parse based on Content-Type
			->expectsXml()              // from the response, but can specify
			->send(); 
			return $response;
		// $todo_items = array();
		// foreach( new DirectoryIterator(DATA_PATH."/{$userhash}") as $file_info ) {
			// if( $file_info->isFile() == true ) {
				// $todo_item_serialized = file_get_contents($file_info->getPathname());
				// $todo_item_array = unserialize($todo_item_serialized);
				// $todo_items[] = $todo_item_array;
			// }
		// }
		
		//return $todo_items;
	}
	
	public static function getItem($id)
	{
		self::_checkIfUserExists($username, $userpass);
		$userhash = sha1("{$username}_{$userpass}");
		
		if( file_exists(DATA_PATH."/{$userhash}/{$todo_id}.txt") === false ) {
			throw new Exception('Todo ID is invalid');
		}
		
		$todo_item_serialized = file_get_contents(DATA_PATH."/{$userhash}/{$todo_id}.txt");
		$todo_item_array = unserialize($todo_item_serialized);
		
		$todo_record = new TodoItem();
		$todo_record->todo_id = $todo_id;
		$todo_record->title = $todo_item_array['title'];
		$todo_record->description = $todo_item_array['description'];
		$todo_record->due_date = $todo_item_array['due_date'];
		$todo_record->is_done = $todo_item_array['is_done'];
		
		return $todo_record;
	}
	
	public function toArray()
	{
		//return an array version of the todo item
		return array(
			'bikes' => $this->todo_id,
			'name' => $this->title,
			'lat' => $this->description,
			'timestamp' => $this->due_date,
			'lng' => $this->is_done,
			'free' => $this->is_done,
			'number' => $this->is_done
		);
	}
}