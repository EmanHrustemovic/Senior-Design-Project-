document.addEventListener("DOMContentLoaded", function () {
    /* Dugmad za doktora  */
    const uploadButton = document.querySelector("#uploadButton");
    const fileInput = document.querySelector("#fileInput");
    const errorMessage = document.querySelector("#errorMessage");
    const tableBody = document.querySelector("#checkUps-for-doc");

    /* POLJA U TABLICI KOJA DR POPUNJAVA */
    const checks = document.querySelector('#checks');
    const meeting = document.querySelector('#meeting');
    const phase = document.querySelector('#phase');
    const hospital = document.querySelector('#hospital');
    const doctor = document.querySelector('#doctor');
    const description = document.querySelector('#description');
    const result = document.querySelector('#result');
    const recommendation = document.querySelector('#recommendation');

    /* Klik na dugme za dodavanje nalaza */
    if (uploadButton && fileInput) {
        uploadButton.addEventListener('click', function (e) {
            e.preventDefault();

            if (validateFields()) {
                fileInput.click();
            } else {
                alert("Molimo Vas doktore da popunite sva polja!");
            }
        });
    }

    /* Kada doktor odabere fajl */
    if (fileInput) {
        fileInput.addEventListener('change', function (e) {
            e.preventDefault();

            if (fileInput.files.length > 0) {
                addingRows();
            }
        });
    }

    /* Dodavanje novog reda u tabelu */
    function addingRows() {
        const useChecks = checks.value;
        const useMeet = meeting.value;
        const usePhase = phase.value;
        const useHospital = hospital.value;
        const yourDoctor = doctor.value;
        const useDescription = description.value;
        const useResult = result.value;
        const useRecommendation = recommendation.value;

        const file = fileInput.files[0] ? fileInput.files[0].name : '';

        const row = document.createElement('tr');

        row.innerHTML = `
            <td>${useChecks}</td>
            <td>${useMeet}</td>
            <td>${usePhase}</td>
            <td>${useHospital}</td>
            <td>${yourDoctor}</td>
            <td>${useDescription}</td>
            <td>${useResult}</td>
            <td>${useRecommendation}</td>
            <td>${file}</td>
            <td><button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Izbriši nalaz</button></td>
        `;

        tableBody.appendChild(row);
        clearFields();
    }

    /* Validacija svih input polja osim fajla */
    function validateFields() {
        return [...document.querySelectorAll("input:not([type='file'])")]
            .every(input => input.value.trim() !== "");
    }

    /* Brisanje polja nakon dodavanja */
    function clearFields() {
        document.querySelectorAll("input:not([type='file'])")
            .forEach(input => input.value = "");
    }

});

function deleteRow(button) {
    button.closest('tr').remove();
}
