<?php
include "../init.php";

if($_SERVER['REQUEST_METHOD'] === "POST") {
	if(isset($_POST['blogID'])) {
		$blogID = (int) $_POST['blogID'];
		$postIDS = json_decode($_POST['postIDs']);
		$commentIDs = json_decode($_POST['commentIDs']);
		$blog = $dashObj->blogAuth($blogID);

		if($blog) {
			if(!empty($postIDS) && !empty($commentIDs)) {
				foreach($postIDS as $postID) {
					foreach($commentIDs as $commentID) {
						$post = $userObj->get('posts', ['postID' => $postID]);

						if($post) {
							if($blog->role === 'Admin' or $blog->userID === $post->authorID) {
								$comment = $userObj->get('comments', ['postID' => $post->postID, 'commentID' => $commentID]);

								if($comment) {
									$userObj->update('comments', ['status' => 'Published'], ['commentID' => $comment->commentID, 'postID' => $post->postID]);
								} else {
									echo "You dont have rights to perform this action";
									break;
								}
							}
						}
					}
				}
			}
		}
	}
}