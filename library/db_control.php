<?php 
	/**This class stores most frequently needde instruction for accessing the database
	 * and querying the database data
	 */
	class Access
	{
		private $host = 'localhost'; //hostname
		private $user = 'root'; //username
		private $pass = ''; //password
		private $db = 'onlineshop'; // database name
		private $conn; //holds database connection
		private $logged = FALSE; //determines if user is logged in

		/*constructor that creates connection automatically*/
		function __construct()
		{
			$this->conn = $this->connect();
		}

		/*creates database connection*/
		function connect()
		{
			$conn = mysqli_connect($this->host,$this->user,$this->pass,$this->db)
				or die("Error occured while connecting to the server. ". mysqli_connect_error());
			return $conn;
		}

		/*executes sql query*/
		function query($query)
		{
			$result = mysqli_query($this->conn,$query) or die("Error occured while processing your request. ". mysqli_error($this->conn));
			return $result;
		}

		/*number of rows*/
		function rows($result)
		{
			$rows = mysqli_num_rows($result);
			return $rows;
		}

		/*string sanitization*/
		function clean($var)
		{
			$input = trim($var); //remove extra whitespaces, tabs, newline
			$input = strip_tags($var); //against special tags
			$input = htmlentities($var); //against html injection
			$input = htmlspecialchars($var);
		    $input= stripslashes($var); //against '/' such of file paths
		    return mysqli_real_escape_string($this->connect(),$input); //against sql injections
		}

		/*logs in user and sets session variables*/
		function login($query,$username)
		{
			$result = $this->query($query);
			$count = $this->rows($result);

			if($count == 1) // if the user is available then one row will be returned
			{
				$_SESSION['user'] = $username;
				$this->logged = TRUE;
			}
			else
			{
				$this->logged = FALSE;
			}
			return $this->logged;
		}

		/*destroys session and logs out user*/
		function logout($user)
		{
			session_destroy();
			header('location:index.php');
			$this->logged = FALSE;
		}

		/*saves user activity after every 15 mins.
		if browser can't respond then the user is logged out automatically*/
		function check_user($user)
		{

		}

	}
?>