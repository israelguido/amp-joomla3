<?php
defined('_JEXEC') or die('Restricted access');

function StoriesBuildRoute(&$query)
{
    $segments = array();
    if (isset($query['view'])) {
        $segments[] = $query['view'];
        unset($query['view']);
    }
    return $segments;
}

function StoriesParseRoute($segments)
{
    $vars = array();
    $vars['view'] = $segments[0];
    return $vars;
}
