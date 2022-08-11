<?php
/**
 * @link https://github.com/creocoder/yii2-flysystem
 * @copyright Copyright (c) 2015 Alexander Kochetov
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace creocoder\flysystem;

use League\Flysystem\DirectoryListing;
use League\Flysystem\Filesystem as NativeFilesystem;
use League\Flysystem\FilesystemAdapter;
use League\Flysystem\FilesystemReader;
use yii\base\Component;

/**
 * Filesystem
 *
 * @method bool fileExists(string $location)
 * @method string read(string $location)
 * @method resource readStream(string $location)
 * @method DirectoryListing listContents(string $location, bool $deep = FilesystemReader::LIST_SHALLOW)
 * @method int lastModified(string $path)
 * @method int fileSize(string $path)
 * @method string mimeType(string $path)
 * @method string visibility(string $path)
 * @method void write(string $location, string $contents, array $config = [])
 * @method void writeStream(string $location, $contents, array $config = [])
 * @method void setVisibility(string $path, string $visibility)
 * @method void delete(string $location)
 * @method void deleteDirectory(string $location)
 * @method void createDirectory(string $location, array $config = [])
 * @method void move(string $source, string $destination, array $config = [])
 * @method void copy(string $source, string $destination, array $config = [])
 *
 * @author Alexander Kochetov <creocoder@gmail.com>
 */
abstract class Filesystem extends Component
{
    /**
     * @var \League\Flysystem\Config|array|string|null
     */
    public $config;

    /**
     * @var \League\Flysystem\FilesystemInterface
     */
    protected $filesystem;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $adapter = $this->prepareAdapter();

        $this->filesystem = new NativeFilesystem($adapter, $this->config);
    }

    /**
     * @return FilesystemAdapter
     */
    abstract protected function prepareAdapter();

    /**
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->filesystem, $method], $parameters);
    }

    /**
     * @return \League\Flysystem\FilesystemOperator
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }
}
