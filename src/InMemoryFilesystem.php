<?php

namespace creocoder\flysystem;

use League\Flysystem\InMemory\InMemoryFilesystemAdapter;

class InMemoryFilesystem extends Filesystem
{
    protected function prepareAdapter()
    {
        return new InMemoryFilesystemAdapter();
    }
}
