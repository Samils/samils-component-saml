<?php
/**
 * @version 2.0
 * @author Sammy
 *
 * @keywords Samils, ils, php framework
 * -----------------
 * @package Sammy\Packs\Samils\Component\Saml\FileSystem
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
namespace Sammy\Packs\Samils\Component\Saml\FileSystem {
  use FileSystem\Folder as Directory;
  /**
   * Make sure the module base internal class is not
   * declared in the php global scope defore creating
   * it.
   * It ensures that the script flux is not interrupted
   * when trying to run the current command by the cli
   * API.
   */
  if (!trait_exists('Sammy\Packs\Samils\Component\Saml\FileSystem\Base')){
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
    use FileSource;

    public static function FileExists ($file = null) {
      return file_exists ($file) && is_file ($file);
    }

    public static function DirectoryExists ($directory = null) {
      return file_exists ($directory) && is_dir ($directory);
    }

    public static function FileContent ($file = null) {
      if (self::FileExists ($file)) {
        $fs = requires ('fs');

        return $fs->readFile ($file);
      }
    }

    public static function FileName ($file = null) {
      return pathinfo ($file, PATHINFO_FILENAME);
    }

    public static function FileExtension ($file = null) {
      return pathinfo ($file, PATHINFO_EXTENSION);
    }

    public static function mkDir () {
      return forward_static_call_array (
        [Directory::class, 'Create'], func_get_args ()
      );
    }
  }}
}
