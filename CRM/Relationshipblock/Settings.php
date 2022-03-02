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

}
