<?php
declare( strict_types = 1 );

namespace blenndiris\easy_cpt;

use WP_Post_Type;

class PostTypeAdmin {


	/**
	 * Default arguments for custom post types.
	 */
	protected array $defaults = [
	];


	/**
	 * Construct the postTypeAdmin object
	 */
	public function __construct(
		protected PostType $ept,
		protected array $args = [],
	) {
		$this->args = array_merge( $this->defaults, $this->args );
	}


	/**
	 * Add filter to dashboard_glance_items
	 */
	public function init() : void {
		\add_filter( 'dashboard_glance_items', [ $this, 'dashboard_glance_items' ] );
	}


	/**
	 * Adds the CPT info to the dashboard At a Glance widget
	 *
	 * @param array $items
	 *
	 * @return array
	 */
	public function dashboard_glance_items( array $items ) : array {
		$obj = \get_post_type_object( $this->ept->post_type );

		if(
			! \current_user_can( $obj->cap->edit_posts ) ||
			$obj->_builtin
		) {
			return $items;
		}

		$count = \wp_count_posts( $this->ept->post_type );
		$num = $count->publish;

		$singular_name = $this->ept->args[ 'labels' ][ 'singular_name' ];
		$plural_name = $this->ept->args[ 'labels' ][ 'name' ];
		$name = \_n( $singular_name, $plural_name, $num );
		$url = \add_query_arg(
			[
				'post_type' => $this->ept->post_type,
			],
			\admin_url( 'edit.php' )
		);

		$item = sprintf(
			'<a href="%1$s">%2$s</a>',
			$url,
			"$num $name",
		);
		$items[] = $item;

		return $items;
	}
}
