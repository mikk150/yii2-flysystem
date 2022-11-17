<?php

namespace tests\unit;

use Codeception\Stub\Expected;
use Codeception\Test\Unit;
use creocoder\flysystem\Filesystem;
use League\Flysystem\Config;
use League\Flysystem\FilesystemAdapter;

class FilesystemTest extends Unit
{
    public function testMagicCallIsForwarded()
    {
        /**
         * @var Filesystem
         */
        $filesystem = $this->construct(Filesystem::class, [], [
            'prepareAdapter' => function () {
                return $this->makeEmpty(FilesystemAdapter::class, [
                    'copy' => Expected::once(function ($source, $destination) {
                        $this->assertEquals('source', $source);
                        $this->assertEquals('destination', $destination);
                    })
                ]);
            }
        ]);

        $filesystem->copy('source', 'destination');
    }
}
