<?php

class CRM_Relationshipblock_Utils_RelationshipBlock {
  /**
   * Append detail (label & related contact name) to relationship array.
   *
   * @param array $existingRelationship
   * @param int $contactID
   * @param array $displayedRelationships
   *
   * @return mixed
   */
  protected static function appendDetailToRelationship($existingRelationship, $contactID, $displayedRelationships) {
    if ($existingRelationship['contact_id_a'] === $contactID) {
      $existingRelationship['relationship_type'] = $displayedRelationships[$existingRelationship['relationship_type_id']]['label_a_b'];
      $existingRelationship['relation_display_name'] = civicrm_api3('Contact', 'getvalue', [
        'return' => 'display_name',
        'id' => $existingRelationship['contact_id_b'],
      ]);
      $existingRelationship['other_contact_id'] = $existingRelationship['contact_id_b'];
    }
    if ($existingRelationship['contact_id_b'] === $contactID) {
      $existingRelationship['relationship_type'] = $displayedRelationships[$existingRelationship['relationship_type_id']]['label_b_a'];
      $existingRelationship['relation_display_name'] = civicrm_api3('Contact', 'getvalue', [
        'return' => 'display_name',
        'id' => $existingRelationship['contact_id_a'],
      ]);
      $existingRelationship['other_contact_id'] = $existingRelationship['contact_id_a'];
    }
    return $existingRelationship;
  }

  /**
   * Get existing relationships for the contact.
   *
   * @param int $contactID
   *
   * @return array
   */
  public static function getExistingRelationships($contactID) {
    $displayedRelationships = self::getDisplayedRelationshipTypes($contactID);
    if (empty($displayedRelationships)) {
      // Nothing to do here. Move along.
      return [];
    }
    $existingRelationships = civicrm_api3('Relationship', 'get', [
      'relationship_type_id' => ['IN' => array_keys($displayedRelationships)],
      'is_active' => 1,
      'contact_id_a' => $contactID,
    ])['values'];

    $bRelationships = civicrm_api3('Relationship', 'get', [
      'relationship_type_id' => ['IN' => array_keys($displayedRelationships)],
      'is_active' => 1,
      'contact_id_b' => $contactID,
    ])['values'];

    $existingRelationships = array_merge($existingRelationships, $bRelationships);
    foreach ($existingRelationships as $index => $existingRelationship) {
      $existingRelationships[$index] = self::appendDetailToRelationship($existingRelationship, $contactID, $displayedRelationships);
    }
    return $existingRelationships;
  }

  /**
   * Get key relationship types valid for a given contact.
   *
   * @param $contactId FIXME
   *
   * @return array
   */
  public static function getDisplayedRelationshipTypes($contactId) {
    if (!isset(\Civi::$statics[__CLASS__]['displayed_relationship_types'])) {
      $isDisplayFieldID = civicrm_api3('CustomField', 'getvalue', [
        'name' => 'is_relationship_block_on_summary',
        'return' => 'id',
      ]);
      $displayedRelationships = civicrm_api3('RelationshipType', 'get', [
        'custom_' . $isDisplayFieldID => 1,
      ]);
      \Civi::$statics[__CLASS__]['displayed_relationship_types'] = $displayedRelationships['values'];
    }
    return \Civi::$statics[__CLASS__]['displayed_relationship_types'];
  }
}