<?php
class Twig_Project_SetNode extends Twig_Node
{
  public function __construct(Twig_NodeInterface $tests,$obj, $lineno, $tag = null)
  {
    parent::__construct(array('names' => $tests), array('name' => $obj), $lineno, $tag);   
  }

    /**
     * Compiles the node to PHP.
     *
     * @param Twig_Compiler A Twig_Compiler instance
     */
    public function compile(Twig_Compiler $compiler)
    {
    	if ('_self' === $this->getAttribute('name')) {
            //$compiler->raw('$this');
        } elseif ('_context' === $this->getAttribute('name')) {
           // $compiler->raw('$context');
        } elseif ('_charset' === $this->getAttribute('name')) {
           // $compiler->raw('$this->env->getCharset()');
        } else {
            $compiler
            	->write(sprintf('$context[\'%s\'] = (isset($context[\'%s\']) ? $context[\'%s\'] : new %s())', $this->getAttribute('name'), $this->getAttribute('name'), $this->getAttribute('name'), $this->getAttribute('name')))
            		->raw(";\n");
        }
    	
    	$compiler ->write('echo ')
                ->subcompile($this->getNode('names')->getNode(0))
                ->raw("\n");
                
        $compiler->raw(";\n");
    }
}
	