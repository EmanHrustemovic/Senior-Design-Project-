const form = document.querySelector('.code-form');
const phonePattern = /^[0-9]{3,}$/;
const idPattern = /^[0-9]{13}$/

const feedback = document.querySelector('.feedback');
const idFeedback = document.querySelector('.idFeedback');
const phoneFeedback = document.querySelector('.phoneFeedback');


form.addEventListener('submit',e=>{
    e.preventDefault();

    const id = form.id.value;
    const phone =form.phone.value;

    if(idPattern.test(id) && id.length==13 && phonePattern.test(phone)){
        feedback.textContent="Dobro Došli !!";
        idFeedback.textContent="";
        phoneFeedback.textContent="";

        setTimeout(() => {
            window.location.href = "login.html"; 
        }, 1500); 
    } else {
        if(!idPattern.test(id) || id.length !== 13){
            idFeedback.textContent="JMBG se sastoji od 13 brojeva !";
        } else {
            idFeedback.textContent="";
        }
        if(!phonePattern.test(phone)){
            phoneFeedback.textContent="Neispravan format broja.";
        } else {
            phoneFeedback.textContent="";
        }
        feedback.textContent="Žao nam je, oporavak Vaše šifre nije uspio.";
    }

});


form.id.addEventListener('keyup',e=>{
    console.log(e);
    if(idPattern.test(e.target.value)){
        form.id.setAttribute('class','success');
    }else{
        form.id.setAttribute('class','error');
    }
});

form.phone.addEventListener('keyup',e =>{
    console.log(e);
    if (phonePattern.test(e.target.value)){
        form.phone.setAttribute('class','success');
    }else{
        form.phone.setAttribute('class','error');
    }
});

/*

document.querySelector('.code-form').addEventListener('submit', function (e) {
    e.preventDefault(); // zaustavi reload

    const phoneInput = document.getElementById('phone');
    const idInput = document.getElementById('id');
    const feedback = document.querySelector('.feedback');
    const phone = phoneInput.value.trim();
    const id = idInput.value.trim();

    // Resetuj poruke
    feedback.innerHTML = '';
    phoneInput.classList.remove('is-invalid');
    idInput.classList.remove('is-invalid');

    // Validacija
    if (!phone || !id) {
        if (!id) idInput.classList.add('is-invalid');
        if (!phone) phoneInput.classList.add('is-invalid');
        feedback.innerHTML = `<div class="alert alert-danger mt-2">Molimo unesite sve podatke.</div>`;
        return;
    }

    // Pošalji POST request backendu
    fetch('http://localhost:8888/send-sms', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            phone: phone
        })
    })
    .then(res => res.json())
    .then(data => {
        console.log('Odgovor servera:', data);
        feedback.innerHTML = `<div class="alert alert-success mt-2">Kod je poslan na broj ${phone}!</div>`;
    })
    .catch(err => {
        console.error('Greška:', err);
        feedback.innerHTML = `<div class="alert alert-danger mt-2">Greška pri slanju SMS-a. Pokušajte ponovo.</div>`;
    });
});
*/