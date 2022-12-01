<?php include_once('includes/session.php'); ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<link rel="stylesheet" href="css/tabbed.css">
<link rel="stylesheet" href="css/user.css">

<section class="home-section">

    <div class="text"> User </div>

    <div class="content update" id="edit_<?php echo $row['admin_id']; ?>">
	<h2>Update Contact #</h2>
    <form action="user_edit.php?id=<?php echo $row['admin_id']; ?>" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="1" value="<?php echo $row['admin_id'] ?>" id="id">
        <input type="text" name="firstname" placeholder="Insert Username" value="<?php echo $row['admin_username']; ?>">
        
        <input type="submit" value="Update">
    </form>
    
</div>

</section>