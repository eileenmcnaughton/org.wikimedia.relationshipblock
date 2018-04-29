<?php
use CRM_Relationshipblock_ExtensionUtil as E;

class CRM_Relationshipblock_Page_RelationshipBlock extends CRM_Core_Page {

  public function run() {
    CRM_Utils_System::setTitle(E::ts('RelationshipBlock'));
    $contactID = CRM_Utils_Request::retrieveValue('cid', 'Integer');
    if (!$contactID) {
      // Let's fail silently.
      return;
    }

    $contactType = civicrm_api3('contact', 'getvalue', array('id' => $contactID, 'return' => 'contact_type'));

    $existingRelationships = CRM_Relationshipblock_Utils_RelationshipBlock::getExistingRelationships($contactID);
    $this->assign('existingRelationships', $existingRelationships);
    parent::run();
  }

}
