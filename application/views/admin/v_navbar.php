<aside id="left-panel" class="left-panel">
	<nav class="navbar navbar-expand-sm navbar-default">

		<div id="main-menu" class="main-menu collapse navbar-collapse">
			<ul class="nav navbar-nav">
			   
				<li class="menu-title">Admin Control</li><!-- /.menu-title -->
				
				
				<li <?php if ($navnav == 1 ){ echo "class='active'"; } ?>>
					<a href="<?php echo base_url(); ?>administrator" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-credit-card"></i>Data Invoice</a>
					
				</li>
				<li <?php if ($navnav == 2 ){ echo "class='active'"; } ?>>
					<a href="<?php echo base_url(); ?>administrator/user" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Data User</a>
				</li>


				<li <?php if ($navnav == 3 ){ echo "class='active'"; } ?>>
					<a href="<?php echo base_url(); ?>administrator/contact" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Data Contact Us</a>
				</li>

				<li>
					<a style="color:red;" href="<?php echo base_url(); ?>administrator/logout" aria-haspopup="true" aria-expanded="false"> <i style="color:red;" class="menu-icon fa fa-sign-out"></i>Logout</a>
				</li>
				
			</ul>
		</div><!-- /.navbar-collapse -->
	</nav>
</aside><!-- /#left-panel -->