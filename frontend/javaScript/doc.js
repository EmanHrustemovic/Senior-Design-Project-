/*
const { query } = require("express");

const searching = document.querySelector('.search-input');

const jmbgPattern = /^\d{13}$/;

const pacijent = query("SELECT DISTINCT FROM pacijenti WHERE p.JMBG = input ;");


searching.addEventListener('click',e=>{
    e.preventDefault();

    const input = searching.value;

    if(jmbgPattern.test(input) && input.length==13){
        newTable = `<tr>
        <td>${pacijent}</td>
        </tr>`;
    }
});
*/
document.getElementById('search-btn').addEventListener('click', function (e) {
    e.preventDefault();

    const jmbg = document.getElementById('search-jmbg').value.trim();
    const infoDiv = document.getElementById('pacijent-info');
    const jmbgPattern = /^\d{13}$/;

    if (!jmbgPattern.test(jmbg)) {
        infoDiv.innerHTML = '<p style="color:red;">Unesite ispravan JMBG (13 cifara).</p>';
        return;
    }

    fetch(`http://backend.app/patient/searchByJmbg/${jmbg}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Pacijent nije pronađen.');
            }
            return response.json();
        })
        .then(data => {
            infoDiv.innerHTML = `
                <h5>Rezultat pretrage:</h5>
                <p><strong>Ime:</strong> ${data.ime}</p>
                <p><strong>Prezime:</strong> ${data.prezime}</p>
            `;
        })
        .catch(error => {
            infoDiv.innerHTML = `<p style="color:red;">Greška: ${error.message}</p>`;
        });
});