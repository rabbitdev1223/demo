$(document).ready(function(){



    $('select[name=male_id]').select2();
    $('select[name=female_id]').select2();
    $('input[name=birth_date_of_couple]').datepicker({
      language: 'en',
      dateFormat: 'mm/dd/yyyy',
     maxDate: new Date() // Now can select only dates, which goes after today
    })
    
    $('#couple_made_today').click(function() {
        if ($(this).is(':checked')) {
            // $('input[name=birth_date_of_couple]').datepicker('setDate','12/12/2022');
            var now = new Date();
            var dateString = moment(now).format('MM/DD/YYYY');

            $('input[name=birth_date_of_couple]').val(dateString);
  
            
        }
      });
    
  });