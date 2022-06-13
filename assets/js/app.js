function closeMsg(){
   $("#flash-msg").removeClass("show");
   $("#flash-msg").hide();
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
//set nav link active
function setActive() {
   links = $("#navigation .navbar-nav .nav-link");
   for(i=0;i<links.length;i++) { 
     if(document.location.href.indexOf(links[i].href)>=0) {
         links[i].className='nav-link active';
     }
   }
}
window.onload = setActive;
//To prevent form resubmission when reloaded
if ( window.history.replaceState ) {
   window.history.replaceState( null, null, window.location.href );
}