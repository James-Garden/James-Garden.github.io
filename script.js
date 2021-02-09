var searchHidden = true; //This defines the initial state of the search bar
$(document).ready(function(){ //This function triggers when the page is fully loaded
  //This is the function for opening the search bar
  //$(".search-bar").hide(); //This closes the search bar when the page loads
  $(".button-search").click(function(){
    if (searchHidden) {
      searchHidden = false;
      $(".search-bar").slideDown("slow");
    } else {
      searchHidden = true;
      $(".search-bar").slideUp("slow");
    }
  });
  //This is the function for opening the side menu
  $(".button-menu").click(function(){
    document.getElementById("sidenav").style.width = "15vw";
  });
  //This is the function for closing the side menu
  $(".button-close-side-menu").click(function(){
    document.getElementById("sidenav").style.width = "0";
  });
});
