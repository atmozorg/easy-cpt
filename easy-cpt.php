<?php
/**
 * Plugin Name:       Easy CPT
 * Plugin URI:        https://blennd.com/plugins/easy-cpt/
 * Description:       Plugin to easily register WordPress Custom Post Types and taxonomies.
 * Version:           0.1.0
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Author:            Blennd
 * Author URI:        https://blennd.com/
 * License:           GPL v3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       easy-cpt
 * Domain Path:       /languages
 *
 * @package   EasyCPT
 * @author    Blennd <https://blennd.com>
 * @link      https://blennd.com/plugins/easy-cpts
 * @copyright 2022 Blennd
 * @license   GPL v3 or later
 * @version   0.1.0
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

declare( strict_types = 1 );

namespace blenndiris\easy_cpt;

define( 'EASY_CPT', __DIR__ );

require EASY_CPT . '/functions.php';
require EASY_CPT . '/src/postType.php';
require EASY_CPT . '/src/postTypeAdmin.php';
require EASY_CPT . '/src/taxonomy.php';
