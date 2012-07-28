<?php
/**
 * 
 * @author n1k
 * лог запросов в базу данных
 */
class dataBaseController_logFile {
	private $data = false;
	private $fhandle = 0;
	private $filename = "";
	private $startFileContent = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
	/**
	 * Включать запись в файл
	 * @var unknown_type
	 */
	private $logging = true;
	
	
	function __construct($output_filename="", $logging = true)
	{
		if (!$output_filename)
			return;
		$this->filename = $output_filename;
		
		if($logging){
			$this->fhandle = @fopen($output_filename, "w");
			if (!$this->fhandle)
				throw new Exception("невозможно создать файл <i>$output_filename</i>");
	
			$this -> writeToFile( $this ->startFileContent );
		}
	}
	
	function __destruct(){
		if (!$this->fhandle)
			return;
		fclose($this->fhandle);
	}
	
	function writeToFile($data){
		if (!$this->fhandle)
			return;
		fwrite($this->fhandle, $data);
	}
	
	function logOff(){
		$this -> logging = false;
	}
	
	function add($data, $status="note")
	{
		if(!$this -> logging) return;
		switch ($status)
		{
			case "note":
				$this->data = "<span style=\"color: #000; font-weight: normal;\">" . $data . "</span>";
			break;
			case "comment":
				$this->data = "<span style=\"color: #777; font-weight: normal;\">" . $data . "</span>";
			break;
			case "error":
				$this->data = "<span style=\"color: #f00; font-weight: normal;\">" . $data . "</span>";
			break;
			case "constructor":
				$this->data = "<span style=\"color: #000; font-weight: bold;\">" . $data . "</span>";
			break;
			case "highlight":
				$this->data = "<span style=\"color: #35f; font-weight: normal;\">" . $data . "</span>";
			break;
			default:
				$this->data = $data;
			break;
		}
		$this ->writeToFile($this -> getTextDataFormat ($data) );
	}
	
	
	
	function getTextDataFormat($data){
		
		return "<p OnMouseOver=\"this.style.background='#eee';\" OnMouseOut=\"this.style.background='#fff';\">$data</p>\n";
		
	}
	

}