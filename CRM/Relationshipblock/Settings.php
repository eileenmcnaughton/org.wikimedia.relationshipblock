<?php

class CRM_Relationshipblock_Settings {

  /**
   * @return array
   * @throws CiviCRM_API3_Exception
   */
  public static function contactFields(): array {
    $result = civicrm_api3('Contact', 'getfields', [
      'api_action' => "get",
    ]);
    $fields = [];
    foreach ($result['values'] as $field) {
      $fields[$field['name']] = $field['title'];
    }

    return $fields;
  }

  /**
   * @return array
   * @throws CiviCRM_API3_Exception
   */
  public static function relationshipFields(): array {
    $result = civicrm_api3('Relationship', 'getfields', [
      'api_action' => "get",
    ]);
    $fields = [];
    foreach ($result['values'] as $field) {
      $fields[$field['name']] = $field['title'];
    }

    return $fields;
  }

  /**
   * @return array
   */
  public static function getContactFields(): array {
    return CRM_Relationshipblock_Settings::getArray('relationshipblock_contact_fields');
  }

  /**
   * @return array
   */
  public static function getRelationshipFields(): array {
    return CRM_Relationshipblock_Settings::getArray('relationshipblock_relationship_fields');
  }

  /**
   * Get setting saved as serialized by separator.
   * @param string $settingName
   * @return array
   */
  private static function getArray(string $settingName): array {
    $value = Civi::settings()->get($settingName);
    if ($value) {
      return explode(CRM_Core_DAO::VALUE_SEPARATOR, trim($value, CRM_Core_DAO::VALUE_SEPARATOR));
    }

    return [];
  }

}
