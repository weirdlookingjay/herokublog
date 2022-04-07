<?php
    include "../init.php";

if($_SERVER['REQUEST_METHOD'] === "POST") {
    if(isset($_POST['postID'])) {
        $postID = (int) $_POST['postID'];
        $blogID = (int) $_POST['blogID'];
        $commentID = (int) $_POST['commentID'];

        $post = $userObj->get('posts', ['postID' => $postID, 'blogID' => $blogID]);

        $blog = $dashObj->blogAuth($blogID);

        if($post) {
            if($blog->role === "Admin" or $blog->userID === $post->authorID) {
                if($post) {
                	$comment =  $userObj->get('comments', ['commentID' => $commentID, 'postID' => $post->postID, 'blogID' => $post->blogID]);

                	if($comment) {
		                $userObj->delete('comments', ['commentID' => $comment->commentID, 'postID' => $post->postID, 'blogID' => $post->blogID]);
	                }
                } else {
                    echo 'you dont\'t have rights to perform this action!';
                }
            }
        }
    } else {
        echo 'something went wrong!';
    }
}