// ELEMENTI DOHVAĆENI
const uploadButton = document.querySelector('#uploadButton');
const fileInput = document.querySelector('#fileInput');
const fileName = document.querySelector('#fileName');
const editFile = document.querySelector('#editFile');
const deleteFile = document.querySelector('#deleteFile');
const errorMessage = document.querySelector('#errorMessage');
const tableBody = document.querySelector("table tbody");

// POLJA ZA POPUNJAVANJE
const code = document.querySelector('#code');
const check = document.querySelector('#check');
const sample = document.querySelector('#sample');
const time = document.querySelector('#time');
const phase = document.querySelector('#phase');

// EVENT HANDLER – kada doktor klikne dugme
uploadButton.addEventListener('click', async (e) => {
    e.preventDefault();

    if (!validateFields()) {
        alert("Molimo Vas doktore da popunite sva polja!");
        return;
    }

    const nalaz = {
        šifraNalaza: parseInt(code.value),
        tipNalaza: check.value,
        vrsta_uzorka: sample.value,
        datum_obrade: time.value + " 00:00:00",  // datetime format
        status: phase.value,
        pregledi_id: 1 // privremeno dok se ne poveže sa pregledima
    };

    try {
        const response = await fetch("http://localhost/sdp/labs/add", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
                // Authorization: "Bearer tvojToken" ako koristiš zaštitu
            },
            body: JSON.stringify(nalaz)
        });

        if (!response.ok) throw new Error("Greška u dodavanju nalaza.");

        const data = await response.json();
        console.log("Uspješno dodat nalaz:", data);

        // Dodaj red u tabelu
        addingRowToTable(nalaz);

        // Očisti polja
        deleteFields();

        alert("Nalaz uspješno dodat!");

    } catch (error) {
        console.error("Greška:", error);
        alert("Dodavanje nalaza nije uspjelo.");
    }
});

// Dodaje red u tabelu na stranici
function addingRowToTable(nalaz) {
    const row = document.createElement('tr');
    row.innerHTML = `
        <td>${nalaz.šifraNalaza}</td>
        <td>${nalaz.tipNalaza}</td>
        <td>${nalaz.vrsta_uzorka}</td>
        <td>${nalaz.datum_obrade}</td>
        <td>${nalaz.status}</td>
        <td><button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Izbriši</button></td>
    `;
    tableBody.appendChild(row);
}

// Validacija polja
function validateFields() {
    return [...document.querySelectorAll("input:not([type='file'])")]
        .every(input => input.value.trim() !== "");
}

// Brisanje inputa
function deleteFields() {
    document.querySelectorAll("input:not([type='file'])")
        .forEach(input => input.value = "");
}

// Brisanje reda iz tabele
function deleteRow(button) {
    button.closest('tr').remove();
}