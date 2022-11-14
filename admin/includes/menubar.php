<!-- INLINE STYLE TO BE FIX -->
<style>
</style>

<aside class="main-sidebar">

	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			
			<div class="pull-left image">
				<img src="<?php echo (!empty($admin['photo'])) ? '../images/'.$admin['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
			</div>
			
			<div class="pull-left info">
				
				<p><?php echo $admin['firstname'].' '.$admin['lastname']; ?></p>
				<a> Project Manager </a>
			
			</div>
		
		</div>
		
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			 
			<!--<li class="header">REPORTS</li>-->
			<li><a href="home.php"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
			<li><a href="order_status.php"><i class="fa fa-shopping-cart"></i> <span>Order Status</span></a></li>
			<li><a href="sales.php"><i class="fa fa-history"></i> <span>Sales History</span></a></li>

			<li class="treeview">
				
				<a href="#">
					
					<i class="fa fa-shopping-bag"></i>
					<span>Inventory</span>
					
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				
				</a>
				
				<ul class="treeview-menu">
					
					<li><a href="products.php"><i class="fa fa-caret-right"></i> Product List</a></li>
					<li><a href="category.php"><i class="fa fa-caret-right"></i> Category</a></li>
				
				</ul>
			</li>

			<li><a href="weekly_sales.php"><i class="fa fa-exchange"></i> <span>Weekly Sales</span></a></li>

			<!--<li class="header">MANAGE</li>-->
			<li><a href="users.php"><i class="fa fa-users"></i> <span>Users</span></a></li>
		
		</ul>
  
	</section>

<!-- /.sidebar -->
</aside>