<!-- Add -->
<div class="modal fade" id="add_admin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <!-- Modal Add Content -->
        <div class="modal-content">

            <!-- Modal Add Header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Add Body -->
            <div class="modal-body">

                <!-- Modal Add Form -->
                <form method="POST" action="user_admin_add.php">

                    <!-- Admin Username -->
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="txt_username">
                    </div>

                    <!-- Admin Password -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="txt_password">
                    </div>

            </div>

            <!-- Modal Add Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="add" class="btn btn-primary">Submit</button>
                </form> <!-- End of Form -->
            </div>

        </div>

    </div>

</div>





<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['admin_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog">

        <!-- Modal Edit Content -->
        <div class="modal-content">

            <!-- Modal Edit Header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Edit Body -->
            <div class="modal-body">

                <!-- Modal Edit Form -->
                <form method="POST" action="user_admin_edit.php?id=<?php echo $row['admin_id']; ?>">

                    <!-- Edit Username -->
                    <div class="mb-3">
                        <label class="form-label">Username: </label>
                        <input type="text" class="form-control" name="admin_uname" value="<?php echo $row['admin_username']; ?>">
                    </div>

                    <!-- Edit Password -->
                    <div class="mb-3">
                        <label for="admin_pass" class="form-label">Password: </label>
                        <input type="password" class="form-control" name="admin_pass" aria-describedby="passwordNote" value="" autocomplete="off">
                        <div id="passwordNote" class="form-text">Leave this blank if you do not want to change password. </div>
                    </div>

            </div>

            <!-- Modal Edit Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="edit" class="btn btn-primary">Submit</button>
                </form> <!-- Modal Footer -->
            </div>

        </div>

    </div>

</div>




<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['admin_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog">

        <!-- Modal Delete Content -->
        <div class="modal-content">

            <!-- Modal Delete Header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Delete Body -->
            <div class="modal-body">
                <p class="text-center">Are you sure you want to Delete</p>
                <h2 class="text-center"><?php echo $row['admin_username'] ?></h2>
            </div>

            <!-- Modal Delete Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="user_admin_delete.php?id=<?php echo $row['admin_id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<script>

    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => { myInput.focus() })
    
</script>