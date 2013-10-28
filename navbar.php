<div class='navbar navbar-default navbar-fixed-top' role='navigation'>
	<div class='navbar-header'>
		<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-ex1-collapse'>
			<span class='sr-only'>Toggle navigation</span>
			<span class='icon-bar'></span>
			<span class='icon-bar'></span>
			<span class='icon-bar'></span>
		</button>
		<a class='navgar-brand' href='#'>TJD</a>
	</div>

  <!-- Collect the nav links, forms, and other content for toggling -->
	<div class='collapse navbar-collapse navbar-ex1-collapse'>
		<?php
		get_search_form();
		get_template_part(menu);
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Navbar Widgets") ) {
			get_template_part(icontact);
		}
		?>
	</div><!-- /.navbar-collapse -->
</div>