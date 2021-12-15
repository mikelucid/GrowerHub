<?php

use League\CommonMark\GithubFlavoredMarkdownConverter;

function markdown(): GithubFlavoredMarkdownConverter
{
	return new GithubFlavoredMarkdownConverter([
		'html_output' =>'strip',
		'allow_unsafe_links' => false
	]);
}