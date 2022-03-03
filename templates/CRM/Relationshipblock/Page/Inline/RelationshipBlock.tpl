<div id="crm-relblock-content" {if $permission EQ 'edit'}class="crm-inline-edit crm-clear" {literal}data-edit-params='{"cid": {/literal}{$contactId}{literal}, "class_name": "CRM_Relationshipblock_Form_Inline_RelationshipBlock"}'{/literal}{/if}>
  <div class="crm-clear crm-inline-block-content" title="{ts escape='html'}Edit relationships{/ts}">
    {if $permission EQ 'edit'}
      <div class="crm-edit-help"><span class="crm-i fa-pencil"></span>{ts}Edit{/ts}</div>
    {/if}
    {if !empty($existingRelationships)}
      {foreach from=$existingRelationships item=existingRelationship}
        <div class="crm-summary-row">
          <div class="crm-label">{$existingRelationship.relationship_type|escape}</div>
          <div class="crm-content">
            {assign var='i' value=1}
            <span>
              {foreach from=$existingRelationship.contacts item=contact name=rel}
                <a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$contact.contact_id`"}" title="{ts escape='html'}view contact{/ts}">
                  {$contact.display_name|escape}</a>{if $contact.is_deceased} <span class="crm-contact-deceased">(deceased)</span>{/if}{if not $smarty.foreach.rel.last and $i neq 6},
                {elseif $i eq 6}</span><span class="relblock-show-more">... <a href="#">{ts}(more){/ts}</a></span><span style="display:none">{/if}
                  {foreach from=$settingFields item=field name=settingFields}
                    {if !empty($contact[$field])}
                      {assign var='validEmail' value=$contact[$field]|filter_var:$smarty.const.FILTER_VALIDATE_EMAIL}
                      {if $contact[$field] eq $validEmail}
                         <a href="mailto:{$validEmail}" title="{ts}Click to send email{/ts}">{$validEmail}</a>{if !$smarty.foreach.settingFields.last}, {/if}
                      {else}
                        {$contact[$field]}{if !$smarty.foreach.settingFields.last}, {/if}
                      {/if}
                    {/if}
                    {if $smarty.foreach.settingFields.last}<br>{/if}
                  {/foreach}
                {assign var='i' value=$i+1}
              {/foreach}
            </span>
          </div>
        </div>
      {/foreach}
      <script type="text/javascript">{literal}
        CRM.$(function($) {
          $('.relblock-show-more a').click(function(e) {
            $(this).parent().text(',').next().show();
            e.preventDefault();
          });
        });
      {/literal}</script>
    {elseif isset($keyRelationshipLabel)}
      <div class="crm-summary-row">
        <div class="crm-label">{$keyRelationshipLabel|escape}</div>
        <div class="crm-content"></div>
      </div>
    {/if}
  </div>
</div>
