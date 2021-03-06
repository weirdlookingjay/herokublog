<?php
include '../init.php';
if($_SERVER['REQUEST_METHOD']==="POST"){
	if(isset($_POST['email'])){
		$blogID =(int) $_POST['blogID'];
		$email  =Validate::escape($_POST['email']);
		$name   =Validate::escape($_POST['name']);
		$pass   = $_POST['pass'];
		$passRe = $_POST['passRe'];
		$blog   = $dashObj->blogAuth($blogID);
		if(!empty($email) && !empty($name) && !empty($pass) && !empty($passRe)){
			if(Validate::filterEmail($email)){
				if(!$userObj->emailExist($email)){
					if($pass ===$passRe){
						$password =$userObj->hash($pass);
						if(!empty($_FILES['file']['name'][0])){
							$image = $userObj->uploadImage($_FILES['file']);
							if(!$image){
								echo $userObj->imageError();
								exit;
							}
						}else{
							$image ="frontend/assets/images/avatar.png";
						}
						if($blog->role ==="Admin"){
							$userID=$userObj->create('users',['email'=>$email,'fullName'=>$name,'password'=>$password,'profileImage'=>$image]);
							$userObj->create('blogsAuth',['blogID'=>$blog->blogID,'userID'=>$userID,'role'=>'Author']);
						}else{
							echo"Errore, non sei un Amministratore";
						}
					}else{
						Echo "Le password non corrispondono";
					}
				}else{
					echo "Email già in uso";
				}

			}else{
				echo "Errore formato email";
			}
		}
	}
}

//include "../init.php";
//
//if($_SERVER['REQUEST_METHOD'] === "POST") {
//	if(isset($_POST['email'])) {
//		$blogID = (int) $_POST['blogID'];
//		$email = Validate::escape($_POST['email']);
//		$name = Validate::escape($_POST['name']);
//		$pass = $_POST['pass'];
//		$passRe = $_POST['passRe'];
//		$blog = $dashObj->blogAuth($blogID);
//
//		if(!empty($email) && !empty($name) && !empty($pass) && !empty($passRe)) {
//			if(Validate::filterEmail($email)) {
//				if(!$userObj->emailExist($email)) {
//					if($pass === $passRe) {
//						$password = $userObj->hash($pass);
//						if(!empty($_FILES['file']['name'][0])) {
//							// Upload Image
//							$image = $userObj->uploadImage($_FILES['file']);
//							if(!$image) {
//								echo $userObj->imageError();
//								exit;
//							}
//						} else {
//							$image = "frontend/assets/images/avatar.png";
//						}
//
//						if($blog->role === "Admin") {
//							$userID = $userObj->create('users', ['email' => $email, 'fullName' => $name, 'password' => $password, 'profileImage' => $image]);
//							$userObj->create('blogsAuth', ['blogID' => $blog->blogID, 'userID' => $userID, 'role' => 'Author']);
//						} else {
//							echo "You dont have rights to perform this action!";
//						}
//					} else {
//						echo "password does not match!";
//					}
//				} else {
//					echo "Email Address is already in use!";
//				}
//			} else {
//				echo "Invalid Email Format!";
//			}
//		}
//	}
//}