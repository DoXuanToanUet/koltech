<?php
namespace WPIDE\App\Helpers;

use WPIDE\App\AppConfig;
use WPIDE\App\Services\Storage\LocalFileSystem;
use WPIDE\App\Utils\Exception;
use const WPIDE\Constants\BACKUPS_DIR;
use const WPIDE\Constants\BACKUPS_TODAY_DIR;
use const WPIDE\Constants\CONTENT_DIR;

class FileBackup
{

    public static function init() {

        EmptyDir::create(BACKUPS_DIR);
        EmptyDir::create(BACKUPS_TODAY_DIR);

        self::cleanDirs();
    }

    /**
     * @throws \Exception
     */
    public static function backup($item, $newContent): bool
    {
        $dir = $item->dir;
        $path = $item->path;
        $name = $item->name;

        $storage = LocalFileSystem::load();
        $oldStream = $storage->readStream($path);

        if ($oldStream['stream']) {

            $backupStorage = LocalFileSystem::load(BACKUPS_TODAY_DIR);

            $originalFileDir = wp_normalize_path(CONTENT_DIR . AppConfig::get('file.root') . ltrim($dir, '/'));
            $originalFileDir = str_replace(wp_normalize_path(ABSPATH), "", $originalFileDir);
            $backupFilePath = BACKUPS_TODAY_DIR . "/" .$originalFileDir;
            $ext = '.'.pathinfo($name, PATHINFO_EXTENSION);

            if (!is_dir($backupFilePath)) {
                wp_mkdir_p($backupFilePath);
            }

            if(!$backupStorage->storeStream($originalFileDir, $name, $oldStream['stream'], true)) {
                return false;
            }
            if(!$backupStorage->storeStreamFromContent($originalFileDir, str_replace($ext, "_modified_" . $ext, $name), $newContent, true)) {
                return false;
            }

            return true;
        }

        return false;
    }

    public static function exists($file): bool
    {

        $backup_file = WPIDE_Error_Handler::findBackupFile($file);
        return !empty($backup_file);
    }

    public static function restore($file) {

        $backup_file = WPIDE_Error_Handler::findBackupFile($file);
        return WPIDE_Error_Handler::recoverFile($file, $backup_file);
    }

    protected static function cleanDirs() {

        $backup = LocalFileSystem::load(BACKUPS_DIR);

        try {
            $collection = $backup->getDirectoryCollection('/');

            $backups_max_days = AppConfig::get('file.backups_max_days', 5);

            $today = date_create_from_format('Y-m-d', date('Y-m-d'));

            $oldBackupFolders = $collection->filter(function($item) use($today, $backups_max_days) {

                if($item['type'] === 'dir') {
                    $folderDate = date_create_from_format('Y-m-d', $item['name']);

                    if(!empty($folderDate)) {
                        $days = intval(date_diff($folderDate, $today)->format('%a'));
                        return $days >= $backups_max_days;
                    }

                    return true;
                }

                return false;

            })->map(function($item) {

                return $item['path'];

            })->all();

            foreach($oldBackupFolders as $folder) {

                $backup->deleteDir($folder);
            }

        } catch (\Exception $e) {}

    }

}
