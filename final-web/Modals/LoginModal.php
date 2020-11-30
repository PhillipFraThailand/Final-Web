<!-- Login modal triggered in NavigationBar  -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-login">
		<div class="modal-content">

            <!-- Header and close button -->
			<div class="modal-header">				
				<h4 class="modal-title">User login</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

			<!-- Body  and forms. Post to Auth/LoginService.php -->
			<div class="modal-body">
				<form action="Auth/LoginService.php" method="post">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="email" required="required">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="password" required="required">					
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary btn-block btn-lg" value="Login">
					</div>
				</form>				
            </div>
            
            <!-- Sign up link -->
			<div class="modal-footer">
				<a href="#">Sign up</a>
			</div>
		</div>
	</div>
</div>     