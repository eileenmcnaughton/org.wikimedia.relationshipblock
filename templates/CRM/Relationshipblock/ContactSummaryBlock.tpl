</div>
<div id="contact-summary-relationship-block" class="crm-summary-row" >{ts}Key Relationships{/ts}</div>

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