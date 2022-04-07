<?php
include "../init.php";

if($_SERVER['REQUEST_METHOD'] === "POST") {
	if(isset($_POST['title'])) {
		$title = Validate::escape($_POST['title']);
		$blogID = (int) $_POST['blogID'];
		$blog = $dashObj->blogAuth($blogID);

		if($blog) {
			if($blog->role === "Admin") {
				if(!empty($title)) {
					$userObj->update('blogs', ['Title' => $title], ['blogID' => $blog->blogID]);
				}
			} else {
				echo "Owner Error";
			}
		}
	}
}