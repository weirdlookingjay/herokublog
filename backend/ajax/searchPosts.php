<?php
include '../init.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
	if (isset($_POST['search'])) {
		$search = Validate::escape($_POST['search']);
		$blogID = (int)$_POST['blogID'];
		$blog = $dashObj->blogAuth($blogID);
		$posts = $dashObj->searchPosts($search, $blog->blogID);

		if ($blog) {
			if ($posts) {
				foreach ($posts as $post) {
					$date = new DateTime($post->createdDate);
					echo '<div class="m-r-c-inner">
                            <div class="posts-wrap">
	                            <div class="posts-wrap-inner">
		                            <div class="post-link flex fl-row">
			                            <div class="post-in-left fl-1 fl-row flex">
				                            <div class="p-in-check">
				                            <input type="checkbox" class="postCheckBox" value="' . $post->postID . '" data-blog="' . $post->blogID . '"/>
				                            </div>
				                            <div class="fl-1">
					                            <div class="p-l-head flex fl-row">
						                            <div class="pl-head-left fl-1">
							                            <div class="pl-h-lr-link">
							                            	<a href="{POST-LINK}">' . $post->title . '</a>
							                            </div>
							                            <div class="pl-h-lf-link">
								                            <ul>
								                            ' . $dashObj->getPostLabels($post->postID, $post->blogID) . '
								                            </ul>
							                            </div>
							                         </div>
						                            <div class="pl-head-right">
						                            <span>' . (($post->postStatus === 'draft') ? 'draft' : '') . '</span> 						                            
						                            </div>
                           					    </div>
					                            <div class="p-l-footer">
						                            <ul>
						                            	<li><a href="{EDIT-LINK}">Edit</a></li>|		
						                            	<li><a href="javascript:;" id="deletePost" data-post="' . $post->postID . '" data-blog="' . $post->blogID . '">Delete</a></li>
						                            </ul>
					                            </div>
				                            </div>
				                        </div>
			                            <div class="post-in-right">
				                            <div class="p-in-right flex fl-1">
					                            <div class="pl-auth-name"><span>
					                                <a href="javascript:;">' . $post->fullName . '</a></span>
				                                </div>
					                            <div class="pl-cm-count">
						                            <span>0</span>
						                            <span><i class="fas fa-comment"></i></span>
					                            </div>
					                            <div class="pl-views-count">
						                            <span>0</span>
						                            <span><i class="fas fa-eye"></i></span>
					                            </div>
					                            <div class="pl-post-date">
					                            	<span>' . $date->format('d/m/y') . '</span>
					                            </div> 
					                        </div>
                            			</div>
                           			</div>
                            	</div>
                            </div>
                         </div>';
				}
			} else {
				echo '<div class="posts-wrap">
				        <div class="posts-wrap-inner">
				            <div class="nopost flex">
				                <div>
				                    <p>There are no posts. </p>
				                </div>
				            </div>
				        </div>
        			</div>';
			}
		}
	}
}