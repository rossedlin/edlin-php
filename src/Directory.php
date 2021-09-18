<?php

namespace Edlin;

use DirectoryIterator;
use Edlin\Exceptions\EdlinException;
use Exception;

class Directory
{
    /**
     * @param $path
     *
     * @return bool
     */
    public static function exists($path): bool
    {
        if (file_exists($path)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $path
     * @param int    $permissions
     *
     * @return bool
     */
    public static function make(string $path, int $permissions = 0777): bool
    {
        if (!file_exists($path)) {
            mkdir($path, $permissions, true);
        }

        return true;
    }

    /**
     * Removes an entire directory
     *
     * @param $path
     *
     * @throws EdlinException
     */
    public static function remove($path)
    {
        throw new EdlinException('Directory::remote() not finished.');

        try {
            $iterator = new DirectoryIterator($path);
            foreach ($iterator as $file) {
                if ($file->isDot()) {
                    continue;
                }
                if ($file->isDir()) {
                    if (self::remove($file->getPathname())) {
                        @rmdir($file->getPathname());
                    }
                } elseif ($file->isFile()) {
                    unlink($file->getPathname());
                }
            }

            rmdir($path);
        } catch (Exception $e) {
            Log::write($e);
            throw $e;
        }
    }

    /**
     * Copy an entire directory
     *
     * @param $source
     * @param $destination
     *
     * @return void
     * @throws Exception
     */
    public static function copy($source, $destination)
    {
        throw new EdlinException('Directory::copy() not finished.');

        try {
            $iterator = new DirectoryIterator($source);
            foreach ($iterator as $file) {
                if ($file->isDot()) {
                    continue;
                }
                if ($file->isDir()) {
                    //build file paths
                    $src  = $file->getPathname();
                    $dest = str_replace($file->getPath(), '',
                            $destination) . $file->getPath() . '/' . $file->getFilename();

                    self::make($destination);
                    self::copy($src, $dest);
                } elseif ($file->isFile()) {
                    self::make($destination);

                    //build file paths
                    $src  = $file->getPathname();
                    $dest = $destination . '/' . $file->getFilename();

                    copy($src, $dest);
                }
            }
        } catch (Exception $e) {
            Log::write($e);
            throw $e;
        }
    }

    /**
     * Gets the contents of the entire directory
     *
     * @param $path
     *
     * @return array
     */
    public static function getContents($path): array
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
                $contents['directories'][$file->getFilename()] = self::getContents($file->getRealPath());
            }

            if ($file->isFile()) {
                $contents['files'][] = $file->getFilename();
            }
        }

        return $contents;
    }
}
