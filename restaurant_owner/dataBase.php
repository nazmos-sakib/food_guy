
<?php


/**
 * 
 */
class database
{

	private $servername = "127.0.0.1";
	private $username = "root";
	private $password = "";
	private $dbname = "the_food_guy";

	private $table_category  = 'category';
	private $table_city_list = "city";
	private $table_food_item = 'food_item';
	private $table_in_offer  = 'in_offer';
	private $table_in_order = 'in_order';
	private $table_menu_item = 'menu_item';
	private $table_offer  = 'offer';
	private $table_order_status  = 'order_status';
	private $table_placed_order  = 'placed_order';
	private $table_restaurant_list  = 'restaurant_list';
	private $table_restaurant_owner = 'restaurant_owner';
	private $table_status_catalog  = 'status_catalog';
	
	//private
	//private

	
	function __construct()
	{
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		if ($this->conn->connect_error) 
		{
		    die("Connection failed: " . $this->conn->connect_error);
		}
		//echo "Connected successfully";
	}


	function __destruct() 
	{
   		 $this->conn->close();
   		 //echo "<br>Connection close successfully";
  	}


  	function city_list()
  	{
  		$sql = "SELECT * FROM $this->table_city_list";
		$result = $this->conn->query($sql);
		return $result;

  	}



  	function check_email($email)
  	{
  		$sql = "SELECT owner_id FROM $this->table_restaurant_owner where owner_email ="."'".$email."'"; //'sakib@nazmos.com'";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) 
		{
			return false;
		}
		else 
		{
		 	return true;
		}

  	}



  	function insert_restaurant_list($restaurant_name, $city_list, $restaurant_address, $email)
  	{
  		$sql = "INSERT INTO $this->table_restaurant_list (restaurant_name, restaurant_owner_email, address, city_id)
		VALUES (?,?,?,?)";

		// prepare and bind
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("ssss", $restaurantname, $owneremail, $address, $cityid);

		// set parameters and execute
		$restaurantname = $restaurant_name;
		$owneremail = $email;
		$address = $restaurant_address;
		$cityid = $city_list;
		
		$stmt->execute();

		//echo "New records created successfully";

		$stmt->close();

  	}



//
//  	INSERT INTO `restaurant_owner` (`owner_id`, `full_name`, `restaurant_name`, `city_id`, `address`, `contract_phone`, `owner_email`, //	`password`, `time_joined`) VALUES (NULL, '', '', '', '', '', '', '', current_timestamp()


  	function insert_restaurant_owner($first_name, $last_name, $restaurant_name, $city_list, $restaurant_address, $pn_number, $email, $password)
  	{

  		$p_hash = password_hash($password, PASSWORD_BCRYPT) ;

  		//echo '<br>in insert section. hash: '.$p_hash."<br>";
  		//echo strlen($p_hash)."<br>";

  		$sql = "INSERT INTO $this->table_restaurant_owner (full_name, restaurant_name, city_id, address, contract_phone, owner_email, password)
		VALUES (?,?,?,?,?,?,?)";

		// prepare and bind
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("sssssss", $fullname,  $restaurantname, $cityid, $address, $contractphone, $owneremail, $pass);

		// set parameters and execute
		$fullname = $first_name . " " . $last_name;
		$restaurantname = $restaurant_name;
		$cityid = $city_list;
		$address = $restaurant_address;
		$contractphone = $pn_number;
		$owneremail = $email;
		$pass = $p_hash;

		$stmt->execute();

		//echo "New records created successfully";

		$stmt->close();

		$this->insert_restaurant_list($restaurant_name, $city_list, $restaurant_address, $email);


/*
		if ($this->conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} 
		else 
		{
			 echo "Error: " . $sql . "<br>" . $this->conn->error;
		}*/
		   

  	}


  	function restaurant_owner_login_authenticate($email,$pass)
  	{
  		$sql = "SELECT password FROM $this->table_restaurant_owner where owner_email ="."'".$email."'"; //'sakib@nazmos.com'";
		$result = $this->conn->query($sql);

		/*echo $result->num_rows;
		return;*/

		if ($result->num_rows == 1) 
		{
		    // output data of each row
		    $row = $result->fetch_assoc();
		   
	        if (password_verify($pass, $row["password"])) 
	        {
			    return true;
			} 
			else 
			{
				return false;
			}
			
		    
		}
		else 
		{
		 	//pass;
		}
  	}





  	function extract_restaurant_detail($email)
  	{
  		$sql = "SELECT * FROM $this->table_restaurant_list where restaurant_owner_email ="."'".$email."'";
		$result = $this->conn->query($sql);

		return $result;
  	}

























