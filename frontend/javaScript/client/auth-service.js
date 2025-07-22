let AuthService = {
    init: function () {
        var token = localStorage.getItem("user_token");
        if (token && token !== undefined) {
            // window.location.replace("index.html");
        }

        // swal("Hello world!");


        let form = $("#auth-form");
        const email = $('#email').val();
        const password = $('#password').val();

        // swal("🚀 ~ email:" + email)


        console.log(form, "!!!!!!!!!!",  email, password);
        console.log("=====================================");

        if (!email || !password) {
            console.log("Fill in all fields !", "", 'error');
            return;
        }

        this.login(email, password);

    },

    login: function (email, password) {
        RestClient.requestWpromise("/backend/auth/login", "POST", {email: email, password: password})
            .done(response => {
                console.log("🚀 ~ response:", response)
                let role = response.data.role;
                localStorage.setItem("user_token", response.data.token);
                localStorage.setItem("user_id", response.data.id);

                if (role === "pacijent") {
                    window.location.replace("#homePage");
                    //swal("🚀 Role: ", role, 'success');
                } else if (role === "doktor") {
                    window.location.replace("#mainForDoc");
                } else {
                    swal("🚀 Response: " + response.error, "", 'error');
                    return;
                }
                // window.location.replace("#dashboard");
            })
            .fail(xhr => {
                console.log("🚀 ~ xhr:", xhr);
                swal("🚀 Response: " + xhr.responseJSON?.error, "", 'error');

            });
    },
    register: function (email, password, name, surname) {
        RestClient.requestWpromise("/backend/auth/register", "POST", {email: email, password: password, ime: name, prezime: surname, uloga: "pacijent"})
            .done(response => {
                console.log("🚀 ~ response:", response)
                alert(JSON.stringify(response));
                // let role = response.data.role;
                // localStorage.setItem("user_token", response.data.token);
                //
                // if (role === "admin") {
                //     window.location.replace("#dashboard");
                //     swal("🚀 Role: ", role, 'success');
                // } else if (role === "doktor") {
                //     window.location.replace("#mainForDoc");
                // } else {
                //     swal("🚀 Response: " + response.error, "", 'error');
                //     return;
                // }
                // window.location.replace("#dashboard");
            })
            .fail(xhr => {
                console.log("🚀 ~ xhr:", xhr);
                alert("🚀 Response: " + JSON.stringify(xhr));

            });
    }

}
