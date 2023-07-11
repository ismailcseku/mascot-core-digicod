<?php
namespace MASCOTCOREDIGICOD\Lib;

/**
 * interface Mascot_Core_Digicod_Interface_PostType
 * @package MASCOTCOREDIGICOD\Lib;
 */
interface Mascot_Core_Digicod_Interface_PostType {
	/**
	 * Returns PT Key
	 * @return string
	 */
	public function getPTKey();

	/**
	 * It registers custom post type
	 */
	public function register();
}