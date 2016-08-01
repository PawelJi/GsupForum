<?php

namespace Tests\Gsup\ForumBundle\Helper;

use Gsup\ForumBundle\Helper\Transformer\Text\Markdown;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * MarkdownTest class.
 * @package Gsup\ForumBundle\Tests\Helper
 * @author: Pawel Jablonski <dev.pawel@gmail.com>
 */
class MarkdownTest extends TypeTestCase
{
    /**
     * @var \Gsup\ForumBundle\Helper\Transformer\Text\Markdown
     */
    private $_helper;

    public function getFixtureContent($key)
    {
        $retval = [];

        $markdown = <<< MARKDOWN
- List item

This is the _first_ editor.
---------------------------

Just plain **Markdown**, except that the input is sanitized:

<marquee>I'm the ghost from the past!</marquee>

and that it implements "fenced blockquotes" via a plugin:

Do it like this:

1. Have idea.
2. ???
3. Profit!
MARKDOWN;

        $retval['markdown_list'] = $markdown;

        $html = <<< HTML
<ul>
<li>List item</li>
</ul>

<h2>This is the <em>first</em> editor.</h2>

<p>Just plain <strong>Markdown</strong>, except that the input is sanitized:</p>

<p>I'm the ghost from the past!</p>

<p>and that it implements "fenced blockquotes" via a plugin:</p>

<p>Do it like this:</p>

<ol>
<li>Have idea.</li>
<li>???</li>
<li>Profit!</li>
</ol>

HTML;

        $retval['html_list'] = $html;

        return $retval[$key];
    }

    protected function setUp()
    {
        parent::setUp();

        $this->_helper = new Markdown();
    }

    /**
     * Clears html marukup in markdown content.
     *
     * @param $markup
     * @return mixed
     */
    private function _sanitizeHtmlInMarkup($markup)
    {
        $markup = preg_replace('/\<marquee\>/', '', $markup);
        $markup = preg_replace('/\<\/marquee\>/', '', $markup);
        return $markup;
    }

    public function testToMarkdown()
    {
        $expectedContent = $this->_sanitizeHtmlInMarkup($this->getFixtureContent('markdown_list'));
        $this->assertEquals($expectedContent, $this->_helper->toMarkdown($this->getFixtureContent('html_list')));
    }

    public function testToHtml()
    {
        $this->assertEquals($this->getFixtureContent('html_list'), $this->_helper->toHtml($this->getFixtureContent('markdown_list')));
    }
} 