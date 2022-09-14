<?php
/**
 * @version 2.0
 * @author Sammy
 *
 * @keywords Samils, ils, php framework
 * -----------------
 * @package Sammy\Packs\Samils\Component\Saml\Paths
 * - Autoload, application dependencies
 *
 * MIT License
 *
 * Copyright (c) 2020 Ysare
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
namespace Sammy\Packs\Samils\Component\Saml\Paths {
  use php\module as phpmodule;
  /**
   * Make sure the module base internal class is not
   * declared in the php global scope defore creating
   * it.
   * It ensures that the script flux is not interrupted
   * when trying to run the current command by the cli
   * API.
   */
  if (!trait_exists('Sammy\Packs\Samils\Component\Saml\Paths\Base')){
  /**
   * @trait Base
   * Base internal trait for the
   * Samils\Component\Saml module.
   * -
   * This is (in the ils environment)
   * an instance of the php module,
   * wich should contain the module
   * core functionalities that should
   * be extended.
   * -
   * For extending the module, just create
   * an 'exts' directory in the module directory
   * and boot it by using the ils directory boot.
   * -
   */
  trait Base {
    /**
     * [Path description]
     * @param string $path [description]
     */
    public static final function Path ($path = '') {
      if (phpmodule::definedPath ($path)) {
        return phpmodule::path ($path);
      }
    }

    /**
     * [DefinePath description]
     * @param [type] $path   [description]
     * @param string $source [description]
     */
    public static final function DefinePath ($path, $source = '') {
      if (is_string ($path) && $path) {
        /**
         * Define the current path in php module
         * else.
         */
        return phpmodule::definePath ($path, $source);
      }
    }

    /**
     * [PathExists description]
     * @param string $path [description]
     */
    public static final function PathExists ($path = '') {
      return phpmodule::definedPath ($path);
    }

    /**
     * [ReadPath description]
     * @param string $path [description]
     */
    public static function ReadPath ($path = '', $backTrace = null) {
      $backTrace = is_array ($backTrace) ? $backTrace : (
        debug_backtrace ()
      );

      return phpmodule::readPath ($path, [], $backTrace);
    }

    /**
     * [ReadPathTarget description]
     * @param string $target
     * @param string $path
     */
    private static final function ReadPathTarget ($target, $path = null) {
      /**
       * Make sure '$target' is a meta data
       */
      if (preg_match ('/^:+/', $target)) {
        /**
         * Re
         */
        if (preg_match ('/^:*(.+)_dir$/i', $target, $match)) {
          $dirName = strtolower ($match[1]);

          if (defined ('__' . $dirName . '__')) {
            return constant ('__' . $dirName . '__');
          } elseif (preg_match ('/^module_(.+)?$/i', $dirName, $mt)) {
            /**
             * Read Module Root Directory
             */
            return phpmodule::getModuleRootDir (
              $path, $mt [ 1 ]
            );
          }
        }
      }

      return $target;
    }
  }}
}
