<?php
class upload {
	public $file;
	//程序文件根目录绝对路径
	public $path_root;
	//文件保存目录相对路径,不带前面的"/"
	public $path_save;
	//上传的文件名
	public $filename = '';
	//允许上传的文件类型
	public $filetype = array('jpg','jpeg','gif','png');
	//文件上传大小控制(默认是500kb)
	public $filesize = 500000;
	//生成的url地址
	public $fileurl = '';
	function __construct($file, $path_save = null, $ext_arr = array())
	{
		global $pe;
		$this->file = $file;
		//配置存储路径（支持两种模式1：默认上传到默认附件目录里2：上传到自定义目录里）
		!$path_save && $path_save='data/attachment/'.date('Y-m').'/';
		$this->path_save = $pe['path_root'] . $path_save;
		$this->filename = $this->_filename($ext_arr['filename']);

		$ext_arr['filetype'] && $this->filetype = $ext_arr['filetype'];
		$ext_arr['filesize'] && $this->filesize = $ext_arr['filesize'];
		//检测文件合法性
		$this->_filecheck();
		//上传移动
		$this->_filemove();
		$this->fileurl = $pe['host_root'] . $path_save . $this->filename;
	}
	//检测文件的合法性
	function _filecheck()
	{
		if (!$this->file['name']) {
			$this->_alert("请选择文件");
		}
		if (@is_dir($this->path_save) === false) {
			mkdir($this->path_save, 0777, true);
		}
		if ($this->file['file_size'] > $this->filesize) {
			$this->_alert("上传文件大小超过限制");
		}
		if (!in_array($this->_filetail(), $this->filetype)) {
			$this->_alert("上传文件类型不被允许");
		}
	}
	//上传文件重命名
	function _filename($filename)
	{
		if ($filename) {
			return $filename . '.' . $this->_filetail();
		}
		else {
			$nametmp = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','d','u','v','w','x','y','z');
			return date("YmdHis") . $nametmp[array_rand($nametmp, 1)] . '.' . $this->_filetail();
		}
	}
	//获取文件扩展名
	function _filetail()
	{
		$filearr = explode('.', $this->file['name']);
		return strtolower($filearr[count($filearr) - 1]);
	}
	//上传文件移动到存储目录
	function _filemove()
	{
		if (move_uploaded_file($this->file['tmp_name'], $this->path_save . $this->filename) === false) {
			die("上传文件失败...");
		}
	}
	function _alert($msg) {
		echo "<script type='text/javascript'>_alert('{$msg}');history.back();</script>";
		die();
	}
}
?>