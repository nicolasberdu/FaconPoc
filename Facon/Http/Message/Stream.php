<?php

namespace Facon\Http\Message;

use Facon\Http\Message\StreamInterface;

class Stream implements StreamInterface {
    private $stream;

    public function __construct($stream) {
        if (!is_resource($stream)) {
            throw new \InvalidArgumentException('Invalid stream resource');
        }
        $this->stream = $stream;
    }

    public function __toString() {
        return $this->getContents();
    }

    public function close() {
        if (is_resource($this->stream)) {
            fclose($this->stream);
        }
    }

    public function detach() {
        $result = $this->stream;
        $this->stream = null;
        return $result;
    }

    public function getSize() {
        if (is_resource($this->stream)) {
            $stats = fstat($this->stream);
            if (isset($stats['size'])) {
                return $stats['size'];
            }
        }
        return null;
    }

    public function tell() {
        if (is_resource($this->stream)) {
            $position = ftell($this->stream);
            if ($position !== false) {
                return $position;
            }
        }
        throw new \RuntimeException('Unable to get stream position');
    }

    public function eof() {
        return is_resource($this->stream) ? feof($this->stream) : true;
    }

    public function isSeekable() {
        return is_resource($this->stream) && stream_get_meta_data($this->stream)['seekable'];
    }

    public function seek($offset, $whence = SEEK_SET) {
        if (!$this->isSeekable()) {
            throw new \RuntimeException('Stream is not seekable');
        }

        if (fseek($this->stream, $offset, $whence) !== 0) {
            throw new \RuntimeException('Unable to seek to stream position');
        }
    }

    public function rewind() {
        $this->seek(0);
    }

    public function isWritable() {
        $mode = stream_get_meta_data($this->stream)['mode'];
        return is_resource($this->stream) && (strpbrk($mode, 'wa+x') !== false);
    }

    public function write($string) {
        if (!$this->isWritable()) {
            throw new \RuntimeException('Stream is not writable');
        }
        $result = fwrite($this->stream, $string);
        if ($result === false) {
            throw new \RuntimeException('Unable to write to stream');
        }
        return $result;
    }

    public function isReadable() {
        $mode = stream_get_meta_data($this->stream)['mode'];
        return is_resource($this->stream) && (strpbrk($mode, 'r+') !== false);
    }

    public function read($length) {
        if (!$this->isReadable()) {
            throw new \RuntimeException('Stream is not readable');
        }
        $data = fread($this->stream, $length);
        if ($data === false) {
            throw new \RuntimeException('Unable to read from stream');
        }
        return $data;
    }

    public function getContents() {
        if (!$this->isReadable()) {
            throw new \RuntimeException('Stream is not readable');
        }
        $contents = stream_get_contents($this->stream);
        if ($contents === false) {
            throw new \RuntimeException('Unable to get stream contents');
        }
        return $contents;
    }

    public function getMetadata($key = null) {
        $metadata = stream_get_meta_data($this->stream);
        if ($key === null) {
            return $metadata;
        }
        return $metadata[$key] ?? null;
    }
}