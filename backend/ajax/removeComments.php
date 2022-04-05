<?php
include '../init.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
	if (isset($_POST['postIDs'])) {
		$postIDs = json_decode($_POST['postIDs']);
		$commentIDs = json_decode($_POST['commentIDs']);
		$blog = $dashObj->blogAuth($_POST['blogID']);

		if (!empty($postIDs) && !empty($commentIDs)) {
			foreach ($postIDs as $postID) {
				foreach ($commentIDs as $commentID) {
					if ($blog) {
						$post = $userObj->get('posts', ['postID' => $postID, 'blogID' => $blog->blogID]);
						if ($blog->role === "Admin" OR $blog->userID === $post->authorID) {

							$comment = $userObj->get('comments', ['commentID' => $commentID, 'postID' => $postID, 'blogID' => $blog->blogID]);

							if($comment) {
								$userObj->delete('comments', ['commentID' => $comment->commentID, 'postID' => $post->postID, 'blogID' => $blog->blogID]);
							}

						} else {
							echo "You don't have rights to perform this action!";
							break;
						}
					}
				}
			}
		}
	}
}