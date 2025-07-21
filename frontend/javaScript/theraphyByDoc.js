document.addEventListener("DOMContentLoaded", function () {
    // DOHVAĆANJE ELEMENATA
    const uploadButton = document.querySelector('#uploadButton');
    const fileInput = document.querySelector('#fileInput');
    const tableBody = document.querySelector("#theraphy-for-doc");

    const therapy = document.querySelector('#theraphy');
    const directions = document.querySelector('#directions');
    const duration = document.querySelector('#duration');
    const control = document.querySelector('#control');
    const doctor = document.querySelector('#doctor');

    // Provjeri da li svi elementi postoje
    if (!uploadButton || !fileInput || !tableBody || !therapy || !directions || !duration || !control || !doctor) {
        console.error("Jedan ili više elemenata nisu pronađeni u DOM-u!");
        return;
    }

    // DUGME
    uploadButton.addEventListener('click', function (e) {
        e.preventDefault();

        if (!validateFields()) {
            alert("Molimo Vas doktore da popunite sva polja!");
            return;
        }

        // FORMIRANJE PODATAKA
        const terapija = {
            terapija_id: Math.floor(Math.random() * 100000), // ili prepusti backendu
            vrsta: therapy.value,
            doza_i_uputa: directions.value,
            trajanje: duration.value,
            kontrola: control.value,
            doktor_id: 1,       // zamijeni pravim ID-om
            pregledi_id: 1      // zamijeni pravim ID-om
        };

        // AJAX POZIV
        $.ajax({
            url: "http://localhost/sdp/therapy/add", // PROMIJENI ako ti je druga ruta
            method: "POST",
            contentType: "application/json",
            data: JSON.stringify(terapija),
            success: function (response) {
                console.log("Uspješno dodano:", response);
                addToTable(terapija);
                resetFields();
                alert("Terapija je uspješno dodana!");
            },
            error: function (xhr, status, error) {
                console.error("Greška:", xhr.responseText);
                alert("Greška pri dodavanju terapije!");
            }
        });
    });

    // DODAVANJE REDA U TABLICU
    function addToTable(item) {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.vrsta}</td>
            <td>${item.doza_i_uputa}</td>
            <td>${item.trajanje}</td>
            <td>${item.kontrola}</td>
            <td>${doctor.value}</td>
            <td><button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Obriši</button></td>
        `;
        tableBody.appendChild(row);
    }

    // VALIDACIJA
    function validateFields() {
        return [therapy, directions, duration, control, doctor]
            .every(input => input.value.trim() !== '');
    }

    // RESET POLJA
    function resetFields() {
        [therapy, directions, duration, control, doctor]
            .forEach(input => input.value = '');
    }

    // BRISANJE
    window.deleteRow = function (btn) {
        btn.closest('tr').remove();
    };
});
