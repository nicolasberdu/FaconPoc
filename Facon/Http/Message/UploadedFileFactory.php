<?php

namespace Facon\Http\Message;

use Facon\Http\Message\UploadedFileInterface;

class UploadedFileFactory implements UploadedFileFactoryInterface {
    public function createUploadedFile(
        string $stream,
        int $size = null,
        int $error = \UPLOAD_ERR_OK,
        string $clientFilename = null,
        string $clientMediaType = null
    ): UploadedFileInterface {
        return new UploadedFile($stream, $size, $error, $clientFilename, $clientMediaType);
    }
}
