<!-- Password Change -->
<div class="modal fade" id="change_password_<?php echo $row['admin_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Verification for Login Input -->
            <?php
                            if (isset($_SESSION['message'])) {
                                echo "
										<div class='callout callout-danger text-center'>
											<p>" . $_SESSION['error'] . "</p> 
										</div>
									";
                                unset($_SESSION['message']);
                            }
                            if (isset($_SESSION['success'])) {
                                echo "
										<div class='callout callout-success text-center'>
											<p>" . $_SESSION['success'] . "</p> 
										</div>
									";
                                unset($_SESSION['success']);
                            }
                            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center>
                    <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                </center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="user_password.php">
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Current Password: </label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="txt_username">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;"> New Password:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="txt_password">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;"> Confirm Password: </label>
                            </div>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="txt_password">
                            </div>
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span
                        class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="change_password" class="btn btn-primary"><span
                        class="glyphicon glyphicon-floppy-disk"></span> Save</a>
                    </form>
            </div>

        </div>
    </div>
</div>