<?php
class Details
{
    private $_params;
     
    public function __construct($params)
    {
        $this->_params = $params;
    }
     
    public function readAction()
    {        		
		$detail_items = DetailItem::getAllItems($this->_params['id']);	
		return $detail_items;
    }
}