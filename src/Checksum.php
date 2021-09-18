<?php
/**
 * @author Ross Edlin <contact@rossedlin.com>
 * Date: 18/09/2021
 * Time: 20:14
 */

namespace Edlin;

use DirectoryIterator;

class Checksum
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
     * @param array  $args
     *
     * @return array
     */
    public static function directory(string $path, array $args = []): array
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
                $contents['directories'][$file->getFilename()] = self::directory($file->getRealPath(), $args);
            }

            if ($file->isFile()) {

                $contents['files'][$file->getFilename()] = [];

                /**
                 * MD5 of the filename.
                 */
                if (Arr::get($args, 'md5_filename')) {
                    $contents['files'][$file->getFilename()]['md5_filename'] = md5($file->getFilename());
                }

                /**
                 * MD5 of the file.
                 */
                if (Arr::get($args, 'md5_file')) {
                    $contents['files'][$file->getFilename()]['md5_file'] = md5_file($file->getRealPath());
                }

                /**
                 * Filesize.
                 */
                if (Arr::get($args, 'filesize')) {
                    $contents['files'][$file->getFilename()]['filesize'] = filesize($file->getRealPath());
                }
            }
        }

        return $contents;
    }
}
