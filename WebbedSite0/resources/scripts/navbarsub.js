document.write('\
\
    <!-- Load an icon library to show a hamburger menu (bars) on small screens -->\
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">\
\
    <link href="../resources/css/index.css" type="text/css" rel="stylesheet">\
    <h1>Obscuritea: Pt 0</h1>\
    <h4>How did you find me?</h4>\
    <link href="../resources/css/navbar.css" type="text/css" rel="stylesheet">\
    <div class="topnav" id="myTopnav">\
      <a href="../index.html" class="active">Home</a>\
      <a href="../house/welcome/0.html">About</a>\
      <a href="../science/0.html">Science</a>\
      <div class="dropdown">\
        <button class="dropbtn">Perfumery</button>\
        <div class="dropdown-content">\
          <a href="../perfumery/0.html">Overview</a>\
          <a href="../perfumery/1.html">Materials</a>\
          <a href="../perfumery/2.html">Formulae</a>\
        </div>\
      </div>\
      <a href="../javascript:void(0);" class="icon" onclick="mobileScreenAdjust()">\
        <i class="fa fa-bars"></i>\
      </a>\
    </div>\
\
');

/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function mobileScreenAdjust() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
