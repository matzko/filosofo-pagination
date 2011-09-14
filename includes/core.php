<?php

class Filosofo_Pagination_Control
{
	public function __construct()
	{
		add_action('filosofo_pagination', array( $this, 'pagination' ) );
	}

	public function get_pagination( $args = array() )
	{
		global $paged, $posts_per_page, $request, $wp_query, $wpdb;
		$query_obj = get_queried_object();

		if ( is_single() || is_page() ) 
			return true;

		if ( is_string($args) )
			parse_str($args, $args);

		$defaults = array(
			'adjacents' => 1,
			'newer_link' => __( 'Newer Posts', 'filosofo-pagination' ),
			'older_link' => __( 'Older Posts', 'filosofo-pagination' ),
			'type' => 'list',
		);

		$args = array_merge( $defaults, $args );

		if( is_tax() ) {
			$total_items = isset( $query_obj->count ) ? (int) $query_obj->count : 0;
		} else {
			$total_items = $wp_query->found_posts;
		}

		$limit = $posts_per_page;
		$page = empty( $paged ) ? 1 : (int) $paged;

		// hacky way to generate link base
		$base = get_pagenum_link( 367965 );
		$base = str_replace( '367965', '%#%', $base );

		$page_links = paginate_links( array(
			'base' => $base,
			'format' => '',
			'prev_text' => $args['newer_link'],
			'next_text' => $args['older_link'],
			'total' => $wp_query->max_num_pages,
			'current' => $page,
			'type' => $args['type'],
		));
		return $page_links;
	}

	public function pagination( $args = null ) 
	{
		echo $this->get_pagination( $args );
	}
}

$GLOBALS['filosofo_pagination'] = new Filosofo_Pagination_Control;
