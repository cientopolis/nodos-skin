<?php
/**
 * Nodos - Modern version of MonoBook with fresh look and many usability
 * improvements.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @ingroup Skins
 */

/**
 * SkinTemplate class for Nodos skin
 * @ingroup Skins
 */
class SkinNodos extends SkinTemplate {
	public $skinname = 'nodos';
	public $stylename = 'Nodos';
	public $template = 'NodosTemplate';
	/**
	 * @var Config
	 */
	private $nodosConfig;

	public function __construct() {
		$this->nodosConfig = ConfigFactory::getDefaultInstance()->makeConfig( 'nodos' );
	}

	/**
	 * Initializes output page and sets up skin-specific parameters
	 * @param OutputPage $out Object to initialize
	 */
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );

		if ( $this->nodosConfig->get( 'NodosResponsive' ) ) {
			$out->addMeta( 'viewport', 'width=device-width, initial-scale=1' );
			$out->addModuleStyles( 'skins.nodos.styles.responsive' );
		}

		$out->addModules( 'skins.nodos.js' );
	}

	/**
	 * Loads skin and user CSS files.
	 * @param OutputPage $out
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );

		$styles = [ 'mediawiki.skinning.interface', 'skins.nodos.styles' ];
		Hooks::run( 'SkinNodosStyleModules', [ $this, &$styles ] );
		$out->addModuleStyles( $styles );
	}

	function makeFooterIcon( $icon, $withImage = 'withImage' ) {
		if ( is_string( $icon ) ) {
			$html = $icon;
		} else { // Assuming array
			$url = isset( $icon["url"] ) ? $icon["url"] : null;
			unset( $icon["url"] );
			if ( isset( $icon["src"] ) && $withImage === 'withImage' ) {
				// do this the lazy way, just pass icon data as an attribute array
				$html = Html::element( 'img', $icon );
			} else {
				$html = htmlspecialchars( $icon["alt"] );
			}
			if ( $url ) {
				$html = Html::rawElement( 'a', array( "href" => $url, "target" => "_blank" ), $html );
			}
		}
		return $html;
	}

	/**
	 * Override to pass our Config instance to it
	 */
	public function setupTemplate( $classname, $repository = false, $cache_dir = false ) {
		return new $classname( $this->nodosConfig );
	}
}
