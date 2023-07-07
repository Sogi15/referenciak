
// radio gomb ikon hozzáadása
document.addEventListener('DOMContentLoaded', function () {
  // azon labellek kiválasztása melyen a beírt classal rendelkeznek
  var labels = document.querySelectorAll('.form1check');

  // function a class és a szöveg változtatásához
  function handleRadioChange(event) {
    labels.forEach(function (label) {
      // class hozzáadás és törlés az inaktív gombhoz 
      label.classList.remove('btn-outline-primary');
      label.classList.add('btn-outline-secondary');
      labels[0].innerHTML = "Igen"; // Szöveg visszaállítása az eredetire.
      labels[1].innerHTML = "Nem"; //  --
    });

    // class hozzáadás és törlés az aktív gombhoz 
    var selectedLabel = event.target.nextElementSibling;
    selectedLabel.classList.remove('btn-outline-secondary');
    selectedLabel.classList.add('btn-outline-primary');
    selectedLabel.innerHTML += ' ✓'; // pipa jel hozzáadása a kiválasztotthoz (if checked)

  }

  labels.forEach(function (label) {
    var radio = label.previousElementSibling;
    radio.addEventListener('change', handleRadioChange);
  });
});