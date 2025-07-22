let UserService = {
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

    getPatients: function () {
        RestClient.requestWpromise("/backend/users/patients", "GET")
            .done(response => {
                console.log("🚀 ~ response:", response)


                const $select = $("#patients");

                // Clear existing options (except placeholder)
                $select.find("option:not([disabled])").remove();

                // Add new options
                response.forEach(user => {
                    $select.append(`<option value="${user.id}">${user.ime} ${user.prezime}</option>`);
                });

                // Show the select (remove d-none)
                $select.removeClass("d-none");

                // window.location.replace("#dashboard");
            })
            .fail(xhr => {
                console.log("🚀 ~ xhr:", xhr);
                swal("🚀 Response: " + JSON.stringify(xhr));

            });
    }

}
