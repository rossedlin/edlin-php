<?php
/**
 * @author Ross Edlin <contact@rossedlin.com>
 * Date: 18/09/2021
 * Time: 20:14
 */

namespace Edlin;

use DirectoryIterator;

class Md5
{
    /**
     * @param $path
     *
     * @return string
     */
    public static function file($path): string
    {
        return md5($path);
    }

    /**
     * @param $path
     *
     * @return array
     */
    public static function directory($path): array
    {
        $contents = [
            'files'       => [],
            'directories' => [],
        ];

        $iterator = new DirectoryIterator($path);
        foreach ($iterator as $file) {

            /**
             * Skip any dotted paths
             */
            if ($file->isDot()) {
                continue;
            }

            /**
             * Recursive method
             */
            if ($file->isDir()) {
                $contents['directories'][$file->getFilename()] = self::directory($file->getRealPath());
            }

            if ($file->isFile()) {
                $contents['files'][$file->getFilename()] = md5(file_get_contents($file->getRealPath()));
            }
        }

        return $contents;
    }
}
