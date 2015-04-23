<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 23/04/15
 * Time: 16:08
 */

namespace store\BackendBundle\Doctrine\Extensions;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
/**
 * Class qui ajoute la fonction YEAR() en DQL
 * @package store\BackendBundle\Doctrine\Extensions
 */
class Year extends FunctionNode
{
    /**
     * @var
     */
    protected $dateExpression;

    /**
     * Parse le DQL en SQL en utilisant le SqlWalker
     * @param \Doctrine\ORM\Query\SqlWalker $sqlWalker
     *
     * @return string
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        //Je retourne la fonctioin en SQL YEAR() qui va prendre en argument ce que j'ai saisi en expression
        return 'YEAR('.
        $sqlWalker->walkArithmeticExpression($this->dateExpression).
        ')';
    }

    /**
     * Parse va utiliser le Parser de Doctrine pour parser ma fonction MONTH en DQL
     * @param \Doctrine\ORM\Query\Parser $parser
     *
     * @return void
     */
    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        //Identifie le fonction que l'on va utiliser: MONTH
        $parser->match(Lexer::T_IDENTIFIER);

        //Identifie la parenthèse ouvrante:(
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        //Identifie l'expression que l'on va donner dans la fontion MONTH()
        $this->dateExpression = $parser->ArithmeticExpression();

        //Identifie la parenthèse fermante
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);

    }

} 