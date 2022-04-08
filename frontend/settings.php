<?php
include '../backend/init.php';

if(isset($_GET['blogID']) && !empty($_GET['blogID'])) {
	$blogID = (int) $_GET['blogID'];
	$blog = $dashObj->blogAuth($blogID);

	if (!$blog) {
		$userObj->redirect('404');
	}
} else {
	$userObj->redirect('404');
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Settings - Blogger</title>
	<link rel="stylesheet" href="<?php echo getenv('BASE_URL'); ?>frontend/assets/css/style.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"/>
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div class="popup-create-wrap" id="blogFormPopup">
</div>
<!--WRAPPER-->
<div class="wrapper">
	<div class="inner-wrapper flex fl-c">
		<!--HEADER-WRAPPER-->
		<div class="header-wrapper flex fl-c">
			<header class="header">
				<div class="header-in flex fl-row">
					<div class="header-left flex fl-row fl-1">
						<div class="logo flex fl-row fl-1">
							<div>
								<i class="fab fa-blogger"></i>
							</div>
							<div class="fl-1">
								<h3>Blogger</h3>
							</div>
						</div>
						<div class="fl-4">
							<h3>Settings</h3>
						</div>
					</div>
					<div class="header-right fl-2">
						<div class="h-r-in">
							<img src="<?php echo getenv('BASE_URL').$blog->profileImage; ?>"/>
							<div class="log-out">
								<div>
									<a href="<?php echo getenv('BASE_URL'); ?>frontend/logout.php">logout</a>
								</div>
							</div>
						</div>
					</div>
				</div><!--HEADER-IN-ENDS-HERE-->
			</header>
			<div class="header-bottom flex fl-row">
				<div class="header-b-left fl-1">
					<div>
						<div class="b-h-div">
							<h4><?php echo $blog->Title; ?></h4>
						</div>
						<span>
					<a href="javascript:;" id="blogListBtn">
						<i class="fas fa-sort-down"></i>
					</a>
				</span>
						<div class="b-h-menu" id="blogListMenu">
							<div class="bhm-head">
								<h6>Your blogs</h6>
							</div>
							<div class="bhm-body">
								<!-- BlogList -->
								{BLOGS LIST}
							</div>
							<div class="bhm-footer">
								<a href="javascript:;" id="newBlogBtn">New Blog...</a>
							</div>
						</div>
					</div>
					<div>
						<a href="http://<?php echo $blog->Domain;?>.<?php echo getenv('DOMAIN') ?>" target="_blank">ViewBlog</a>
					</div>
				</div>
				<div class="header-b-right flex fl-4"></div>
			</div>
		</div><!--HEADER-WRAPPER-ENDS-HERE-->
		<!--MAIN-->
		<div class="main fl-1 flex">
			<div class="main-inner flex fl-1 fl-row ">
				<div class="main-left flex fl-1">
					<div class="main-left-inner flex fl-c fl-1">
						<div class="main-menu fl-4">
							<ul>
								<li><span><i class="fas fa-newspaper"></i></span>
									<a href="<?php echo getenv('BASE_URL'); ?>admin/blogID/<?php echo $blog->blogID; ?>/dashboard/">Posts</a>
								</li>
								<li><span><i class="far fa-chart-bar"></i></span>
									<a href="<?php echo getenv('BASE_URL'); ?>admin/blogID/<?php echo $blog->blogID; ?>/dashboard/stats">Stats</a>
								</li>
								<li><span><i class="fas fa-comment"></i></span>
									<a href="<?php echo getenv('BASE_URL'); ?>admin/blogID/<?php echo $blog->blogID; ?>/dashboard/comments">Comments</a>
								</li>
								<li><span><i class="far fa-copy"></i></span>
									<a href="<?php echo getenv('BASE_URL'); ?>admin/blogID/<?php echo $blog->blogID; ?>/dashboard/pages">Pages</a>
								</li>
								<li><span><i class="fas fa-object-group"></i></span>
									<a href="<?php echo getenv('BASE_URL'); ?>admin/blogID/<?php echo $blog->blogID; ?>/dashboard/layout">Layout</a>
								</li>
								<li><span><i class="fas fa-pager"></i></span>
									<a href="<?php echo getenv('BASE_URL'); ?>admin/blogID/<?php echo $blog->blogID; ?>/template/edit">Template</a>
								</li>
								<li class="active"><span><i class="fas fa-cog"></i></span>
									<a href="<?php echo getenv('BASE_URL'); ?>admin/blogID/<?php echo $blog->blogID; ?>/dashboard/settings">Settings</a>
								</li>
							</ul>
						</div>
						<!--FOOTER-->
						<div class="footer">
							<div class="footer-inner">
								<ul>
									<li><a href="#">Terms of Service</a></li>|
									<li><a href="#">Privacy</a></li>|
									<li><a href="#">Content Policy</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="main-right flex fl-4">
					<div class="settings">
						<div class="settings-inner">
							<div class="basic-settings">
								<div class=" b-line">
									<div class="sec-1">
										<div class="b-title">
											Basic
										</div>
										<table>
											<tbody>
											<tr>
												<td class="td-title">
													<span>Title</span>
												</td>
												<td class="td-des">
									<span class="bt-title">
										<span id="titleBox">
											<?php echo $blog->Title; ?>
										</span>
										<a href="javascript:;" id="titleBtn">Edit</a>
									</span>
													<div class="bn-title" id="titleBlock">
														<div class="bn-input">
															<input type="text" name="title" value="<?php echo $blog->Title; ?>" id="titleInput" autocomplete="off">
															<div class="bt-error" id="titleError">
															</div>
														</div>
														<div class="bn-button">
															<button class="btn-newp" id="titleSaveBtn" data-blog="<?php echo $blog->blogID; ?>">Save changes</button>
															<button class="cancel-btn" id="titleCancelBtn">Cancel</button>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td class="td-title">
													<span>Description</span>
												</td>
												<td class="td-des">
									<span>
										<span id="descBox">
											<?php echo $blog->Description; ?>
										</span>
										<a href="javascript:;" id="descBtn">Edit</a>
									</span>
													<div class="bn-title" id="descBlock">
														<div class="bn-input">
															<textarea class="text-area" id="descInput" autocomplete="off"><?php echo $blog->Description; ?></textarea>
															<div class="bt-error" id="descError">
															</div>
															<div>
																<span style="color:#888484;font-size: 13px;">500 Characters Max</span>
															</div>
														</div>
														<div class="bn-button">
															<button class="btn-newp" id="descSaveBtn">Save changes</button>
															<button class="cancel-btn" id="descCancelBtn">Cancel</button>
														</div>
													</div>
												</td>
											</tr>

											</tbody>
										</table>
									</div>
								</div>
								<div class=" b-line">
									<div class="sec-1">
										<div class="b-title">
											Permissions
										</div>
										<table>
											<tbody>
											<tr>
												<td class="td-title">
													<span>Blog Author</span>
												</td>
												<td class="td-des">
													<div class="blog-author">
														<div class="ba-inner flex fl-c" id="authorList">
															<!-- Authors -->
															<?php $dashObj->getAuthorList($blog->blogID); ?>
														</div>
													</div>
													<div style="padding-top: 10px; padding-bottom: 10px;">
														<span><a href="javascript:;" id="authorBtn">+Add author</a></span>
													</div>
													<div class="au-main">
														<div class="au-left">
															<div class="bn-input ad-auth">
																<div class="ad-auth-head">
																	Add author Email
																</div>
																<div>
																	<input type="email" name="email" id="emailInput" autocomplete="off">
																</div>
																<div class="bt-error" id="emailError">
																</div>
																<div class="ad-auth-head">
																	Add author Fullname
																</div>
																<div>
																	<input type="text" name="fullname" id="nameInput" autocomplete="off">
																</div>
																<div class="bt-error" id="nameError">
																</div>
																<div class="ad-auth-head">
																	Add author Password
																</div>
																<div>
																	<input type="password" name="password" id="passInput" autocomplete="off">
																</div>
																<div class="bt-error" id="passError">
																</div>
																<div class="ad-auth-head">
																	Confirm author Password
																</div>
																<div>
																	<input type="password" name="passwordRe" id="passReInput" autocomplete="off">
																</div>
																<div class="bt-error" id="passReError" autocomplete="off">
																</div>
															</div>
														</div>
														<div class="au-right">
															<div>
																<img src="<?php echo getenv('BASE_URL'); ?>frontend/assets/images/avatar-image.png" id="previewImage">
															</div>
														</div>
														<div class="bn-button">
															<input type="file" id="file" name="file">
															<button class="btn-newp" id="formSave" data-blog="<?php echo $blog->blogID; ?><">Save changes</button>
															<button class="cancel-btn" id="formClose">Cancel</button>
														</div>
													</div>
												</td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class=" b-line">
									<div class="sec-1">
										<div class="b-title">
											Meta tags
										</div>
										<table>
											<tbody>
											<tr>
												<td class="td-title">
													<span>Description</span>
												</td>
												<td class="td-des">
									<span class="bt-title">
										<span id="metaDescBox">
											<?php echo $blog->MetaDescription; ?>
										</span>
										<a href="javascript:;" id="metaDescBtn">Edit</a>
									</span>
													<div class="bn-title" id="metaDescBlock">
														<div class="bn-input">
															<textarea class="text-area" id="metaDescInput" autocomplete="off"><?php echo $blog->MetaDescription; ?></textarea>
															<div class="bt-error" id="metaDescError">
															</div>
															<div>
																<span style="color:#888484;font-size: 13px;">150 Characters Max. Example: "A blog about social networking and web design."</span>
															</div>
														</div>
														<div class="bn-button">
															<button class="btn-newp" id="metaSaveBtn">Save changes</button>
															<button class="cancel-btn" id="metaCancelBtn">Cancel</button>
														</div>
													</div>
												</td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class=" b-line">
									<div class="sec-1">
										<div class="b-title">
											Posts
										</div>
										<table>
											<tbody>
											<tr>
												<td class="td-title">
													<span> Show at most </span>
												</td>
												<td class="td-des">
									<span class="bt-title">
										<input type="text" name="postLimit" id="postInput" size="2" value="{BLOG POSTLIMIT}">
									</span>
													<span class="bt-title">
										on the main page
									</span>
												</td>
											</tr>
											</tbody>
										</table>
										<div class="bn-button">
											<button class="btn-newp" id="postSaveBtn">Save changes</button>
										</div>
									</div>
								</div>
								<div class=" b-line">
									<div class="sec-1">
										<div class="b-title">
											Errors and redirections
										</div>
										<table>
											<tbody>
											<tr>
												<td class="td-title">
													<span> Custom Page Not Found </span>
												</td>
												<td class="td-des">
									<span>
										<a href="javascript:;" id="customEditBtn">Edit</a>
									</span>
													<div class="bn-title" id="customBlock">
														<div class="bn-input">
															<textarea class="text-area" id="customInput" autocomplete="off">{BLOG CUSTOM ERROR}</textarea>
															<div class="bt-error" id="customError">
															</div>
															<div>
															</div>
														</div>
														<div class="bn-button">
															<button class="btn-newp" id="customSaveBtn">Save changes</button>
															<button class="cancel-btn" id="customCancelBtn">Cancel</button>
														</div>
													</div>
												</td>
											</tr>
											</tbody>
										</table>
									</div>
									<div>

									</div>
								</div>
								<div class=" b-line">
									<div class="sec-1">
										<div class="b-title">
											Comments
										</div>
										<table>
											<tbody>
											<tr>
												<td class="td-title">
													<span>Comment Moderation</span>
												</td>
												<td class="td-des">
													<div class="cm-radio-label">
														<input id="r1" type="radio" name="commentMod" value="always">
														<label for="r1">Always</label>
													</div>
													<div class="cm-radio-label">
														<input id="r2" type="radio" name="commentMod" value="never">
														<label for="r2">Never</label>
													</div>
												</td>
											</tr>
											</tbody>
										</table>
										<div class="bn-button">
											<button class="btn-newp" id="commentBtn">Save changes</button>
										</div>
									</div>
								</div>
								<div class=" b-line">
									<div class="sec-1">
										<div class="b-title">
											Edit Your Profile
										</div>
										<table>
											<tbody>
											<tr>
												<td class="td-title">
													<span>Email</span>
												</td>
												<td class="td-des">
									<span class="bt-title">
									</span>
													<div class="bn-title, display">
														<div class="bn-input">
															<input type="text" name="email" id="editEmail" value="{BLOG EMAIL}" autocomplete="off">
															<div class="bt-error" id="editEmailError">
															</div>
														</div>
													</div>
												</td>
												<td class="td-title" style="padding-top:15px;color:#888;">
													<span>Email address for readers to contact you.</span>
												</td>
											</tr>
											<tr>
												<td class="td-title">
													<span>Display name</span>
												</td>
												<td class="td-des">
													<span class="bt-title"></span>
													<div class="bn-title, display">
														<div class="bn-input">
															<input type="text" name="displayName" id="editDisplaName" value="{BLOG FULL-NAME}" autocomplete="off">
															<div class="bt-error" id="displayNameError">
															</div>
														</div>
													</div>
												</td>
												<td class="td-title" style="padding-top:15px;color:#888;">
													<span>The name used to sign your blog posts. </span>
												</td>
											</tr>
											<tr>
												<td class="td-title">
													<span>Profile Photo</span>
												</td>
												<td class="td-des" style="vertical-align:bottom;">
													<div class="au-right">
														<div>
															<img id="editProfileImage" src="<?php echo getenv('BASE_URL').$blog->profileImage; ?>">
														</div>
													</div>
												</td>
												<td></td>
											</tr>
											<tr>
												<td></td>
												<td>
													<div class="bn-button">
														<input type="file" id="editProfile">
													</div>
												</td>
												<td>
													<div class="bn-button">
														<button class="btn-newp" id="saveProfileBtn">Save changes</button>
													</div>
												</td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class=" b-line">
									<div class="sec-1">
										<div class="b-title">
											Change Password
										</div>
										<table>
											<tbody>
											<tr>
												<td class="td-title">
													<span>Change Password</span>
												</td>
												<td class="td-des">
													<span class="bt-title"></span>
													<div class="bn-title, display">
														<div class="bn-input">
															<input type="password" name="editCurPass" id="editCurPass" placeholder="Current Pass">
															<div class="bt-error">
															</div>
														</div>
													</div>
												</td>
												<td class="td-title" style="padding-top:15px;color:#888;"><span>Type Current Password</span></td>
											</tr>

											<tr>
												<td class="td-title"><span></span></td>
												<td class="td-des">
													<span class="bt-title"></span>
													<div class="bn-title display">
														<div class="bn-input">
															<input type="password" name="editNewPass" id="editNewPass" placeholder="New Password">
														</div>
													</div>
												</td>
												<td class="td-title" style="padding-top:15px;color:#888;"><span>Type New Password</span></td>
											</tr>
											<tr>
												<td class="td-title"><span></span></td>
												<td class="td-des">
													<span class="bt-title"></span>
													<div class="bn-title, display">
														<div class="bn-input">
															<input type="password" name="editNewPassAgain" id="editNewPassAgain" placeholder="Confirm Password">
															<div class="bt-error" id="editPassError">
															</div>
														</div>
													</div>
												</td>
												<td class="td-title" style="padding-top:15px;color:#888;"><span>Confirm Your Password</span></td>
											</tr>
											<tr>
												<td></td>
												<td>
													<div class="bn-button">
														<button class="btn-newp" id="passSaveBtn">Save changes</button>
													</div>
												</td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!--setting-inner-ends-->
					</div>
					<!-- js files -->
					<script type="text/javascript" src="<?php echo getenv('BASE_URL'); ?>frontend/assets/js/basicSettings.js"></script>
					<script type="text/javascript" src="<?php echo getenv('BASE_URL'); ?>frontend/assets/js/setAuthor.js"></script>
				</div>
				<!--MAIN-Right-DIV-ENDS-HERE-->
			</div>
		</div><!--MAIN-DIV-ENDS-HERE-->
	</div>
</div>
</body>
</html>
