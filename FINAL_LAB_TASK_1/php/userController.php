<?php 
	session_start();
	require_once('../php/session_header.php');
	require_once('../service/userService.php');


	//add user
	if(isset($_POST['create'])){
		$username 	= $_POST['username'];
		$password 	= $_POST['password'];
		$email 		= $_POST['email'];

		if(empty($username) || empty($password) || empty($email)){
			header('location: ../views/register.php?error=null_value');
		}else{

			$user = [
				'username'=> $username,
				'password'=> $password,
				'email'=> $email
			];

			$status = insert($user);

			if($status){
				header('location: ../views/all_users.php?success=done');
			}else{
				header('location: ../views/create.php?error=db_error');
			}
		}
	}

	//update user
	if(isset($_POST['edit'])){

		$username 	= $_POST['username'];
		$password 	= $_POST['password'];
		$email 		= $_POST['email'];
		$id 		= $_POST['id'];

		if(empty($username) || empty($password) || empty($email)){
			header('location: ../views/company_edit.php?id={$id}');
		}else{

			$user = [
				'username'=> $username,
				'password'=> $password,
				'email'=> $email,
				'id'=> $id
			];

			$status = update($user);

			if($status){
				header('location: ../views/all_users.php?success=done');
			}else{
				header('location: ../views/edit.php?id={$id}');
			}
		}
	}

	if(isset($_POST['delete'])){

		$username 	= $_POST['username'];
		$password 	= $_POST['password'];
		$email 		= $_POST['email'];
		$id 		= $_POST['id'];

		
		

			$user = [
				'username'=> $username,
				'password'=> $password,
				'email'=> $email,
				'id'=> $id
			];

			$status = delete($user);

			if($status){
				header('location: ../views/all_users.php?success=done');
			}else{
				header('location: ../views/delete.php?id={$id}');
			}
		}
	
	//edit company

	if(isset($_POST['editcompany'])){

		    $id                   = $_POST['id'];
			$company_name         = $_POST['company_name'];
			$profile_description  = $_POST['profile_description'];
			$industry             = $_POST['industry'];
			$company_website      = $_POST['company_website'];
			$filedir              ='../pic/'.$id.".png";

       //echo"null";
	if(empty($_POST['company_name']) || empty($_POST['profile_description']) || empty($_POST['industry']) || empty($_POST['company_website']) || empty($_FILES['company_logo'])){
			header('location: ../views/company_edit.php?id={$id}');
		}
		else{

			
			$company = [
				'id'=> $id,
				'company_name'=> $company_name,
				'profile_description'=> $profile_description,
				'industry'=> $industry,
				'company_website'=> $company_website,
				'company_logo'=> $filedir,
				'user_account_id'=> getId($_SESSION['username'])
			];
			var_dump($company);

			$status = updateCompany($company);
			//echo $status;
			if($status){
				if(move_uploaded_file($_FILES['company_logo']['tmp_name'], $filedir))
				{
					echo "Done";
				}
				header('location: ../views/company_info.php?success=registration_done');
			}else{
				header('location: ../views/company_edit.php?error=db_error');
			}
		}
	}

	//delete company
	if(isset($_POST['deletecompany'])){

		$id                  = $_POST['id'];
		$company_name        = $_POST['company_name'];
		$profile_description = $_POST['profile_description'];
		$industry            = $_POST['industry'];
		$company_website     = $_POST['company_website'];
		$filedir             ='../pictures/'.$id.".png";
		$company = [
			'id'=> $id,
			'company_name'=> $company_name,
			'profile_description'=> $profile_description,
			'industry'=> $industry,
			'company_website'=> $company_website,
			'company_logo'=> $filedir,
			'user_account_id'=> getId($_SESSION['username'])
		];

		$status = deleteCompany($company);

		if($status){
			header('location: ../views/company_info.php?success=done');
		}
		else{
			header('location: ../views/company_delete.php?id={$id}null');
		}
	}



?>


