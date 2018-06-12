<div id="crm-relblock-content" class="crm-inline-edit"  {literal}data-edit-params='{"cid": {/literal}{$contactId}{literal}, "class_name": "CRM_Relationshipblock_Form_Inline_RelationshipBlock"}'{/literal}>
  <div class="crm-clear crm-inline-block-content" title="{ts escape='html'}Edit relationships{/ts}">
    <div class="crm-edit-help"><span class="crm-i fa-pencil"></span>{ts}Edit{/ts}</div>
    {if $existingRelationships}
      {foreach from=$existingRelationships item=existingRelationship}
        <div class="crm-summary-row">
          <div class="crm-label">{$existingRelationship.relationship_type|escape}</div>
          <div class="crm-content">
            {foreach from=$existingRelationship.contacts item=contact key=i name=rel}
              <a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$contact.contact_id`"}" title="{ts escape='html'}view contact{/ts}">
                {$contact.display_name|escape}</a>{if not $smarty.foreach.rel.last},{/if}
            {/foreach}
          </div>
        </div>
      {/foreach}
    {else}
      <div class="crm-summary-row">
        <div class="crm-label">{$keyRelationshipLabel|escape}</div>
        <div class="crm-content"></div>
      </div>
    {/if}
  </div>
</div>
