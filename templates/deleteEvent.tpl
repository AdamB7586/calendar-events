{strip}
{if $smarty.get.editid}
<div class="col-md-6 col-lg-12">
<div class="panel panel-danger">
    <div class="panel-heading">Delete Event</div>
    <div class="panel-body text-center">
        <form method="post" action="/student/lessons?deleteid={$editinfo.id}{if $smarty.get.view}&amp;view={$smarty.get.view}{/if}{if $smarty.get.startdate}&amp;startdate={$smarty.get.startdate}{/if}" role="form" class="form-horizontal" id="deleteLesson">
            <input type="submit" name="delete" id="deleteBtn" value="Delete Event" class="btn btn-danger" />
        </form>
    </div>
</div>
</div>
{/if}
{/strip}