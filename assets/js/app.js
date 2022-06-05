function closeMsg(){
   $("#flash-msg").removeClass("show");
}
function showSuccessMsg(message){
   var html = "";
   html += "<div id='flash-msg' class='alert alert-success alert-dismissible fade show' role='alert'>";
   html += message;
   html += "<button type='button' class='close btn btn-outline-dark btn-sm' onclick='closeMsg()' data-dismiss='alert' aria-label='Close'>"
   html += "<span aria-hidden='true'>&times;</span>";
   html += "</button></div>";
   $('body').prepend(html);
}