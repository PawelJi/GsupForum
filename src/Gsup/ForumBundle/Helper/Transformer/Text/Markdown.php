<?php
 /**
 * Description
 *
 * @package 
 * @subpackage 
 * @author: Pawel J.
 * @version $Id$
 */
 
namespace Gsup\ForumBundle\Helper\Transformer\Text;

use Michelf\MarkdownExtra as MarkdownMakerExtra;
use League\HTMLToMarkdown\HtmlConverter;

/**
 * Class uses different libraries to create markdown from html
 * and change html to markdown.
 *
 *
 * Class Markdown
 * @package Gsup\ForumBundle\Helper
 */
class Markdown
{
    /**
     * Convert html to markdown.
     *
     * @param $html
     */
    public function toMarkdown($html)
    {
        $htmlConverter = new HtmlConverter();
        return $htmlConverter->convert($html);
    }

    /**
     * Converts markdown text style to html.
     *
     * @param $text
     * @return mixed
     */
    public function toHtml($text)
    {
        $text = strip_tags($text);
        return MarkdownMakerExtra::defaultTransform($text);
    }
} 