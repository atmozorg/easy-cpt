<?php
declare( strict_types = 1 );

use blenndiris\easy_cpt\PostType;
use blenndiris\easy_cpt\PostTypeAdmin;
use blenndiris\easy_cpt\Taxonomy;


/**
 * Registers a custom post type.
 *
 * The `$args` parameter accepts all the standard arguments for `register_post_type()`.
 *
 * @param string   $post_type The post type name.
 * @param mixed[]  $args
 * @param string[] $names
 *
 * @return PostType
 */
function easy_post_type(
	string $post_type,
	array $args = [],
	array $names = [],
) : ? PostType {

	if( \post_type_exists( $post_type ) ) {
		return null;
	}

	$ept = new PostType(
		$post_type,
		$args,
		$names,
	);
	$ept->init();

	if( \is_admin() ) {
		$admin = new PostTypeAdmin( $ept, $ept->args );
		$admin->init();
	}
	
	return $ept;
}


/**
 * Registers a custom taxonomy.
 *
 * @param string          $taxonomy    The taxonomy name.
 * @param string|string[] $object_type Name(s) of the object type(s) for the taxonomy.
 * @param mixed[]         $args
 * @param string[]        $names
 *
 * @return Taxonomy
 */
function easy_taxonomy(
	string $taxonomy,
	string|array $object_type,
	array $args = [],
	array $names = [],
) : Taxonomy {

	$tax = new Taxonomy(
		$taxonomy,
		(array) $object_type,
		$args,
		$names,
	);
	$tax->init();

	return $tax;
}
