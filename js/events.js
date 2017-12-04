$("#pupil").change(function(){
   if($('#pupil').val() === 'NULL'){
       $('#event_types').hide();
   }
   else{
       $('#event_types').show();
   }
});