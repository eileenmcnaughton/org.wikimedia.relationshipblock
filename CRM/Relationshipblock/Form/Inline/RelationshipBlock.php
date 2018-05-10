<?php

use CRM_Relationshipblock_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://wiki.civicrm.org/confluence/display/CRMDOC/QuickForm+Reference
 */
class CRM_Relationshipblock_Form_Inline_RelationshipBlock extends CRM_Contact_Form_Inline {
  public function buildQuickForm() {
    foreach (CRM_Relationshipblock_Utils_RelationshipBlock::getDisplayedRelationshipTypes($this->_contactId) as $relationshipType) {
      $params = [];
      if (in_array(['Individual', 'Household', 'Organizion'], $relationshipType['contact_type_b'])) {
        $params['contact_type'] = $relationshipType['contact_type_b'];
      }
      if (!empty($relationshipType['contact_sub_type_b'])) {
        $params['contact_sub_type'] = $relationshipType['contact_sub_type_b'];
      }
      $props = array(
        'api' => array('params' => $params),
        'create' => TRUE,
        'context' => 'Create',
        'entity' => 'Contact',
      );
      $this->addEntityRef('rel_' . $relationshipType['id'], $relationshipType['label_a_b'], $props, FALSE);
    }

    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());
    parent::buildQuickForm();
  }

  public function postProcess() {
    // Fixme: Do real postprocess
    //    $values = $this->exportValues();
    //    $relatedContactID = $values['rel'];
    //    civicrm_api3('Relationship', 'create', ['contact_id_a' => $this->_contactId, 'contact_id_b' => $relatedContactID]);
    $this->ajaxResponse['updateTabs'] = array(
      '#tab_rel' => CRM_Contact_BAO_Contact::getCountComponent('rel', $this->_contactId),
    );
    $this->log();
    $this->response();
  }

  /**
   * Get defaults
   */
  public function setDefaultValues() {
    $defaults = [];
    $existingRelationships = CRM_Relationshipblock_Utils_RelationshipBlock::getExistingRelationships($this->_contactId);
    foreach ($existingRelationships as $existingRelationship) {
      $defaults['rel_' . $existingRelationship['relationship_type_id']] = $existingRelationship['other_contact_id'];
    }
    return $defaults;
  }

  /**
   * Get the fields/elements defined in this form.
   *
   * @return array (string)
   */
  public function getRenderableElementNames() {
    // The _elements list includes some items which should not be
    // auto-rendered in the loop -- such as "qfKey" and "buttons".  These
    // items don't have labels.  We'll identify renderable by filtering on
    // the 'label'.
    $elementNames = array();
    foreach ($this->_elements as $element) {
      /** @var HTML_QuickForm_Element $element */
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }
    return $elementNames;
  }

}
