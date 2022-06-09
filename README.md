# Easy CPT

## Installation

## Activation

## Usage

## Examples

### Easy Example

```
function easy_cpt() {
	easy_post_type( 'book' );
	easy_taxonomy( 'genre', 'book' );
}
add_action( 'init', 'easy_cpt' );
```

### Complex Example

```
add_action( 'init', function() {
	easy_post_type(
		post_type: 'book',
		args: [
			'menu_position' => 2,
		],
		names: [
			'singular' => 'Book',
			'plural'   => 'Books',
		],
	);

	easy_taxonomy(
		taxonomy: 'genre',
		object_type: [
			'book'
		],
		args: [
			'description' => 'A category of artistic composition'
		],
		names: [
			'plural' => 'Genres',
		],
	);
});
```
