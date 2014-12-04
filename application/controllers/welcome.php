<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	
	public function list_file($sync_folder)
	{
		$tokens = preg_split ("/[\s,]+/", shell_exec("ls -l {$sync_folder} 2>&1"));
		for ($x = 7; $x < count($tokens); $x += 9){
			$i = ($x - 2) / 9;
			if (($x - 2) % 9 == 5) {
				$file_list[$i][0] = $tokens[$x + 3];
				$file_list[$i][1] = $tokens[$x].' '.$tokens[$x + 1].' '.$tokens[$x + 2];
			} 
		}
		return $file_list;
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
		$sync_folder = "/home/fcoldstar/sync/";
		$file_list = $this->list_file($sync_folder);
		echo "File Name    /    last modified time<br>";
		foreach($file_list as $i)
			echo $i[0]."    /    ".$i[1]."<br>";
		$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
