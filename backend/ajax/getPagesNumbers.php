<?php
include '../init.php';

if($_SERVER['REQUEST_METHOD'] === "POST") {
	if(isset($_POST['postLimit'])) {
		$blogID = (int) $_POST['blogID'];
		$postLimit = (int) $_POST['postLimit'];
		$postStatus = Validate::escape($_POST['postStatus']);

		$blog = $dashObj->blogAuth($blogID);

		if($blog) {
			$dashObj->getPaginationPages($postLimit,'Post', $postStatus, $blog->blogID);
		}
	}
}