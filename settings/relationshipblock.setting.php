<?php

use CRM_Relationshipblock_ExtensionUtil as E;

return [
  'relationshipblock_contact_fields' => [
    'name' => 'relationshipblock_contact_fields',
    'title' => E::ts('Contact fields'),
    'description' => E::ts('Additional contact fields displayed on block'),
    'type' => 'String',
    'html_type' => 'select',
    'serialize' => CRM_Core_DAO::SERIALIZE_SEPARATOR_TRIMMED, // SERIALIZE_JSON still doesn't work
    'html_attributes' => [
      'multiple' => 1,
      'class' => 'huge crm-select2',
    ],
    'pseudoconstant' => [
      'callback' => 'CRM_Relationshipblock_Settings::contactFieldsList',
    ],
    'default' => '',
    'add' => '5.43',
    'is_domain' => 1,
    'is_contact' => 0,
    'settings_pages' => ['relationshipblock' => ['weight' => 10]],
  ],
  'relationshipblock_relationship_fields' => [
    'name' => 'relationshipblock_relationship_fields',
    'title' => E::ts('Relationship fields'),
    'description' => E::ts('Additional relationship fields displayed on block'),
    'type' => 'String',
    'html_type' => 'select',
    'serialize' => CRM_Core_DAO::SERIALIZE_SEPARATOR_TRIMMED, // SERIALIZE_JSON still doesn't work
    'html_attributes' => [
      'multiple' => 1,
      'class' => 'huge crm-select2',
    ],
    'pseudoconstant' => [
      'callback' => 'CRM_Relationshipblock_Settings::relationshipFieldsList',
    ],
    'default' => '',
    'add' => '5.43',
    'is_domain' => 1,
    'is_contact' => 0,
    'settings_pages' => ['relationshipblock' => ['weight' => 20]],
  ],
];
