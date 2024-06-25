<?php
namespace ThanhVo\VersionCheck\Block\Adminhtml;

class Version extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Framework\App\Filesystem\DirectoryList
     */
    protected $directoryList;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $request;

    /**
     * @var \Magento\Framework\HTTP\PhpEnvironment\ServerAddress
     */
    protected $serverAddress;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\App\Filesystem\DirectoryList $directoryList
     * @param \Magento\Framework\App\Request\Http $request
     * @param \Magento\Framework\HTTP\PhpEnvironment\ServerAddress $serverAddress
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Filesystem\DirectoryList $directoryList,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\HTTP\PhpEnvironment\ServerAddress $serverAddress,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->directoryList = $directoryList;
        $this->request = $request;
        $this->serverAddress = $serverAddress;
    }

    /**
     * @return bool
     */
    public function shouldDisplay()
    {
        return $this->request->getParam('versioncheck') === '1';
    }

    /**
     * @return false|string
     */
    public function getVersion()
    {
        $versionFilePath = $this->directoryList->getRoot() . '/version.txt';
        if (file_exists($versionFilePath)) {
            return file_get_contents($versionFilePath);
        } else {
            return 'Version file not found';
        }
    }

    /**
     * @return false|string
     */
    public function getServerIp()
    {
        return $this->serverAddress->getServerAddress();
    }
}
