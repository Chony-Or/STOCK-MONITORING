<!-- Add -->
<div class="modal fade" id="add_regular" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <!-- Modal Add Content -->
        <div class="modal-content">

            <!-- Modal Add Header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Regular User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Add Body -->
            <div class="modal-body">

                <!-- Add Form -->
                <form method="POST" action="user_regular_add.php">

                    <!-- Customer Name -->
                    <div class="mb-3">
                        <label for="customer" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" name="regular_name" id="customer">
                    </div>

                    <!-- Customer Address -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" name="regular_address" id="address" rows="2"></textarea>
                    </div>

                    <!-- Customer Contact Number -->
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact Number</label>
                        <input type="number" class="form-control" name="regular_contact" id="contact">
                    </div>

                    <!-- Customer password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="regular_password" id="password">
                    </div>

            </div>

            <!-- Modal Add Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="add" class="btn btn-primary">Submit</button>
                </form> <!-- END OF FORM -->
            </div>

        </div>

    </div>

</div>

<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['customer_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <!-- Modal Edit Content -->
        <div class="modal-content">

            <!-- Modal Edit Header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Regular</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Edit Body -->
            <div class="modal-body">

                <!-- Modal Edit Form -->
                <form method="POST" action="user_regular_edit.php?id=<?php echo $row['customer_id']; ?>">

                    <!-- Customer Name -->
                    <div class="mb-3">
                        <label class="form-label">Customer Name</label>
                        <input type="text" class="form-control" name="rName" value="<?php echo $row['customer_name']; ?>">
                    </div>

                    <!-- Customer Address -->
                    <div class="mb-3">
                        <label class="form-label"> Address </label>
                        <textarea class="form-control" name="rAddress" rows="2"> <?php echo $row['customer_address']; ?> </textarea>
                    </div>

                    <!-- Customer Contact Number -->
                    <div class="mb-3">
                        <label class="form-label"> Contact Number</label>
                        <input type="number" class="form-control" name="rContact" value="<?php echo $row['customer_contactNo']; ?>">
                    </div>

                    <!-- Customer Password -->
                    <div class="mb-3">
                        <label class="form-label"> Password </label>
                        <input type="password" class="form-control" name="rPassword" aria-describedby="passwordNote" value="" autocomplete="off">
                        <div id="passwordNote" class="form-text">Leave this blank if you do not want to change password. </div>
                    </div>

            </div>
            
            <!-- Modal Edit Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="edit" class="btn btn-primary">Submit</button>
                </form> <!-- End of Edit Form -->
            </div>

        </div>

    </div>

</div>

<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['customer_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog">

        <!-- Modal Delete Content -->
        <div class="modal-content">

            <!-- Modal Delete Header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Regular Customer </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Delete Body -->
            <div class="modal-body">
                <p class="text-center">Are you sure you want to Delete</p>
                <h2 class="text-center"><?php echo $row['customer_name'] ?></h2>
            </div>

            <!-- Modal Delete Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="user_regular_delete.php?id=<?php echo $row['customer_id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
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