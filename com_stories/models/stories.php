<?php
defined('_JEXEC') or die('Restricted access');

class StoriesModelStories extends JModelList
{
    public function getStories()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from('#__k2_items')
            ->where('published = 1')
            ->order('created DESC')
            ->setLimit(10); // Limitar a 10 itens
        $db->setQuery($query);
        $stories = $db->loadObjectList();

        foreach ($stories as &$story) {
            // Construir o link diretamente, sem tentar fazer URL amigável
            $story->link = JRoute::_('index.php?option=com_k2&view=item&id=' . $story->id);
        }

        return $stories;
    }
}
?>
