<!-- Call out PHP file for Session -->
<?php include 'includes/session.php'; ?>

<!-- Call out PHP file for the header -->
<?php include 'includes/header.php'; ?>

<!-- Navbar but Logo only -->
<nav class="navigation" id="navigation">
	
	<div class="content-wrapper">
			
		<a href=""> <img src="images/InitialLogo.png"> </a>
		<a href="" class="brand"> Laconsay Beverages </a>
			
	</div>
		
</nav>
	
<body>
	
	<div class="content">
			
		<div class="container">
				
			<div class="row">
					
				<div class="col-md-6">
					
					<!-- Content Design Only -->
					<div class="text-block">
						<h1> Beverages </h1>
						<p> Good Sip for Good Moments </p>
					</div>
					
						<img src="images/Image_2.png" alt="Image" class="img-fluid">
						
				</div>
					
				<div class="col-md-6 contents">
						
					<div class="row justify-content-center">
							
						<div class="col-md-8">
								
							<div class="mb-4">
								<h2><strong>Log In</strong></h2>
							</div>
							
							<!-- Verification for Login Input -->
							<?php
								if(isset($_SESSION['error']))
								{
									echo "
										<div class='callout callout-danger text-center'>
											<p>".$_SESSION['error']."</p> 
										</div>
									";
									unset($_SESSION['error']);
								}
								if(isset($_SESSION['success']))
								{
									echo "
										<div class='callout callout-success text-center'>
											<p>".$_SESSION['success']."</p> 
										</div>
									";
									unset($_SESSION['success']);
								}
							?>
							
							<!-- Form -->
							<form action="verify.php" method="POST">
									
								<div class="form-group first input-icons">
										
									<i class="fas fa-user-alt icon"></i>
									<input type="email" class="form-control" name="email" placeholder="Email" required>

								</div>
									
								<div class="form-group last mb-4 input-icons">
									
									<i class="fas fa-lock icon"></i>
									<input type="password" class="form-control" name="password" placeholder="Password" required>
                
								</div>
              
								<div class="d-flex mb-5 align-items-center">
										
									<label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
											
										<input type="checkbox" checked="checked"/>
										<div class="control__indicator"></div>
											
									</label>
									
								</div>
								
								<div class="btn-right">
								
									<button type="submit" name="login" >

										<img src="./images/Login_Icon.png" alt="submit" width="150" height="150" position="right"/>

									</button>
									
								</div>
			  
							</form>
							
						</div>
						
					</div>
          
				</div>
        
			</div>
			
		</div>
		
	</div>
	
</body>
</html>