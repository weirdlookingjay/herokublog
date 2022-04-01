<?php
include '../init.php';

if($_SERVER['REQUEST_METHOD'] === "POST") {
	if(isset($_POST['previousPage'])) {
		$blogID = (int) $_POST['blogID'];
		$page = (int) $_POST['previousPage'];
		$postLimit = (int) $_POST['postLimit'];
		$postStatus = Validate::escape($_POST['postStatus']);

		$blog = $dashObj->blogAuth($blogID);

		if($blog) {
			$dashObj->getAllPosts($page, $postLimit, 'Post', '', $blog->blogID);
		}
	}
}