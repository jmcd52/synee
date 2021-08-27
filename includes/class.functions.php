<?php

	include ( "config.php" );

	class Functions {
		
		private $db;
		
		function __construct( $db )
		{
			
			$this->_db = $db;
									
		}
		
		public function output( $string ) {
			
			echo $string;
			
		}
		
		
		public function login() {
			
			//variable to store error message

			global $error;
			
			// check if submit has been pressed
			if ( isset( $_POST[ 'submit' ] ) ) 
			{
				//checks if fields were empty
				if ( empty( $_POST[ 'username' ] ) || empty( $_POST[ 'password' ] ) ) 

				{
					//error message
					$error = "Username or Password is empty<br/><br/>"; 

				} else {   

					// Define $username and $password 

					$username = $_POST[ 'username' ];  
						
					try {
						
						//select rows from db where the username matches - usernames are unique
						$query = $this->_db->prepare( "SELECT * FROM users WHERE user_name=:username" );
						//bind entered username defined before try into query
						$query->bindParam( ":username", $username, PDO::PARAM_STR );
						$query->execute();
						//fetches the row
						$row = $query->fetch();
						
					} catch( PDOException $e ) {

						echo $e->getMessage();

					}
					
					//password checking
					//store entered password
					$password = $_POST["password"];
					//get hashed password from database
					$hash = $row[ 'user_password' ];
					//verify the password - returns true if correct
					$correct = password_verify (  "$password" , "$hash" );
					
					//if password is correct 
					if ( $correct ) {

						//Initializing Session
						$_SESSION[ 'login_user' ] = $username;

						//Redirecting to other page

						header( "Location: admin.php" );

					} else {

						$error = "Username or Password is invalid<br/><br/>"; 

					}

				}

			}
			
		}
		
		public function logout() {
			
			//Destroying all sessions
			if( session_destroy() )
			{

				//Redirecting to home page
				header( "Location: index.php" ); 

			}
			
		}
		
		public function checkLoggedIn() {
						
			$user_check = $_SESSION[ 'login_user' ];
			
			try {
				
				$query = $this->_db->prepare( "SELECT user_name FROM users WHERE user_name=:username" );

				$query->bindParam( ":username", $user_check, PDO::PARAM_STR );

				$query->execute();

				$row = $query->fetch();
				
			} catch( PDOException $e ) {

				echo $e->getMessage();

			}

			//Store username into a variable

			$user = $row[ 'user_name' ];

			if(!isset($user)) {

				//Redirecting to home page 

				header( "Location: index.php" );

			}
			
			$data = array( "user" => $user );
			
			return $data;
			
		}
		
		public function alreadyLoggedIn() {
						
			$user_check = $_SESSION[ 'login_user' ];
			
			try {
				
				$query = $this->_db->prepare( "SELECT user_name FROM users WHERE user_name=:username" );

				$query->bindParam( ":username", $user_check, PDO::PARAM_STR );

				$query->execute();

				$row = $query->fetch();
				
			} catch( PDOException $e ) {

				echo $e->getMessage();

			}

			//Store username into a variable

			$user = $row[ 'user_name' ];

			if(isset($user)) {

				//Redirecting to home page 

				header( "Location: admin.php" );

			}
			
			$data = array( "user" => $user );
			
			return $data;
			
		}
		
		public function editAbout(){
			//if form has been submitted process it
			if( isset( $_POST[ "aboutDetail" ] ) ) {
				
				global $error;

				$_POST = array_map( "stripslashes", $_POST );

				//collect form data
				extract( $_POST );

				//very basic validation
				if( $aboutDetail == "" ){

					$error[] = "Please enter the about information.";

				}

				if( !isset( $error ) ) {

					try {

						//insert into database
						$query = $this->_db->prepare( "UPDATE about SET text=:aboutDetail WHERE id=1" );

						

						$query->bindParam( ":aboutDetail", $aboutDetail, PDO::PARAM_STR );	

						$query->execute();

						exit( header( "Location: edit-about.php?action=editAbout" ) );

					} catch( PDOException $e ) {

						echo $e->getMessage();

					}

				} 

			}
		}
		
		public function fetchAbout(){
			try {
				
				$query = $this->_db->query( "SELECT text FROM about WHERE id=1" );

				return $query;
				
			} catch( PDOException $e ) {

				echo $e->getMessage();

			}
		}
		
		public function addPost() {
			
			
			///if form has been submitted process it
			if( isset( $_POST[ "submit" ] ) ) {
				
				global $error;
				$uploadFolder = "./uploads/header_images/";

				$_POST = array_map( "stripslashes", $_POST );

				//collect form data
				extract( $_POST );

				//very basic validation
				if( $postTitle == "" ){

					$error[] = "Please enter the title.";

				}

				if( $postDesc == "" ){

					$error[] = "Please enter the description.";

				}

				if( $postCont == "" ){

					$error[] = "Please enter the post content.";

				}
				
				
				foreach ($_FILES["images"] ["error"] as $key => $uploadError)
				{
					
					if ( $uploadError == UPLOAD_ERR_NO_FILE){
						$uploadOk = 0;
						echo "<h4>Please select a header image for this post.</h4>";
					}
					
					if ( $uploadError == UPLOAD_ERR_OK )
					{
						$uploadOk = 1;
						
						//gets the file name
						$name = $_FILES["images"]["name"][$key];
						
						//stores the file name
						$uploadedHeaderName = basename( $name);
						
						//check the file extension
						$fileType = pathinfo($uploadedHeaderName, PATHINFO_EXTENSION);
						
						
						//random 24 length string generator
						$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
						$randomString = substr(str_shuffle($characters), 0, 24);
						
						// stores the dot/period character for usage
						$dot = chr(46);
						
						//hashes the file name to create a set structure
						//A random string is used to prevent two files of the same name being generated
						$hashedName = md5($name.$randomString) . $dot . $fileType;
						
						$pathToUpload = $uploadFolder . basename( $hashedName);
						
						$checkIfImage = getimagesize( $_FILES["images"]["tmp_name"][$key]);
						
						if ( !$checkIfImage)
						{
							echo "<h4>Sorry - one of those files was not an image</h4>";
							$uploadOk = 0;
							$error = 1;
						}
						
						if (file_exists($pathToUpload))
						{
							echo "<h4>Sorry - file " . basename($name) . "was not uploaded.</h4>";
								$uploadOk = 0;
						}
						
						if ($_FILES["images"]["size"][$key] > 10000000)
						{
							echo("Test");
							echo "<h4>Sorry - file " . basename($name) . "is too large.</h4>";
							echo "<h4>$name</h4>";
								$uploadOk = 0;
								$error = 1;
						}
						
						
						if( $fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif")
						{
							echo "<h4>Sorry - only JPG, PNG and GIF Files are allowed.</h4>";
							$uploadOk =0;
							$error = 1;
							
						}
						
						if( !$uploadOk)
						{
							echo "<h4>Sorry - file " . basename($name) . "was not uploaded.</h4>";
							$error = 1;
							
						}else
						
						{
							if(move_uploaded_file($_FILES["images"]["tmp_name"][$key], $uploadFolder . $hashedName) )
							{
								
								//if there are no errors update to database
				
								if( !isset( $error ) ) {

									try {

											
										//insert into database
										//add header image functionality
										$query = $this->_db->prepare( "INSERT INTO blog_posts ( post_Title, post_Desc, post_Cont, post_Date, header_image ) VALUES ( :postTitle, :postDesc, :postCont, :postDate, :images )" );

										$postDate = date( "Y-m-d H:i:s" );

										$query->bindParam( ":postTitle", $postTitle, PDO::PARAM_STR );	
										$query->bindParam( ":postDesc", $postDesc, PDO::PARAM_STR );
										$query->bindParam( ":postCont", $postCont, PDO::PARAM_STR );
										$query->bindParam( ":postDate", $postDate, PDO::PARAM_STR );
										$query->bindParam( ":images", $hashedName, PDO::PARAM_STR );

										$query->execute();
										
										
										exit( header( "Location: admin.php?action=added" ) );
										

									} catch( PDOException $e ) {

										echo $e->getMessage();

									}

								}
								
								
								//write filename to db, table called portfolio, create a page to show images, by getting the file from the database
							}
						else
							
						{
							echo "<h4>Sorry - there was an error uploading your file.</h4>";
							echo "<h4>$pathToUpload</h4>";
						}
						
						
					
				}
				
			}
			
		}
				
		}
	
	}
						
		public function editPost() {
			
			//if form has been submitted process it
			if( isset( $_POST[ "submit" ] ) ) {
				
				global $error;

				$_POST = array_map( "stripslashes", $_POST );

				//collect form data
				extract( $_POST );

				//very basic validation
				if( $postTitle == "" ){

					$error[] = "Please enter the title.";

				}

				if( $postDesc == "" ){

					$error[] = "Please enter the description.";

				}

				if( $postCont == "" ){

					$error[] = "Please enter the content.";

				}

				if( !isset( $error ) ) {

					try {

						//insert into database
						$query = $this->_db->prepare( "UPDATE blog_posts SET post_Title=:postTitle, post_Desc=:postDesc, post_Cont=:postCont, post_Date=:postDate WHERE post_ID=:postID" );

						$postDate = date( "Y-m-d H:i:s" );

						$query->bindParam( ":postTitle", $postTitle, PDO::PARAM_STR );	
						$query->bindParam( ":postDesc", $postDesc, PDO::PARAM_STR );
						$query->bindParam( ":postCont", $postCont, PDO::PARAM_STR );
						$query->bindParam( ":postDate", $postDate, PDO::PARAM_STR );
						$query->bindParam( ":postID", $postID, PDO::PARAM_INT );

						$query->execute();

						exit( header( "Location: admin.php?action=edit" ) );

					} catch( PDOException $e ) {

						echo $e->getMessage();

					}

				} 

			}
			
		}
		
		public function fetchAllPosts() {
			
			try {
				
				$query = $this->_db->query( "SELECT post_ID, post_Title, post_Desc, post_Date, header_image FROM blog_posts ORDER BY post_ID DESC" );

				return $query;
				
			} catch( PDOException $e ) {

				echo $e->getMessage();

			}

		}
		
		public function fetchSinglePost( $postID ) {
			
			try {
			
				$query = $this->_db->prepare( "SELECT post_Title, post_Desc, post_Date, post_Cont FROM blog_posts WHERE post_ID=:postID LIMIT 6" );

				$query->bindParam( ":postID", $postID, PDO::PARAM_INT );

				$query->execute();

				$row = $query->fetch();
				
				$data = array( "title" => $row[ "post_Title" ], "description" => $row[ "post_Desc" ], "date" => $row[ "post_Date" ], "content" => $row[ "post_Cont" ] );
			
				return $data;

			} catch ( PDOException $e ) {

				echo $e->getMessage();

			}
		}
		
		public function fetchPosts( $searchTerm ) {
			
			if ( isset( $_POST[ 'searchButton' ] ) ) 
			{
				
				try {

					$query = $this->_db->prepare( "SELECT post_ID, post_Title, post_Desc, post_Date, header_image FROM blog_posts WHERE post_Cont OR post_Desc LIKE :searchTerm ORDER BY post_ID DESC" );

					$searchTerm = "%_%_%" . $searchTerm . "%_%_%";

					$query->bindParam( ":searchTerm", $searchTerm, PDO::PARAM_STR );

					$query->execute();

					return $query;

				} catch( PDOException $e ) {

					echo $e->getMessage();

				}	
				
			}
			
		}
		
		public function fetchRecentPosts(){
			
			try{
			
			$query = $this->_db->query(" SELECT post_ID, post_Title, post_Desc, post_Date, header_image FROM blog_posts ORDER BY post_Date DESC LIMIT 3 ");
			
			return $query;
				
				
				} catch( PDOException $e ) {

				echo $e->getMessage();

			}
				
				
		}	
		
		public function deletePost( $postID ) {
			
			if ( isset( $_POST[ 'deletePostButton' ] ) ) 
			{
				
				try {
			
					$query = $this->_db->prepare( "DELETE FROM blog_posts WHERE post_ID=:postID" );

					$query->bindParam( ":postID", $postID, PDO::PARAM_INT );

					$query->execute();

					exit( header( "Location: view-posts.php?action=delete" ) );
					
				} catch( PDOException $e ) {

					echo $e->getMessage();

				}

			}
			
		}
		
		public function allPostsPaginated( $pageNo){
			
			try{
				
			if (!isset($pageNo)) {
            $page = 1;
        	}else{
				$page = $pageNo;
			}
	
        $no_of_records_per_page = 6;
        $offset = ($page-1) * $no_of_records_per_page;

        
				
				$query = $this->_db->prepare( "SELECT post_ID, post_Title, post_Desc, post_Date, header_image FROM blog_posts ORDER BY post_ID DESC LIMIT ? , ?" );

				$query->bindParam( "1", $offset, PDO::PARAM_INT );
				$query->bindParam( "2", $no_of_records_per_page, PDO::PARAM_INT );
				$query->execute();
					
				return $query;
				
				} catch( PDOException $e ) {

				echo $e->getMessage();

			}
				
				
		}
		
		public function numberOfPages($pageNo){
			try{
				
			if (!isset($pageNo)) {
            $page = 1;
        	}else{
				$page = $pageNo;
			}
	
        $no_of_records_per_page = 6;
        $offset = ($page) * $no_of_records_per_page;

        
				
				$query = $this->_db->prepare( "SELECT post_ID, post_Title, post_Desc, post_Date, header_image FROM blog_posts ORDER BY post_ID DESC LIMIT ? , ?" );

				$query->bindParam( "1", $offset, PDO::PARAM_INT );
				$query->bindParam( "2", $no_of_records_per_page, PDO::PARAM_INT );
				$query->execute();
					
				return $query;
				
				} catch( PDOException $e ) {

				echo $e->getMessage();

			}
	
	}
		
		public function fetchSearchPaginated($searchTerm, $pageNo){
			
				
				try {
					
					if (!isset($pageNo)) {
            		$page = 1;
        			}else{
					$page = $pageNo;
					}
	
        			$no_of_records_per_page = 6;
					$offset = ($page-1) * $no_of_records_per_page;

					$query = $this->_db->prepare( "SELECT post_ID, post_Title, post_Desc, post_Date, header_image FROM blog_posts WHERE post_Cont OR post_Desc LIKE ? ORDER BY post_ID DESC LIMIT ?, ?" );

					

					$query->bindParam( "1", $searchTerm, PDO::PARAM_STR );
					$query->bindParam( "2", $offset, PDO::PARAM_INT );
					$query->bindParam( "3", $no_of_records_per_page, PDO::PARAM_INT );

					$query->execute();

					return $query;

				} catch( PDOException $e ) {

					echo $e->getMessage();

				}	
				
			}
		
		public function numberOfSearchPages($q, $pageNo){
			try{
				
			if (!isset($pageNo)) {
            $page = 1;
        	}else{
				$page = $pageNo;
			}
	
        $no_of_records_per_page = 6;
        $offset = ($page) * $no_of_records_per_page;

        
				
				$query = $this->_db->prepare( "SELECT post_ID, post_Title, post_Desc, post_Date, header_image FROM blog_posts WHERE post_Cont OR post_Desc LIKE ? ORDER BY post_ID DESC LIMIT ?, ?" );

					$searchTerm = "%_%_%" . $q . "%_%_%";

					$query->bindParam( "1", $searchTerm, PDO::PARAM_STR );
					$query->bindParam( "2", $offset, PDO::PARAM_INT );
					$query->bindParam( "3", $no_of_records_per_page, PDO::PARAM_INT );
					
				$query->execute();
				return $query;
				
				} catch( PDOException $e ) {

				echo $e->getMessage();

			}
	
	}
		
		public function numberOfSearchResults($q){
			try{
				
				$query = $this->_db->prepare( "SELECT COUNT(*) FROM blog_posts WHERE post_Cont OR post_Desc LIKE ? ORDER BY post_ID DESC" );

					$searchTerm = "%_%_%" . $q . "%_%_%";

					$query->bindParam( "1", $searchTerm, PDO::PARAM_STR );
					
				$query->execute();
				$numberOfResults = $query->fetchColumn();
				return $numberOfResults;
				
				} catch( PDOException $e ) {

				echo $e->getMessage();

			}
		}
		
		public function registerUser(){
			
			//variable to store error message
			global $error;
			
			// if submit button is pressed
			if ( isset( $_POST[ 'submit' ] ) ) 
			{
				//check if fields were left empty
				if ( empty( $_POST[ 'username' ] ) || empty( $_POST[ 'password' ] ) ) 

				{
					//error message
					$error = "Username or Password is invalid<br/><br/>"; 

				} else {   

					// Define $username and $password 
					$username = $_POST[ 'username' ]; 
					$password = $_POST[ 'password' ]; 
					
					$passHash = password_hash("$password" , PASSWORD_DEFAULT);
					
					try {

						$query = $this->_db->prepare( "INSERT INTO users ( user_name, user_password ) VALUES ( :username, :password )" );
						
						$query->bindParam( ":username", $username, PDO::PARAM_STR );
						$query->bindParam( ":password", $passHash, PDO::PARAM_STR );	

						$query->execute();

						
					} catch( PDOException $e ) {

						echo "<p>", $e->getMessage(),"</p>";

					}

					

				}

			}
			
		}
		
		public function changePassword(){
			
			//variable to store error message
			global $error;
			
			// if submit button is pressed
			if ( isset( $_POST[ 'submit' ] ) ) 
			{
				//check if fields were left empty
				if ( empty( $_POST[ 'password' ] ) || empty( $_POST[ 'passwordConf' ] ) ) 

				{
					//error message
					$error = "Fields were left empty!<br/><br/>"; 

				} elseif($_POST['password'] != $_POST['passwordConf']){
					$error = "Your password and confirmation did not match";
				} 
				
				else{   

					// Define $username and $password 
					$username = $_SESSION[ 'login_user' ]; 
					$password = $_POST[ 'password' ]; 
					
					$passHash = password_hash("$password" , PASSWORD_DEFAULT);
					
					try {

						$query = $this->_db->prepare( "UPDATE users SET user_password=:password WHERE user_name=:username" );
						
						$query->bindParam( ":username", $username, PDO::PARAM_STR );
						$query->bindParam( ":password", $passHash, PDO::PARAM_STR );	
						$query->execute();
						
						exit( header( "Location: change-password.php?action=changed" ) );
						
					} catch( PDOException $e ) {

						echo "<p>", $e->getMessage(),"</p>";

					}

					

				}

			}
			
		}
};

?>