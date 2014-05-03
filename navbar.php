<header>
	<div class='header-content'>
		<img class='logo' src='http://placehold.it/250x50'>
		<?php
		/*******
		* Insert searchform.php
		* Insert icontact.php (unless we're using a WordPress widget for the form)
		********/
		get_search_form();
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Navbar Widgets") ) {
			get_template_part(icontact);
		}
		?>
	</div> <!-- div.header-content -->

	<nav class='navbar navbar-default' role='navigation'>
		<div class='container-fluid'>	
			<div class='navbar-header'>
				<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-ex1-collapse'>
					<span class='sr-only'>Toggle navigation</span>
					<span class='icon-bar'></span>
					<span class='icon-bar'></span>
					<span class='icon-bar'></span>
				</button>
				<a class='navgar-brand' href='#'>TJD</a>
			</div>
		</div>
	
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class='collapse navbar-collapse navbar-ex1-collapse'>
			<?php
			// Insert menu.php
			get_template_part(menu);
			?>
		</div><!-- /.navbar-collapse -->
	</nav>
</header>