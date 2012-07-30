<?PHP

class utlFile {

	public $file = null;
	public $path = null;
	public $name = null;

	function __construct($filepath = "")
	{
		$this->setFile($filepath);
	}

	function setFile ($filepath) // ��������� �����
	{
		if(is_file($filepath))
		{
			$this->file = fopen($filepath);
			$this->path = $filepath;
			$this->name = basename($filepath);
		}
	}

	function delFile ($filepath = null) // ������� ����
	{
		if($filepath && is_file($filepath))
			return unlink($filepath);

		fclose($this->file);
		unlink($this->path);
	}

	function setUseFile() // ���������� ����� ������������� �����
	{
		chmod($this->file, 0777);
	}	
}

?>