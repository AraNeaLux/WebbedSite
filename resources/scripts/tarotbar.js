document.write('\
\
    <!-- Load an icon library to show a hamburger menu (bars) on small screens -->\
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">\
\
    <link href="../resources/css/tarot.css" type="text/css" rel="stylesheet">\
    <div class="tarotnav" id="myTarotnav">\
      <a href="../index.html" class="active">Home</a>\
      <a href="0.html">Tarot</a>\
      <a href="major/0.html">Major</a>\
      <a href="minor/0.html">Minor</a>\
      <a href="astrological/0.html">Astrological</a>\
      <a href="crystals/0.html">Crystals</a>\
      <a href="plants/0.html">Plants</a>\
      <a href="javascript:void(0);" class="icon" onclick="MSAtarot()">\
      <i class="fa fa-bars"></i>\
      </a>\
    </div>\
\
');

/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function MSAtarot() {
  var x = document.getElementById("myTarotnav");
  if (x.className === "tarotnav") {
    x.className += " responsive";
  } else {
    x.className = "tarotnav";
  }
}
