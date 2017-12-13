<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core;

/**
 * Description of Views
 *
 * @author caltj
 */
class Views extends Helper\ViewsHelper {

    /**
     * @var \Slim\Container
     */
    protected $c;
    /**
     *
     * @var type bool
     */
    public $layout = true;

    /**
     * The default layout template.
     */
    protected $DefaultLayout = 'layout';

    /**
     * @var string
     */
    protected $templatePath;
    protected $templatePathCuston;

    /**
     * @var array
     */
    protected $attributes;
    private $dataObj = [];
    private $template;

    /**
     * SlimRenderer constructor.
     *
     * @param string $templatePath
     * @param array $attributes
     */
    public function __construct(\Slim\Container $c, $templatePath = "", $attributes = []) {
        $this->templatePath = rtrim($templatePath, '/\\') . '/';
        $this->templatePathCuston = rtrim($templatePath, '/\\') . '/';
        $this->attributes = $attributes;
        if ($this->attributes):
            foreach ($this->attributes as $key => $value) {
                $this->{$key} = $value;
            }
        endif;
        $this->Authenticate = $this->auth->empresa();
        $this->c = $c;
    }

    public function partials($templates, $data = []) {
        $template = sprintf("%sTemplates/layout/partials/%s.phtml", $this->templatePath, $templates);
        if (!is_file(sprintf($template))) {
            throw new \RuntimeException("View cannot render `$template` because the template does not exist");
        }
        $this->protectedIncludeScope($template, array_merge($this->dataObj, $data, $this->auth->empresa()));
    }

	public function custom($data = []) {
    	$template = sprintf("%s.phtml", $this->templatePathCuston);
		if (!is_file(sprintf($template))) {
			throw new \RuntimeException("View cannot render cunton `$template` because the template does not exist");
		}
		$this->protectedIncludeScope($template, array_merge($this->dataObj, $data, $this->auth->empresa()));
	}

    public function __get($name) {
        return $this->{$name};
    }

    public function getUrl($url = "") {
        return sprintf("%s/%s", $this->c->request->getUri()->getBaseUrl(), $url);
    }

    public function setLayout($Layout) {
        $this->DefaultLayout = $Layout;
    }

    /**
     * @return \Slim\Container
     */
    public function getC()
    {
        return $this->c;
    }

    /**
     * Render a template
     *
     * $data cannot contain template as a key
     *
     * throws RuntimeException if $templatePath . $template does not exist
     *
     * @param ResponseInterface $response
     * @param string             $template
     * @param array              $data
     *
     * @return ResponseInterface
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function render(\Psr\Http\Message\ResponseInterface $response, $template, array $data = []) {
        $output = $this->fetch($template, $data);

        $response->getBody()->write($output);

        return $response;
    }

    /**
     * Get the attributes for the renderer
     *
     * @return array
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**
     * Set the attributes for the renderer
     *
     * @param array $attributes
     */
    public function setAttributes(array $attributes) {
        $this->attributes = $attributes;
    }

    /**
     * Add an attribute
     *
     * @param $key
     * @param $value
     */
    public function addAttribute($key, $value) {
        $this->attributes[$key] = $value;
    }

    /**
     * Retrieve an attribute
     *
     * @param $key
     * @return mixed
     */
    public function getAttribute($key) {
        if (!isset($this->attributes[$key])) {
            return false;
        }

        return $this->attributes[$key];
    }

    /**
     * Get the template path
     *
     * @return string
     */
    public function getTemplatePath() {
        return $this->templatePath;
    }

    /**
     * Get the template path
     *
     * @return string
     */
    public function getTemplatePathCuston() {
        return $this->templatePathCuston;
    }

    /**
     * Set the template path
     *
     * @param string $templatePath
     */
    public function setTemplatePath($templatePath) {
        $this->templatePath = sprintf("%s%s", $this->getTemplatePath(),rtrim($templatePath, '/\\'));
    }

	/**
	 * Set the template path
	 *
	 * @param string $templatePath
	 */
	public function setTemplatePathCuston($templatePath) {
		$this->templatePathCuston = sprintf("%s%s", $this->getTemplatePath(),rtrim($templatePath, '/\\'));
	}

    public function setTerminal($terminal=true){
        $this->layout = $terminal;
        return $this;
    }
    /**
     * Renders a template and returns the result as a string
     *
     * cannot contain template as a key
     *
     * throws RuntimeException if $templatePath . $template does not exist
     *
     * @param $template
     * @param array $data
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function fetch($template, array $data = []) {
        if (!is_file(sprintf("%s/%s.phtml", $this->templatePath, $template))) {
            throw new \RuntimeException("View `$template` não pode ser acessada ela não existe");
        }
        $this->dataObj = array_merge($data, $this->Authenticate);
        $this->dataObj['user'] = $this->auth->user();

        if ($this->layout == true && file_exists(sprintf("%sTemplates/layout/%s.phtml", $this->templatePath, $this->DefaultLayout))) {
            $this->template = sprintf("%s%s.phtml", $this->templatePath, $template);
            include sprintf("%sTemplates/layout/%s.phtml", $this->templatePath, $this->DefaultLayout);
        } else {
            $this->protectedIncludeScope(sprintf("%s%s.phtml", $this->templatePath, $template), $this->dataObj);
        }
    }

    /**
     * @param string $template
     * @param array $data
     */
    protected function protectedIncludeScope($template, array $data) {
        extract($data);
        include $template;
    }

    public function content() {
        extract($this->dataObj);
        include_once $this->template;
    }

}
