// Fill heart button
function fill(id) {
  let button = document.getElementById('fav' + id);

  if (button.childNodes[1].className === "fa fa-heart-o pink big") button.childNodes[1].className = "fa fa-heart pink big";
  else button.childNodes[1].className = "fa fa-heart-o pink big";
}