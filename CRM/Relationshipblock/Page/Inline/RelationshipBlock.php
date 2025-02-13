<?php
use CRM_Relationshipblock_ExtensionUtil as E;

class CRM_Relationshipblock_Page_Inline_RelationshipBlock extends CRM_Core_Page {

  public function run() {
    $contactId = CRM_Utils_Request::retrieveValue('cid', 'Positive');
    if (!$contactId) {
      // Let's fail silently.
      return;
    }
    self::addKeyRelationshipsBlock($this, $contactId);

    // check logged in user permission
    if (!isset($page->_permission)) {
      CRM_Contact_Page_View::checkUserPermission($this, $contactId);
    }

    parent::run();
  }

  /**
   * @param CRM_Core_Page $page
   * @param int $contactId
   * @throws CiviCRM_API3_Exception
   */
  public static function addKeyRelationshipsBlock(&$page, $contactId) {
    $existingRelationships = CRM_Relationshipblock_Utils_RelationshipBlock::getExistingRelationships($contactId);
    $page->assign('contactId', $contactId);
    $page->assign('existingRelationships', $existingRelationships);
    $settingFields = array_merge(CRM_Relationshipblock_Settings::getContactFields(), CRM_Relationshipblock_Settings::getRelationshipFields());
    $page->assign('settingFields', $settingFields);
    $page->assign('settingLabels', self::getSettingLabels($settingFields));
    if (!$existingRelationships) {
      $relTypes = CRM_Relationshipblock_Utils_RelationshipBlock::getDisplayedRelationshipTypes($contactId);
      $page->assign('keyRelationshipLabel', count($relTypes) > 1 ? E::ts('Key Relationships') : CRM_Utils_Array::first($relTypes)['label']);
    }
  }

  /**
   * @param array $settingFields
   * @return array
   * @throws CiviCRM_API3_Exception
   */
  private static function getSettingLabels(array $settingFields): array {
    $labels = [];
    if (CRM_Relationshipblock_Settings::getDisplayLabels()) {
      $list = array_merge(CRM_Relationshipblock_Settings::contactFieldsList(), CRM_Relationshipblock_Settings::relationshipFieldsList());
      foreach ($settingFields as $field) {
        $labels[$field] = $list[$field];
      }
    }

    return $labels;
  }

}
