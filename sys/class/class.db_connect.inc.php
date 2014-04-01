<?php
	class DB_Connect
	{
		protected $db;
		
		protected function __construct($db)
		{
			//if(is_object($db))
			if(isset($db))
			{
				//echo "the database connection is already created!!!!<br/><br/>";
				$this->db = $db;
				//echo "DATABASE CONNECTION ESTABLISHED ------ class.db.connect.inc.php<br/><br/>";
			}
			else
			{
				try
				{
					$this->db = mysql_connect(DB_HOST,DB_USER,DB_PASS);
					if (!$this->db)
  					{
  						die('Could not connect: ' . mysql_error());
  					}

					//else echo "DATABASE CONNECTION ESTABLISHED ------ class.db.connect.inc.php<br/><br/>";
				}
				catch (Exception $e)
				{
					die($e->getMessage());
				}
			}
		}
	}
?>