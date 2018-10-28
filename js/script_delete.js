// CUSTOM SCRIPTS

$(document).ready(function(){
  //process the form
  $('.delete_data').click(function(event) {

    //get the form data

    var courseid = $(this).attr('id');

    //process the form

    $.ajax({
      type  : 'POST',     //type of HTTP verb
      url   : 'pro_delete.php',  //the url we are posting our data to
      data  : 'courseid='+courseid, //our data object
      datatype : 'json',  //type of data we are expecting back
     encode  : true
    })
    //using the done promise callback
    .done(function(data) {
      // if(!data.success){
      //   //handle errors
      //   $('#messages').append('<div class="alert alert-danger">'+ data.errors +'</div>');
      //   // alert(data.message);
      // }
      // else{
      //   $('#messages').append('<div class="alert alert-success">'+ data.message +'</div>');
      // }
      console.log(data)
    });
    event.preventDefault();
  });
});
