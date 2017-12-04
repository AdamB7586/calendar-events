{strip}
{if $smarty.get.editid}
<div class="col-md-6 col-lg-12" id="editevent">
<form method="post" action="" role="form" class="form-horizontal" id="editForm">
<div class="panel panel-warning">
    <div class="panel-heading">Edit Event</div>
    <div class="panel-body">
        <div class="form-group">
            <label for="editpupil" class="col-sm-3 control-label">Pupil:</label>
            <div class="col-sm-9">
                {include file="select-menus/pupils.tpl"}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="editnotes">Notes:</label>
            <div class="col-sm-9"><textarea name="editnotes" id="editnotes" cols="50" rows="3" class="form-control">{$editinfo.event}</textarea></div>
        </div>
        <div class="form-group form-inline">
            <label class="col-sm-3 control-label">Date:</label>
            <div class="col-sm-9"><input type="text" name="editdate" id="editdate" class="datepicker form-control" size="20" value="{$editinfo.start|date_format:"%d/%m/%Y"}" /></div>
        </div>
        <div class="form-group form-inline">
            <label class="col-sm-3 control-label">Time:</label>
            <div class="col-sm-9">{$editTime}</div>
        </div>
        <div class="form-group form-inline">
            <label for="editdate" class="col-sm-3 control-label">Length:</label>
            <div class="col-sm-9">{$editLength}</div>
        </div>
        <div class="form-group" id="event_types">
            <label for="edittype" class="col-sm-3 control-label">Event Type:</label>
            <div class="col-sm-9">{include file="select-menus/eventType.tpl"}</div>
        </div>
        <div class="form-group">
            <label for="submit" class="col-sm-3 control-label sr-only">Edit Event</label>
            <div class="col-sm-9"><input name="submit" type="submit" value="Update Event" class="btn btn-default" /></div>
        </div>
    </div>
</div>
</form>
</div>
{/if}
{/strip}