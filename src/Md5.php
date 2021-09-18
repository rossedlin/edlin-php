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
     * @param string $path
     * @param string $method
     *
     * @return array
     */
    public static function directory(string $path, string $method = 'php'): array
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
                if ($method === 'php') {
                    $contents['files'][$file->getFilename()] = md5(file_get_contents($file->getRealPath()));
                } elseif ($method === 'system_md5') {
                    $contents['files'][$file->getFilename()] = substr(system("md5 " . $file->getRealPath()), 0, 32);
                } elseif ($method === 'system_md5sum') {
                    $contents['files'][$file->getFilename()] = substr(system("md5sum " . $file->getRealPath()), 0, 32);
                }
            }
        }

        return $contents;
    }
}
