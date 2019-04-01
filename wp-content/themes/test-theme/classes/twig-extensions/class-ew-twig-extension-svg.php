<?php

namespace Ew;

use Twig_Extension;
use Twig_SimpleFunction;
use Exception;

/**
 * Class Ew_Twig_Extension_Svg
 * @package Ew
 */
class Ew_Twig_Extension_Svg extends Twig_Extension {

	/**
	 * Get functions.
	 *
	 * @return array|Twig_SimpleFunction[]
	 */
	public function getFunctions() {
		return [
			new Twig_SimpleFunction( 'load_svg', [ $this, 'load_svg' ] ),
		];
	}

	/**
	 * Get svg.
	 *
	 * @param $icon_name
	 *
	 * @throws Exception
	 */
	public function load_svg( $icon_name ) {

		// Get svg file path
		$default_svg_path = THEME_DIR . '/assets/images/icons/';
		$svg_path         = apply_filters( 'ew_svg_path', $default_svg_path );

		// Check if icon has svg extension
		$icon_name_parts = explode( '.', $icon_name );
		$icon_extension  = end( $icon_name_parts );

		$hasExtension = strtolower( $icon_extension ) === 'svg';

		// Add svg extension to icon if it is not already there, construct full icon pat
		$icon_path = $svg_path . $icon_name . ( $hasExtension ? '' : '.svg' );

		// If file not exists
		if ( ! file_exists( $icon_path ) ) {
			throw new Exception( "SVG icon does not exist for path: $icon_path!" );
		}

		/** @noinspection PhpIncludeInspection */
		include $icon_path;
	}

}