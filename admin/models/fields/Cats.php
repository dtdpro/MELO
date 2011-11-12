<?php
defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');

class JFormFieldCats extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Cats';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		// Initialize variables.
		$html = array();
		$attr = '';
		$db = JFactory::getDBO();
		// Initialize some field attributes.
		$attr .= $this->element['class'] ? ' class="'.(string) $this->element['class'].'"' : '';
		$attr .= ((string) $this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
		$attr .= $this->element['size'] ? ' size="'.(int) $this->element['size'].'"' : '';

		// Initialize JavaScript field attributes.
		$attr .= $this->element['onchange'] ? ' onchange="'.(string) $this->element['onchange'].'"' : '';


		// Build the query for the ordering list.
		$query->select('CONCAT(scat.scat_name,"\",cat.cat_name) AS text,cat.cat_id AS value');
		$query->from('#__melo_cats as cat');
		$query->join('RIGHT', '#__melo_scats AS scat ON scat.scat_id = cat.cat_sec');
		$query->order("scat.scat_name,cat.cat_name");
		$db->setQuery($query);
		$html[] = JHtml::_('select.genericlist',$db->loadObjectList(),$this->name,$attr, "value","text",$this->value);
		

		return implode($html);
	}
}
