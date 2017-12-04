{strip}
<select name="type" id="type" class="form-control">
    {foreach $eventTypes as $a => $event}
        <option value="{($a + 1)}"{if $smarty.post.type == ($a + 1) || $editinfo.type == ($a + 1)} selected="selected"{/if}>{$event}</option>
    {/foreach}
</select>
{/strip}