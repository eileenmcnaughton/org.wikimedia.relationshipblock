{if $existingRelationships}
<div class="contactCardLeft">
  <div class="crm-summary-contactinfo-block">
    <div class="crm-summary-block" id="contactinfo-block">
      <div id="crm-relblock-content" class="crm-inline-edit"  {literal}data-edit-params='{"cid" : 203, "class_name" : "CRM_Relationshipblock_Form_Inline_RelationshipBlock"}' {/literal}>
        <div class="crm-clear crm-inline-block-content" title="Edit info">
          <div class="crm-edit-help"><span class="crm-i fa-pencil"></span>{ts}Edit info{/ts}</div>
          <div class="crm-clear crm-inline-block-content">
            <div class="crm-summary-row" ></div>

              {foreach from=$existingRelationships item=existingRelationship}
                <div class="crm-label">{$existingRelationship.relationship_type}</div>
                <div class="crm-content">{$existingRelationship.relation_display_name}</div>
              {/foreach}

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{/if}