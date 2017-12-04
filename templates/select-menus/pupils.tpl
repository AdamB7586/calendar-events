{strip}
<select name="pupil" id="pupil" class="form-control">
    <option value=""> </option>
    <option value="NULL"{if $smarty.post.pupil == NULL || $editinfo.pupil == NULL} selected="selected"{/if}>Personal Event (No Pupil)</option>
    <optgroup label="Select Pupil">
        {foreach $pupillist as $pupilinfo}
            <option value="{$pupilinfo.cust_id}"{if $smarty.post.pupil == $pupilinfo.cust_id || $editinfo.pupil == $pupilinfo.cust_id} selected="selected"{/if}>{$pupilinfo.firstname} {$pupilinfo.surname}</option>
        {/foreach}
    </optgroup>
</select>
{/strip}