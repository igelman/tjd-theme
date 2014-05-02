<form class='search navbar-form navbar-left search-form' method='get' role='Search' action='<?php echo home_url( '/' ); ?>'>
	<div class='search form-group'>
		<input class='form-control search-field' type='search' placeholder='Search …' value='<?php the_search_query(); ?>' name='s' title='Search for:' />
	</div>
	<button type='submit' class='btn btn-default'><span class='glyphicon glyphicon-search'></span></button>
</form>