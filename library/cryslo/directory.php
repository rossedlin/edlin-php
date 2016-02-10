<?php
namespace Cryslo;
/**
 * Created by PhpStorm.
 * User: rosse
 * Date: 10/02/2016
 * Time: 18:01
 */
class Directory
{
    /**
     * Removes an entire directory
     *
     * @param $path
     * @return bool
     */
    static public function remove($path)
    {
        try
        {
            $iterator = new \DirectoryIterator($path);
            foreach ($iterator as $fileinfo)
            {
                if ($fileinfo->isDot()) continue;
                if ($fileinfo->isDir())
                {
                    if (self::remove($fileinfo->getPathname()))
                        rmdir($fileinfo->getPathname());
                }
                if ($fileinfo->isFile())
                {
                    unlink($fileinfo->getPathname());
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
}