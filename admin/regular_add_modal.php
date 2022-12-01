<!-- Add New -->
<div class="modal fade" id="add_regular" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <h4 class="modal-title" id="myModalLabel">Add New</h4>
                </center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="regular_add.php">
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Name:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="txt_user_name">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Address:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="txt_address">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Contact Number:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="txt_number">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Password:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="txt_user_password">
                            </div>
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span
                        class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="add_regular" class="btn btn-primary"><span
                        class="glyphicon glyphicon-floppy-disk"></span> Save</a>
                    </form>
            </div>

        </div>
    </div>
</div>