<div class="" style="border-radius:6px">
	<div class=" px-4 mb-2 bg-white pb-2 pt-3 mt-2 edit_information ">
		<h6 class="d-flex align-items-center"><span class="pe-2 material-symbols-outlined">
edit
</span>Edit your information</h6>
		<form action="edit-user-info.php" class="d-flex justify-content-center" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">First Name:</label>
						<input type="text" name="firstname" class="form-control"
						value="<?php echo $user['firstname'] ?>" required>
					</div>
					<input type="hidden" name="old-avatar" id='old-avatar' class="form-control" value="<?php echo($user['avatar']); ?>">
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Last Name: </label>
						<input type="text" name="lastname" class="form-control" value="<?php echo $user['lastname'] ?>"
							required>
					</div>
				</div>
				<div class="row">
					<div class="">
						<div class="form-group">
							<label class="profile_details_text">Description: </label>
							<textarea name="description" id="description" cols="30" rows="2" class='px-2'><?php echo $user['description']?></textarea>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-6">
							<label class="profile_details_text">Avatar </label>
							<input type="file" name="avatar" class="form-control"
						>
						</div>
						<div class="form-group col-6 mt-4 d-flex">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-end">
								<input type="submit" class="btn btn-success" value="Submit">
							</div>
						</div>
					</div>
				</div>

				<div class="row pt-2">
				</div>
		</form>
	</div>
</div>



<!-- 

<div class="bg-white mt-3 container py-2 px-4" style="border-radius:6px">
<h6 class="d-flex align-items-center">
<span class="pe-2 material-symbols-outlined">
build
</span>
Change your Password</h6>

<form action="" method="POST">
		<div class="row">

			<div class="col-6">
				<div class="form-group">
					<label class="profile_details_text">Old Password </label>
					<input type="text" name="last_name" class="form-control" value="<?php echo $user['lastname'] ?>"
						required>
				</div>
			</div>
		</div>
		<div class="row">

			<div class="col-6">
				<div class="form-group">
					<label class="profile_details_text">Confirm Password</label>
					<input type="text" name="last_name" class="form-control" value="<?php echo $user['lastname'] ?>"
						required>
				</div>
			</div>

			<div class="col-6">
				<div class="form-group">
					<label class="profile_details_text">Confirm Password</label>
					<input type="text" name="last_name" class="form-control" value="<?php echo $user['lastname'] ?>"
						required>
				</div>
			</div>
		</div>


		<div class="row pt-2">
			<div class="col-6"></div>
			<div class="col-6 d-flex justify-content-end">
				<div class="form-group me-5 pb-2">
					<input type="submit" class="btn btn-success" value="Change Password">
				</div>
			</div>
		</div>
	</form>
</div> -->
</div>