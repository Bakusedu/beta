// CUSTOM SCRIPTS

$(document).ready(function(){
  //process the form
  $('#enter').click(function(event) {

    //get the form data

    var exam_score = $('input[name=exam_score]').val();

    //process the form

    $.ajax({
      type  : 'POST',     //type of HTTP verb
      url   : 'exam_upload.php',  //the url we are posting our data to
      data  : 'exam_score='+exam_score, //our data object
      datatype : 'json'  //type of data we are expecting back
      // encode  : true
    })
    //using the done promise callback
    .done(function(data) {
       //handle errors
      //    $('#messages').append('<div class="alert alert-danger">'+ data.errors +'</div>');
      // //   // alert(data.message);
      // }
      //  else{
      //    $('#messages').append('<div class="alert alert-success">'+ data.message +'</div>');
      //  }
      console.log(data);
  });
  event.preventDefault();
 });
});
