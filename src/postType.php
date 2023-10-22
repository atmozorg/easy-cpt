<?php
declare( strict_types = 1 );

namespace blenndiris\easy_cpt;

use WP_Post_Type;

class PostType {

	protected string $singular;
	protected string $plural;

	/**
	 * Default arguments for custom post types.
	 */
	protected array $defaults = [
		'show_in_rest'    => true,
		'public'          => true,
		'menu_position'   => 6,
		'capability_type' => 'page',
		'hierarchical'    => true,
		'supports'        => [
			'title',
			'editor',
			'thumbnail',
		],
	];


	/**
	 * Return the CPT labels
	 *
	 * @return array
	 */
	protected function labels() : array {
		return [
			'name'                  => $this->plural,
			'singular_name'         => $this->singular,
			'menu_name'             => $this->plural,
			'name_admin_bar'        => $this->singular,
			'add_new'               => "Add New",
			'add_new_item'          => "Add New {$this->singular}",
			'new_item'              => "New {$this->singular}",
			'edit_item'             => "Edit {$this->singular}",
			'view_item'             => "View {$this->singular}",
			'all_items'             => "All {$this->plural}",
			'search_items'          => "Search {$this->plural}",
			'parent_item_colon'     => "Parent {$this->plural}:",
			'not_found'             => "No {$this->plural} found.",
			'not_found_in_trash'    => "No {$this->plural} found in trash.",
			'featured_image'        => "{$this->singular} Featured Image",
			'set_featured_image'    => "Set {$this->singular} Featured Image",
			'remove_featured_image' => "Remove {$this->singular} Featured Image",
			'use_featured_image'    => "Use {$this->singular} Featured Image",
			'archives'              => "{$this->singular} Archives",
			'insert_into_item'      => "Insert into {$this->singular}",
			'uploaded_to_this_item' => "Uploaded to this {$this->singular}",
			'filter_items_list'     => "Filter {$this->plural} list",
			'items_list_navigation' => "{$this->plural} list navigation",
			'items_list'            => "{$this->plural} list",
		];
	}


	/**
	 * Construct the postType object
	 *
	 * @return void
	 */
	public function __construct(
		protected string $post_type,
		protected array $args = [],
		protected array $names = [],
	) {
		$this->args = array_merge( $this->defaults, $this->args );

		if( ! isset( $names[ 'singular' ] ) ) {
			$names[ 'singular' ] = ucfirst( $post_type );
		}
		if( ! isset( $names[ 'plural' ] ) ) {
			$names[ 'plural' ] = $names[ 'singular' ] . 's';
		}
		$this->singular = $names[ 'singular' ];
		$this->plural = $names[ 'plural' ];
		$this->args[ 'labels' ] = $this->labels();
	}


	/**
	 * Getter
	 *
	 * @return mixed
	 */
	public function __get( string $get ) : mixed {
		return $this->$get;
	}


	/**
	 * Register and return the CPT
	 */
	public function init() : \WP_Post_Type {
		$cpt = \register_post_type( $this->post_type, $this->args );
		return $cpt;
	}
}
