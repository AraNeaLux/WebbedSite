document.write('\
\
    <!-- Load an icon library to show a hamburger menu (bars) on small screens -->\
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">\
    <link href="../../resources/css/tarotbarcards.css" type="text/css" rel="stylesheet">\
    <!-- Side navigation -->\
      <div class="sidenav" id="mySidenav">\
        <a href="0.html" class="active">Index</a>\ 
        <a href="00.html">The Fool</a>\
        <a href="01.html">The Magician</a>\
        <a href="02.html">The High Priestess</a>\
        <a href="03.html">The Empress</a>\
        <a href="04.html">The Emperor</a>\
        <a href="05.html">The Hierophant</a>\
        <a href="06.html">The Lovers</a>\
        <a href="07.html">The Chariot</a>\
        <a href="08.html">Strength</a>\
        <a href="09.html">The Hermit</a>\
        <a href="10.html">The Wheel of Fortune</a>\
        <a href="11.html">Justice</a>\
        <a href="12.html">The Hanged Man</a>\
        <a href="13.html">Death</a>\
        <a href="14.html">Temperance</a>\
        <a href="15.html">The Devil</a>\
        <a href="16.html">The Tower</a>\
        <a href="17.html">The Star</a>\
        <a href="18.html">The Moon</a>\
        <a href="19.html">The Sun</a>\
        <a href="20.html">Judgement</a>\
        <a href="21.html">The World</a>\
        <a href="javascript:void(0);" class="icon" onclick="MSACards()">\
        <i class="fa fa-bars"></i></a>\ 
  </div>\
\
');

/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function MSACards() {
  var x = document.getElementById("mySidenav");
  if (x.className === "sidenav") {
    x.className += " responsive";
  } else {
    x.className = "sidenav";
  }
}
