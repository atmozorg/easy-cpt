<?php
declare( strict_types = 1 );

namespace blenndiris\easy_cpt;

use WP_Taxonomy;

class Taxonomy {

	/**
	 * Default arguments for custom taxonomies.
	 *
	 * @var array
	 */
	protected array $defaults = [
		'public'          => true,
		'show_ui'         => true,
		'hierarchical'    => true,
		'query_var'       => true,
	];


	/**
	 * Return the Taxonomy labels
	 *
	 * @return array
	 */
	protected function labels() {
		return [
			'menu_name'                  => $this->plural,
			'name'                       => $this->plural,
			'singular_name'              => $this->singular,
			'name_admin_bar'             => $this->singular,
			'search_items'               => "Search {$this->plural}",
			'popular_items'              => "Popular {$this->plural}",
			'all_items'                  => "All {$this->plural}",
			'archives'                   => "{$this->plural} Archives",
			'parent_item'                => "Parent {$this->singular}",
			'parent_item_colon'          => "Parent {$this->singular}:",
			'edit_item'                  => "Edit {$this->singular}",
			'view_item'                  => "View {$this->singular}",
			'update_item'                => "Update {$this->singular}",
			'add_new_item'               => "Add New {$this->singular}",
			'new_item_name'              => "New {$this->singular} Name",
			'separate_items_with_commas' => "Separate {$this->singular} with commas",
			'add_or_remove_items'        => "Add or remove {$this->plural}",
			'choose_from_most_used'      => "Choose from most used {$this->plural}",
			'not_found'                  => "No {$this->plural} found",
			'no_terms'                   => "No {$this->plural}",
			'filter_by_item'             => "Filter by {$this->singular}",
			'items_list_navigation'      => "{$this->plural} list navigation",
			'items_list'                 => "{$this->plural} list",
			'most_used'                  => "Most Used",
			'back_to_items'              => "&larr; Back to {$this->plural}",
			'item_link'                  => "{$this->singular} Link",
			'item_link_description'      => "A link to a {$this->singular}.",
		];
	}


	/**
	 * Construct the Taxonomy object
	 *
	 * @return void
	 */
	public function __construct(
		protected string $taxonomy,
		protected array $object_type,
		protected array $args = [],
		protected array $names = [],
	) {
		$this->args = array_merge( $this->defaults, $this->args );

		if( ! isset( $names[ 'singular' ] ) ) {
			$names[ 'singular' ] = ucfirst( $taxonomy );
		}
		if( ! isset( $names[ 'plural' ] ) ) {
			$names[ 'plural' ] = $names[ 'singular' ] . 's';
		}
		$this->singular = $names[ 'singular' ];
		$this->plural = $names[ 'plural' ];
		$this->args[ 'labels' ] = $this->labels();
	}


	/**
	 * Register and return the WordPress taxonomy object
	 *
	 * @return \WP_Taxonomy
	 */
	public function init() : \WP_Taxonomy {
		$tax = \register_taxonomy( $this->taxonomy, $this->object_type, $this->args );
		return $tax;
	}
}
