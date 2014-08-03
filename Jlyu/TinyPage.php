<?php
namespace Jlyu;

class TinyPage
{
    private $basePath = '.';
    private $ETag = null;

    public function __construct($config=array())
    {
        if (isset($config['base_path'])) {
            $this->basePath = $config['base_path'];
            set_include_path(get_include_path() . ':' . $this->basePath);
        }
    }

    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    public function render($path, $variables)
    {
        ob_start();
        extract($variables);
        require sprintf("%s/%s", $this->basePath, $path);
        $output = ob_get_clean();
        $this->ETag = md5($output);

        return $output;
    }

    public function getETag()
    {
        return $this->ETag;
    }
}
