/*
function addRow(button) {
  var nazivBolesti = button.closest('tr').querySelector('input[placeholder="Naziv bolesti"]').value;
  var dijagnoza = button.closest('tr').querySelector('input[placeholder="Dijagnoza"]').value;
  var terapija = button.closest('tr').querySelector('input[placeholder="Terapija"]').value;
  var zadnjiPregled = button.closest('tr').querySelector('input[type="date"]').value;
  var nalaz = button.closest('tr').querySelector('input[placeholder="Nalaz"]').value;
  
  if (nazivBolesti && dijagnoza && terapija && zadnjiPregled && nalaz) {
    var table = button.closest('table').getElementsByTagName('tbody')[0];
    var newRow = table.insertRow();

    newRow.innerHTML = `
      <td>${nazivBolesti}</td>
      <td>${dijagnoza}</td>
      <td>${terapija}</td>
      <td>${zadnjiPregled}</td>
      <td>${nalaz}</td>
      <td><button class="btn btn-danger" onclick="deleteRow(this)">Obriši</button></td>
    `;

    button.closest('tr').querySelector('input[placeholder="Naziv bolesti"]').value = '';
    button.closest('tr').querySelector('input[placeholder="Dijagnoza"]').value = '';
    button.closest('tr').querySelector('input[placeholder="Terapija"]').value = '';
    button.closest('tr').querySelector('input[type="date"]').value = '';
    button.closest('tr').querySelector('input[placeholder="Nalaz"]').value = '';
  } else {
    alert('Molimo popunite sva polja!');
  }
}

function deleteRow(button) {
  var row = button.closest('tr');
  row.remove();
}

function triggerFileUpload(button) {
  var fileInput = button.closest('tr').querySelector('#file-upload');
  fileInput.click();  
}
*/

document.getElementById('btnAddNalaz').addEventListener('click', function(e) {
  e.preventDefault();

  const row = this.closest('tr');
  const nazivBolesti = row.querySelector('input[name="nazivBolesti"]').value.trim();
  const dijagnoza = row.querySelector('input[name="dijagnoza"]').value.trim();
  const terapija = row.querySelector('input[name="terapija"]').value.trim();
  const zadnjiPregled = row.querySelector('input[name="zadnjiPregled"]').value;
  const nalaz = row.querySelector('input[name="nalaz"]').value.trim();

  if(!nazivBolesti || !dijagnoza || !terapija || !zadnjiPregled || !nalaz) {
    alert('Molimo popunite sva polja!');
    return;
  }

  const pacijent_id = 1;  
  const doktor_id = 1;
  const pregledi_id = 1;

  const data = {
    nazivBolesti,
    dijagnoza,
    terapija,
    zadnjiPregled,
    nalaz,
    pacijent_id,
    doktor_id,
    pregledi_id
  };

  fetch('http://backend.app/backend/cards', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  })
  .then(res => {
    if(!res.ok) throw new Error('Greška pri dodavanju nalaza!');
    return res.json();
  })
  .then(response => {
    alert('Nalaz je uspješno dodat.');

    // Očisti formu
    row.querySelector('input[name="nazivBolesti"]').value = '';
    row.querySelector('input[name="dijagnoza"]').value = '';
    row.querySelector('input[name="terapija"]').value = '';
    row.querySelector('input[name="zadnjiPregled"]').value = '';
    row.querySelector('input[name="nalaz"]').value = '';

    // Dodaj red u tabelu sa unesenim podacima (možeš napraviti funkciju za to)
    addRowToTable(response);
  })
  .catch(err => {
    alert(err.message);
  });
});

// Funkcija za dodavanje novog reda u tabelu sa podacima iz baze
function addRowToTable(nalaz) {
  const tableBody = document.querySelector('#nalaziTable tbody');

  // Kreiraj novi red (možeš i ukloniti onaj sa inputima, ili ga ostaviš na dnu)
  const newRow = document.createElement('tr');

  newRow.innerHTML = `
    <td>${nalaz.nazivBolesti}</td>
    <td>${nalaz.dijagnoza}</td>
    <td>${nalaz.terapija}</td>
    <td>${nalaz.zadnjiPregled}</td>
    <td>${nalaz.nalaz}</td>
    <td><button class="btn btn-danger" onclick="deleteRow(this)">Obriši</button></td>
  `;

  tableBody.appendChild(newRow);
}

function deleteRow(button) {
  const row = button.closest('tr');
  row.remove();
}
