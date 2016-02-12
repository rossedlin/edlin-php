<?php
namespace Cryslo;
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 10/02/2016
 * Time: 18:01
 */
class Directory
{
    public static function make($path)
    {
        try
        {
            if (!file_exists($path)) mkdir($path, 0777, true);
            return true;
        }
        catch (\Exception $e)
        {

        }

        return false;
    }

    /**
     * Removes an entire directory
     *
     * @param $path
     * @return bool
     */
    public static function remove($path)
    {
        try
        {
            $iterator = new \DirectoryIterator($path);
            foreach ($iterator as $file)
            {
                if ($file->isDot()) continue;
                if ($file->isDir())
                {
                    if (self::remove($file->getPathname()))
                    {
                        @rmdir($file->getPathname());
                    }
                }
                elseif ($file->isFile())
                {
                    unlink($file->getPathname());
                }
            }

            rmdir($path);
        }
        catch (\Exception $e)
        {
            return false;
        }
        return true;
    }

    /**
     * Copy an entire directory
     *
     * @param $source
     * @param $destination
     * @return bool
     */
    public static function copy($source, $destination)
    {
        try
        {
            $iterator = new \DirectoryIterator($source);
            foreach ($iterator as $file)
            {
                if ($file->isDot()) continue;
                if ($file->isDir())
                {
                    //build file paths
                    $src = $file->getPathname();
                    $dest = str_replace($file->getPath(), '', $destination).$file->getPath().'/'.$file->getFilename();

                    self::make($destination);
                    self::copy($src, $dest);
                }
                elseif ($file->isFile())
                {
                    self::make($destination);

                    //build file paths
                    $src = $file->getPathname();
                    $dest = $destination.'/'.$file->getFilename();

                    copy($src, $dest);
                }
            }
        }
        catch (\Exception $e)
        {
            return false;
        }
        return true;
    }

    /**
     * Gets the contents of the entire directory
     *
     * @param $path
     * @return array
     */
    public static function getContents($path)
    {
        $contents = array
        (
            'files'         => [],
            'directories'   => [],
        );

        try
        {
            $iterator = new \DirectoryIterator($path);
            foreach ($iterator as $file)
            {
                if ($file->isDot()) continue;
                if ($file->isDir())
                {
                    //todo
                }
                elseif ($file->isFile())
                {
                    $contents['files'][] = $file->getFilename();
                }
            }
        }
        catch (\Exception $e)
        {

        }

        return $contents;
    }
}