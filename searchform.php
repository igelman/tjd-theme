<form role="search" method="get" class="navbar-form navbar-left search-form" role="Search" action="<?php echo home_url( '/' ); ?>">
	<div class="form-group">
		<input type="search" class="form-control search-field" placeholder="Search …" value="<?php the_search_query(); ?>" name="s" title="Search for:" />
	</div>
	<button type="submit" class="btn btn-default">Search</button>
	<!-- <input type="submit" class="search-submit" value="Search" /> -->
</form>