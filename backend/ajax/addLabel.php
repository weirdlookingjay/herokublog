<?php
include '../init.php';

if($_SERVER['REQUEST_METHOD'] === "POST") {
    if(isset($_POST['newLabel'])) {
        $blogID = (int) $_POST['blogID'];
        $newLabel = Validate::escape($_POST['newLabel']);
        $postIDs = json_decode($_POST['postID']);
        $blog = $dashObj->blogAuth($blogID);

        if($blog) {
            if(!empty($postIDs) && !empty($newLabel)) {
                if(preg_match("/^[a-z0-9]+$/i", $newLabel)) {
                    foreach($postIDs as $postID) {
                        $post = $userObj->get('posts', ['postID' => $postID]);
                        if($blog->role === "Admin" or $blog->userID === $post->authorID) {
                            $label = $userObj->get('labels', ['labelName' => $newLabel, 'postID' => $post->postID, 'blogID' => $blog->blogID]);

                            if($label) {
                                //delete Label
                                $userObj->delete('labels', ['labelName' => $label->labelName, 'postID' => $postID, 'blogID' => $blog->blogID]);
                            } else {
                                //Create label
                                $userObj->create('labels', ['labelName' => $newLabel, 'postID' => $postID, 'blogID' => $blog->blogID]);
                            }
                        }
                    }
                }
            }
        }
    }
}
