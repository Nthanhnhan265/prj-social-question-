<div class="container">
    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 edit_information">
        <form action="update.php" method="POST">
            <h3 class="text-center">Edit Personal Information</h3>
            <div class="row">
                <div class="text-center">
                    <div class="form-group">
                        <!-- Hiển thị ảnh đại diện -->
                        <img src="../public/avatar/Screenshot 2023-12-26 020145.png" style="width: 20px; height: 20px; border-radius: 50%" alt="">
                        <h2><label class="profile_details_text"><?php echo $user['username']?></label> </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="profile_details_text">First Name:</label>
                        <!-- Trường nhập thông tin First Name -->
                        <input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo $user['firstname']?>" required>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="profile_details_text">Last Name: </label>
                        <!-- Trường nhập thông tin Last Name -->
                        <input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo $user['lastname']?>" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="profile_details_text">Description</label>
                        <!-- Trường nhập thông tin Description -->
                        <input type="text" name="description" id="description" class="form-control" value="<?php echo $user['description']?>" required>
                    </div>
                </div>
            </div>
				
				<!-- <div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="profile_details_text">Nhập Mật Khẩu Hiện Tại:</label>
							<input type="password" name="password" id="password" class="form-control" value="" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="profile_details_text">Nhập Mật Khẩu Mới:</label>
							<input type="password" name="newpassword" id="newpassword" class="form-control" value="" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="profile_details_text">Nhập Lại Mật Khẩu Mới:</label>
							<input type="password" name="repassword" id="repassword" class="form-control" value="" required>
						</div>
					</div>
				</div> -->

            <div class="mb-3 px-2">
                <label for="" class="form-label text-purple">Choose Your Avatar</label>
                <!-- Trường chọn file Avatar -->
                <input type="file" id="avt_regis" name="avt" class="form-control">
                <div id="error_avt_regis" style="color: red;"></div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 submit">
                    <div class="form-group">
                        <!-- Nút Submit để cập nhật thông tin -->
                        <input type="submit" class="btn btn-success" id="submit" name="submit" value="Submit">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

			