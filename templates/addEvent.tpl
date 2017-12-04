{strip}
<form method="post" action="/student/lessons#addevent" id="addevent">
<div class="col-md-6 col-lg-12">
<div class="panel panel-default">
    <div class="panel-heading">Add Event</div>
    <div class="panel-body form-horizontal">
        <div class="form-group">
            <label for="pupil" class="col-sm-3 control-label">Pupil:</label>
            <div class="col-sm-9">
                {include file="select-menus/pupils.tpl"}
            </div>
        </div>
        <div class="form-group form-inline">
            <label class="col-sm-3 control-label">Date:</label>
            <div class="col-sm-9"><input type="text" name="date" id="date" class="datepicker form-control" size="20" value="{$smarty.post.date}" /></div>
        </div>
        <div class="form-group form-inline">
            <label class="col-sm-3 control-label">Time:</label>
            <div class="col-sm-9">{$time}</div>
        </div>
        <div class="form-group form-inline">
            <label for="date" class="col-sm-3 control-label">Length:</label>
            <div class="col-sm-9">{$length}</div>
        </div>
        <div class="form-group" id="event_types">
            <label for="type" class="col-sm-3 control-label">Event Type:</label>
            <div class="col-sm-9">{include file="select-menus/eventType.tpl"}</div>
        </div>
        <div class="form-group">
            <label for="repeat" class="col-sm-3 control-label">Repeat?</label>
            <div class="col-sm-9"><input name="repeat" type="checkbox" value="1" {if $smarty.post.repeat == 1} checked="checked"{/if} onclick="$('#repeat1').toggle('repeat1');" /></div>
        </div>
        <div class="form-group form-inline" id="repeat1" style="display:{if $smarty.post.repeat == 1}block{else}none{/if}">
            <label for="repeatnum" class="col-sm-3 control-label">Repeat for following </label>
            <div class="col-sm-9"><input name="repeatnum" type="text" value="{$smarty.post.repeatnum}" size="4" maxlength="3" class="form-control" /> <select name="repeatperiod" class="form-control"><option value="day"{if $smarty.post.repeatperiod == 'day'} selected="selected"{/if}>Days</option><option value="week"{if $smarty.post.repeatperiod == 'week' || !$smarty.post.repeatperiod} selected="selected"{/if}>Weeks</option></select></div>
        </div>
        <div class="form-group">
            <label for="submit" class="col-sm-3 control-label sr-only">Add Event</label>
            <div class="col-sm-9"><input name="submit" type="submit" value="Add Event" class="btn btn-default" /></div>
        </div>
    </div>
</div>
</div>
</form>
{/strip}