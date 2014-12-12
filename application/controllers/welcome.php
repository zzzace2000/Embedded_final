<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function list_file()
	{
		$sync_folder = "/home/root/sync/";
		$file_list = array();
		$tokens = preg_split ("/[\s,]+/", shell_exec("ls -l {$sync_folder} 2>&1"));
		for ($x = 8; $x < count($tokens); $x += 9){
			$i = ($x - 8) / 9;
			if ($x% 9 == 8) {
				$file_list[$i][0] = $tokens[$x];
				$file_list[$i][1] = $tokens[$x - 3].' '.$tokens[$x - 2].' '.$tokens[$x - 1];
			} 
		}
		if (!empty($file_list)) return $file_list;
	}

	public function upload_file()
	{
		$arr = array('error' => '');
		$this->load->view('upload', $arr);

	}

	public function do_upload()
	{
		$config['upload_path'] = "/home/root/sync/";
		$config['allowed_types'] = '*';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
    	$this->upload->initialize($config);

		if(!$this->upload->do_upload())
		{
			echo("ERROR: ");
			echo $this->upload->display_errors();
		}
		else
		{
			echo("UPLOAD SUCCESS");
		}
	}

	public function download_file()
	{
		$arr = array('error' => '');
		$this->load->view('download', $arr);
	}

	public function do_download()
	{
		//echo $_POST['userfile'];
		$sync_folder = "/home/root/sync/";
		$filename = $_POST['userfile'];
		$myfile = $sync_folder.$filename;
		//$mm_type="application/octet-stream";
		//header("Cache-Control: public, must-revalidate");
		header('Content-type:application/force-download');
		header('Content-Transfer-Encoding: Binary');
		//header("Content-Length: " .(string)(filesize($myFile)) );
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		readfile($myfile);
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$sync_folder = "/home/root/sync/";
		$file_list = $this->list_file($sync_folder);
		if (!empty($file_list))
			echo json_encode($file_list);
		$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
