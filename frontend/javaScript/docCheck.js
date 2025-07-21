const uploadButton = document.querySelector("#uploadButton");

function validateFields() {
  const inputs = [
    document.getElementById("checks"),
    document.getElementById("meeting"),
    document.getElementById("phase"),
    document.getElementById("hospital"),
    document.getElementById("doctor"),
    document.getElementById("description"),
    document.getElementById("result"),
    document.getElementById("recommendation")
  ];

  return inputs.every(input => input.value.trim() !== "");
}

uploadButton.addEventListener('click', async e => {
    e.preventDefault();

    if (!validateFields()) {
        alert("Molimo Vas doktore da popunite sva polja!");
        return;
    }

    const data = {
        nazivPregleda: checks.value,
        datum_vrijeme: meeting.value,  // Trebalo bi formatirati u ISO format ako nije
        status: phase.value,
        opis: description.value,
        rezultati: result.value, // Ako šalješ ime fajla, OK — inače koristi FormData za upload
        odjeljenje_id: 1, // Dodaj stvarni ID odjeljenja
        doktor_id: 1,     // Dodaj stvarni ID doktora
        preporuka: recommendation.value
    };

    console.log("Šaljem pregled:", data);

    try {
        const res = await fetch('http://localhost/sdp/checks/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        if (!res.ok) throw new Error("Greška prilikom slanja pregleda");

        const resultData = await res.json();
        alert("Pregled uspješno dodat!");

        // Dodaj red u tabelu
        addingRows();

        // Očisti formu
        deleteFields();

    } catch (error) {
        console.error(error);
        alert("Došlo je do greške pri dodavanju pregleda.");
    }
});
