<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Google_Client;
use Google_Service_Drive;

class GDriveService
{
    public static function uploadFile($filePath, $fileName, $pathHierarchy = [], $baseParentId = null)
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/credentials.json'));
        $client->addScope(Drive::DRIVE);

        $service = new Drive($client);

        $parentId = $baseParentId;
        foreach ($pathHierarchy as $folderName) {
            $parentId = self::getOrCreateFolder($service, $folderName, $parentId);
        }

        $fileMetadata = new DriveFile();
        $fileMetadata->setName($fileName);
        if ($parentId) {
            $fileMetadata->setParents([$parentId]);
        }

        $file = $service->files->create($fileMetadata, [
            'data' => file_get_contents($filePath),
            'mimeType' => mime_content_type($filePath),
            'uploadType' => 'multipart',
            'fields' => 'id',
        ]);

        $permission = new \Google\Service\Drive\Permission([
            'type' => 'anyone',
            'role' => 'reader',
        ]);
        $service->permissions->create($file->getId(), $permission, ['fields' => 'id']);

        return $file->getId();
    }

    public static function deleteFile($fileId)
    {
        try {
            $client = new Client();
            $client->setAuthConfig(storage_path('app/credentials.json'));
            $client->addScope(Drive::DRIVE);

            $service = new Drive($client);
            $service->files->delete($fileId);
        } catch (\Exception $e) {
            logger()->error("Gagal hapus file dari Google Drive: " . $e->getMessage());
        }
    }

    public static function getOrCreateFolder($service, $folderName, $parentId = null)
    {
        $escapedName = addslashes($folderName);
        $query = "mimeType='application/vnd.google-apps.folder' and name='{$escapedName}'";
        if ($parentId) {
            $query .= " and '{$parentId}' in parents";
        }

        $results = $service->files->listFiles([
            'q' => $query,
            'spaces' => 'drive',
            'fields' => 'files(id, name)',
        ]);

        if (count($results->files) > 0) {
            return $results->files[0]->id;
        }

        $fileMetadata = new DriveFile([
            'name' => $folderName,
            'mimeType' => 'application/vnd.google-apps.folder',
        ]);

        if ($parentId) {
            $fileMetadata->setParents([$parentId]);
        }

        $folder = $service->files->create($fileMetadata, [
            'fields' => 'id',
        ]);

        return $folder->getId();
    }
}
