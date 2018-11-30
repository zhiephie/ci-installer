<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Install extends MY_Controller
{
	private $_defaultRoute;

	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		ini_set('display_errors', 0);
		ini_set('display_startup_errors', 0);
		ini_set('max_execution_time', 0);
		ini_set('memory_limit','2048M');
		$this->load->config('installer', true);
		$this->_defaultRoute = $this->config->item('defaultRoute');
		$filename = 'application/installed';
		if (file_exists($filename)) {
			redirect(base_url($this->_defaultRoute), 'refresh');
		}
		return true;
  }

	public function index()
	{
		if ($this->router->default_controller == 'install') {
			$this->_installer('installer/1');
    } else {
			redirect(base_url($this->_defaultRoute), 'refresh');
		}
	}

  public function requirements()
  {
		if ($this->router->default_controller == 'install') {
			$this->_installer('installer/2');
    } else {
			redirect(base_url($this->_defaultRoute), 'refresh');
		}
  }

  public function permissions()
  {
		if ($this->router->default_controller == 'install') {
			$this->_installer('installer/3');
    } else {
			redirect(base_url($this->_defaultRoute), 'refresh');
		}
  }

  public function environment()
  {
		if ($this->router->default_controller == 'install') {
			$this->form_validation->set_rules('database_hostname', 'Database Hostname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('database_port', 'Database Port', 'trim|required|xss_clean');
			$this->form_validation->set_rules('database_name', 'Database Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('database_username', 'Database Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('database_password', 'Database Password', 'trim|required|xss_clean');
			$this->form_validation->set_error_delimiters('<p>', '</p>');
			if ($this->form_validation->run()) {
				$hostname = $this->form_validation->set_value('database_hostname');
				$port = $this->form_validation->set_value('database_port');
				$dbname = $this->form_validation->set_value('database_name');
				$username = $this->form_validation->set_value('database_username');
				$password = $this->form_validation->set_value('database_password');
				// check db connection using the above credentials
	      $db_connection = $this->check_database_connection($hostname, $username, $password, $dbname);
				// var_dump($db_connection);exit;
				if ($db_connection === 'failed') {
					$this->session->set_flashdata('msg','Error establishing a database conenction using your provided information.');
	        redirect(base_url('install/environment'), 'refresh');
	      } elseif ($db_connection === 'db_not_exist') {
					$this->session->set_flashdata('msg','The database you are trying to use for the application does not exist.');
	        redirect(base_url('install/environment'), 'refresh');
	      } else {
					// write database.php
		      $this->configure_database($hostname, $port, $dbname, $username, $password);
		      // run sql
		      $this->run_blank_sql();

		      // redirect to final page
					redirect(base_url('install/finished'), 'refresh');
				}
			} else {
				$this->_installer('installer/4');
		  }
    } else {
			redirect(base_url($this->_defaultRoute), 'refresh');
		}
  }

  public function finished()
  {
		if ($this->router->default_controller == 'install') {
			$this->configure_routes();
			$this->_installer('installer/5');
    } else {
			redirect(base_url($this->_defaultRoute), 'refresh');
		}
  }

	protected function check_database_connection($hostname, $username, $password, $dbname)
	{
		$con = @mysqli_connect($hostname, $username, $password, $dbname);

		// Check connection
		if (@mysqli_connect_errno()) {
		  return 'failed';
		}

		$db_selected = @mysqli_select_db($con, $dbname);
		if ($db_selected) {
			return 'success';
		} else {
			return "db_not_exist";
		}
		@mysqli_close($con);

  }

	protected function configure_database($hostname, $port, $name, $username, $password)
	{
    // write database.php
    $data_db = file_get_contents('./application/config/database.php');
    $data_db = str_replace('db_name',	$name,	$data_db);
    $data_db = str_replace('db_user',	$username,	$data_db);
    $data_db = str_replace('db_pass',	$password,	$data_db);
    $data_db = str_replace('db_host',	$hostname,	$data_db);
    file_put_contents('./application/config/database.php', $data_db);
  }

  protected function run_blank_sql()
	{
    $this->load->database();
    // Set line to collect lines that wrap
    $templine = '';
    // Read in entire file
		$file = $this->config->item('pathSql');
    $lines = file($file);
    // Loop through each line
    foreach ($lines as $line) {
      // Skip it if it's a comment
      if (substr($line, 0, 2) == '--' || $line == '')
        continue;
      // Add this line to the current templine we are creating
      $templine .= $line;
      // If it has a semicolon at the end, it's the end of the query so can process this templine
      if (substr(trim($line), -1, 1) == ';') {
        // Perform the query
        $this->db->query($templine);
        // Reset temp variable to empty
        $templine = '';
      }
    }
  }

	protected function configure_routes()
	{
    // write routes.php
		$defaultRoute = $this->config->item('defaultRoute');
		$autoload = $this->config->item('autoload');
		$sessDrive = $this->config->item('sessDrive');
		$sessSave = $this->config->item('sessSave');

    $data_routes = file_get_contents('./application/config/routes.php');
		$data_routes = str_replace('install',	$defaultRoute,	$data_routes);
		file_put_contents('./application/config/routes.php', $data_routes);

		// write autoload.php
		$data_autoload = file_get_contents('./application/config/autoload.php');
		$data_autoload = str_replace("array('session', 'form_validation')",	$autoload,	$data_autoload);
		file_put_contents('./application/config/autoload.php', $data_autoload);

		// write config.php
    $data_rconfig = file_get_contents('./application/config/config.php');
    $data_rconfig = str_replace('files',	$sessDrive,	$data_rconfig);
    $data_rconfig = str_replace('backups/',	$sessSave,	$data_rconfig);
    file_put_contents('./application/config/config.php', $data_rconfig);

		$time = time() - 3600;

		// Touch the file
		if (!touch('./application/installed', $time)) {
		    // echo 'Whoops, something went wrong...';
		} else {
		    // echo 'Touched file with success';
		}
	}

}
