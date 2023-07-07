
// drag&drop (forrás: chatGPT)

var dropzone = document.getElementById('dropzone');
var fileInput = document.getElementById('fileInput');
var fileNameElement1 = document.getElementById('fileName1');
var fileNameElement2 = document.getElementById('fileName2');


// Drag enter event
dropzone.addEventListener('dragenter', function (e) {
  e.preventDefault();
  dropzone.classList.add('dragover');
});

// Drag over event
dropzone.addEventListener('dragover', function (e) {
  e.preventDefault();
});

// Drag leave event
dropzone.addEventListener('dragleave', function () {
  dropzone.classList.remove('dragover');
});

// Drop event
dropzone.addEventListener('drop', function (e) {
  e.preventDefault();
  dropzone.classList.remove('dragover');

  var files = e.dataTransfer.files;
  processFiles(files);
});

// File input change event
fileInput.addEventListener('change', function (e) {
  var files = e.target.files;
  processFiles(files);
});

// Kattintás eseménykezelő a gombra
dropzone.addEventListener('click', function () {
  fileInput.click();
});

// Fájlok feldolgozása
function processFiles(files) {
  // Ellenőrizd, hogy van-e kiválasztott fájl
  if (files.length > 0) {
    // ha már egy 3ik fájl is be lett olvasva akkor alert üzenet majd törli a beolvasott fájlokat.
    if (files[0] && files[1] && files[2]) {
      dropzone.classList.remove('file-selected');
      alert("Csak 2 fájlt tölts fel!");
      fileInput.value = '';
      fileNameElement1.textContent = '';
      fileNameElement2.textContent = '';
    }
    else {
      // ha 2 file van kiválasztva színt változtat a divnek, illetve divekbe kiírja a 2 file nevét.
      dropzone.classList.add('file-selected');
      fileNameElement1.textContent = files[0].name;
      fileNameElement2.textContent = files[1].name;
    }
  } else { // ha nincs file kiválasztva
    dropzone.classList.remove('file-selected');
    fileNameElement1.textContent = '';
    fileNameElement2.textContent = '';
  }
};