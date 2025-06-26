// Functie pentru expand 
function toggleCard(card) {
  card.classList.toggle("expanded");
  const title = card.querySelector(".card-title");
  title.classList.toggle("expanded");
}