  	function verify_password($email,$password)
  	{

		//$p_hash = password_hash($password, PASSWORD_BCRYPT) ;

  		$sql = "SELECT sl,email,password FROM $this->table_member where email ="."'".$email."'";
		$result = $this->conn->query($sql);

		if ($result->num_rows > 0) 
		{
			$row = $asd = $result->fetch_assoc();
			echo '<br><br>'.var_dump($asd).'<br><br>';

			echo "<table><tr><th>ID</th><th>Name</th></tr>";
		    // output data of each row
		    while(1) 
		    {
		        echo "<tr><td>".$row["sl"]."</td><td>".$row["email"]." ".$row["password"]."</td></tr>";

		        if (password_verify($password, $row["password"])) 
		        {
				    echo 'Password is valid!';
				} 
				else 
				{
				    echo 'Invalid password.';
				}
				break;
		    }
		    echo "</table>";
		}
		else 
		{
		    echo "email or Password incorrect";
		}
		  		
		
  	}


  	function print_all_pass()
  	{
  		$sql = "SELECT sl,email,password FROM $this->table_member";
		$result = $this->conn->query($sql);

		if ($result->num_rows > 0) 
		{
		    echo "<table><tr><th>ID</th><th>Name</th></tr>";
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        echo "<tr><td>".$row["sl"]."</td><td>".$row["email"]." ".$row["password"]."</td></tr>";
		    }
		    echo "</table>";
		}
		else 
		{
		    echo "0 results";
		}
  	}


  	function feature_product()
  	{
  		$sql = "SELECT * FROM $this->table_feature_product";
		$result = $this->conn->query($sql);

		return $result;
  	}

  	function new_product()
  	{
  		$sql = "SELECT * FROM $this->table_new_product";
		$result = $this->conn->query($sql);

		return $result;
  	}

  	function inspired_product()
  	{
  		$sql = "SELECT * FROM $this->table_inspired_product";
		$result = $this->conn->query($sql);

		return $result;
  	}

  	function blog_post()
  	{
  		$sql = "SELECT * FROM $this->table_blog_post";
		$result = $this->conn->query($sql);

		return $result;
  	}

}



   /* $result1 = $db->inspired_product();

    $row2 = array();

     while($row = $result1->fetch_assoc())
     {
       array_push($row2, $row);
     }
    var_dump($row2);
    echo $row2[0]['product_name'];*/





/*
$password = 'my super secret password';
$hmac_algorithm = 'sha512';
$hmac_key       = random_bytes(32);
$hmac_key       = 'jhbahsdfbgyubabfhgwtr36rywsfcw6rtc7   gr67';


$hmac = hash_hmac($hmac_algorithm, $password, $hmac_key);

$password_hash_cost      = 4;
$password_hash_algorithm =  PASSWORD_ARGON2I; 
$password_hash_options   = [
    'memory_cost' => $password_hash_cost * PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
    'time_cost'   => $password_hash_cost * PASSWORD_ARGON2_DEFAULT_TIME_COST,
    'threads'     => $password_hash_cost * PASSWORD_ARGON2_DEFAULT_THREADS
];

$hash = password_hash(
    $hmac,
    $password_hash_algorithm,
    $password_hash_options
);

$hash = password_hash($hmac, PASSWORD_BCRYPT) ;

if (password_verify($hmac, $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}

$encryption_key   = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
$encryption_nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

$ciphertext = sodium_crypto_secretbox(
    $hash,
    $encryption_nonce,
    $encryption_key
);


*/




/*
* PBKDF2 key derivation function as defined by RSA's PKCS #5: https://www.ietf.org/rfc/rfc2898.txt
* $algorithm - The hash algorithm to use. Recommended: SHA256
* $password - The password.
* $salt - A salt that is unique to the password.
* $count - Iteration count. Higher is better, but slower. Recommended: At least 1024.
* $key_length - The length of the derived key in bytes.
* $raw_output - If true, the key is returned in raw binary format. Hex encoded otherwise.
* Returns: A $key_length-byte key derived from the password and salt.
*
* Test vectors can be found here: https://www.ietf.org/rfc/rfc6070.txt
*
* This implementation of PBKDF2 was originally created by defuse.ca
* With improvements by variations-of-shadow.com
*/
function pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = false)
{
    $algorithm = strtolower($algorithm);
    if(!in_array($algorithm, hash_algos(), true))
        die('PBKDF2 ERROR: Invalid hash algorithm.');
    if($count <= 0 || $key_length <= 0)
        die('PBKDF2 ERROR: Invalid parameters.');

    $hash_length = strlen(hash($algorithm, "", true));
    $block_count = ceil($key_length / $hash_length);

    $output = "";
    for($i = 1; $i <= $block_count; $i++) {
        // $i encoded as 4 bytes, big endian.
        $last = $salt . pack("N", $i);
        // first iteration
        $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
        // perform the other $count - 1 iterations
        for ($j = 1; $j < $count; $j++) {
            $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
        }
        $output .= $xorsum;
    }

    if($raw_output)
        return substr($output, 0, $key_length);
    else
        return bin2hex(substr($output, 0, $key_length));
}















//$dd = new database();
//$dd->login_authenticate('sakib@nazmos.com','asd');
//$dd->insert('John', 'Doe', 'asxdse@example.com','mypass');
//$dd->print_all_pass();
//$dd->verify_password('sasxdse@example.com','mypass');
//unset($db);

?>