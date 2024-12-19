<?php
defined('_JEXEC') or die('Restricted access');

class StoriesViewStories extends JViewLegacy
{
    function display($tpl = null)
    {
        // Obter os dados do model
        $stories = $this->get('Stories');

        // Atribuir os dados à view
        $this->stories = $stories;

        // Exibir o template
        parent::display($tpl);
    }
}
