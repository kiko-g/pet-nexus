// Fill heart button
function fill(button) {
  let empty = button.childNodes[1].className === "fa fa-heart-o pink big";


  let fav_id = button.id.split('-');
  fav_id = fav_id[fav_id.length - 1];

  if (empty)
    heart(button, fav_id);
  else
    unheart(button, fav_id);

}


function unheart(button, id) {

  console.log(button);
  console.log(id);
  fetch('/actions/unheart_pet.php', {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ pet_id: id })
  }
  ).then((text) => {
    button.childNodes[1].className = "fa fa-heart-o pink big";
  });

}


function heart(button, id) {

  fetch('/actions/heart_pet.php', {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ pet_id: id })
  }
  ).then((text) => {
    button.childNodes[1].className = "fa fa-heart pink big";
  });

}


function displayProposalPopup() {
  document.getElementById('proposal-popup').style.display = 'block';
}

