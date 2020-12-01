function topnavResponsive() {
  let x = document.getElementById("topnav-bar");

  if (x.className === "topnav") x.className += " responsive";
  else x.className = "topnav";
}