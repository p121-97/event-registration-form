$( document ).ready(function() {
    $('#editableTable').SetEditable({
        columnsEd: "0,1,2,3,4,5",
        onEdit: function(columnsEd) {
          var first_name = columnsEd[0].childNodes[1].innerHTML;
          var last_name = columnsEd[0].childNodes[3].innerHTML;
          var display_name = columnsEd[0].childNodes[5].innerHTML;
          var phone_number = columnsEd[0].childNodes[7].innerHTML;
          var email = columnsEd[0].childNodes[9].innerHTML;
          $.ajax({
              type: 'POST',			
              url : "action.php",	
              dataType: "json",					
              data: {first_name:first_name, last_name:last_name, display_name:display_name, phone_number:phone_number, email:email, action:'edit'},			
              success: function (response) {
                  if(response.status) {
                  }						
              }
          });
        },
        onBeforeDelete: function(columnsEd) {
        var empId = columnsEd[0].childNodes[1].innerHTML;
        $.ajax({type: 'POST',			
        url : "action.php",
        dataType: "json",					
        data: {first_name:first_name, action:'delete'},			
        success: function (response) {
            if(response.status) {
            }			
        }
    });
  },
});
});
