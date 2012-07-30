<?php

/*
 * This file is part of Twig.
 *
 * (c) 2009 Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Twig_Project_TokenCodeParser extends Twig_TokenParser
{
    /**
     * Parses a token and returns a node.
     *
     * @param Twig_Token $token A Twig_Token instance
     *
     * @return Twig_NodeInterface A Twig_NodeInterface instance
     */
 public function parse(Twig_Token $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();
        if($stream->test(Twig_Token::NAME_TYPE)){
        	$object = $stream->look(0)->getValue();
        	/**
        	 * добавляем tpl_ подпись к функции
        	 */
        	$stream->look(2)->setTplValue();
        }else {
        	throw new Twig_Error_Syntax("When using get, you must have the same number of variables and assignements.", $lineno);
        }
        $expr = ( $this->parser->getExpressionParser()->parseExpression());
		
        $stream->expect(Twig_Token::BLOCK_END_TYPE);

		
		return new Twig_Project_SetNode(new Twig_Node(array($expr)),$object, $lineno, $this->getTag());
    }
	

    public function decideBlockEnd($token)
    {
        return $token->test('endget');
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @param string The tag name
     */
    public function getTag()
    {
        return 'get';
    }
}
	