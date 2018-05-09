</div>

<div id="crm-relblock-content" class="crm-inline-edit"  {literal}data-edit-params='{"cid": {/literal}{$contactId}{literal}, "class_name": "CRM_Relationshipblock_Form_Inline_RelationshipBlock"}'{/literal}>
  <div class="crm-clear crm-inline-block-content" title="Edit info">
    <div class="crm-edit-help"><span class="crm-i fa-pencil"></span>{ts}Edit info{/ts}</div>
    <div class="crm-clear crm-inline-block-content" id="contact-summary-relationship-block">

    </div>
  </div>
</div>
<div  class="contactCardLeft" >{ts}Key Relationships{/ts}</div>
<div id="blank" class="contactCardRight" ></div>
<script>
  {literal}
  CRM.loadPage(
    CRM.url(
      'civicrm/relationshipblock/view',
      {"snippet" : 1, "cid" : {/literal}{$contactID}{literal}},
      'back'
    ),
    {
      target : '#contact-summary-relationship-block',
      dialog : false
    }
  );
{/literal}
</script>

<div>