<?php

namespace Bundle\DoctrinePaginatorBundle\Templating;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Zend\Paginator\Paginator;

class PaginatorExtension extends \Twig_Extension
{
    /**
     * Container
     * 
     * @var ContainerInterface
     */
    private $container;

    /**
     * Initialize pagination helper
     * 
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

	/**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            'paginator_sort'   => new \Twig_Function_Method($this, 'sort'),
            'paginator_render'  => new \Twig_Function_Method($this, 'render')
        );
    }

	/**
     * Create a sort url for the field named $title
     * and identified by $key which consists of
     * alias and field. $options holds all link 
     * parameters like "alt, class" and so on.
     * 
     * $key example: "article.title"
     * 
     * @param string $title
     * @param string $key
     * @param array $options
     * @return string
     */
    public function sort($title, $key, $options = array())
    {
        return $this->container->get('templating.helper.doctrine_paginator')->sort($title, $key, $options);
    }
    
    /**
     * Renders a pagination control, for a $paginator given.
     * Optionaly $template and $style can be specified to
     * override default from configuration.
     * 
     * @param Zend\Paginator\Paginator $paginator
     * @param string $template
     * @param string $style
     * @return string
     */
    public function render(Paginator $paginator, $template = null, $style = null)
    {
        return $this->container->get('templating.helper.doctrine_paginator')->render($paginator, $template, $style);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'paginator';
    }
}