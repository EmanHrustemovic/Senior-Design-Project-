let ChecksService = {

    addCheck: function (naziv, opis, id) {
        RestClient.requestWpromise("/backend/checks/add", "POST", {nazivPregleda:naziv, opis:opis, pacijent_id:id})
            .done(response => {
                console.log("🚀 ~ response:", response)

                window.location.replace("#medicalCheck");
            })
            .fail(xhr => {
                console.log("🚀 ~ xhr:", xhr);
                swal("🚀 Response: " + JSON.stringify(xhr));

            });
    },

    getChecks: function () {
        RestClient.requestWpromise("/backend/checks", "GET")
            .done(response => {
                console.log("🚀 ~ response:", response);


                const $table = $("#checksTable");

                const $tbody = $table.find("tbody.lab");

                // Clear existing rows
                $tbody.empty();

                // Add new rows
                response.forEach(item => {
                    const row = `
                          <tr>
                            <td>${item.id}</td>
                            <td>${item.nazivPregleda}</td>
                            <td>${item.opis}</td>
                            <td>${item.pacijent_id}</td>
                          </tr>
                        `;
                    $tbody.append(row);
                });

                // Show the select (remove d-none)
                $table.removeClass("d-none");

            })
            .fail(xhr => {
                console.log("🚀 ~ xhr:", xhr);
                swal("🚀 Response: " + JSON.stringify(xhr));

            });
    },
    getPatientChecks: function (id) {
        RestClient.requestWpromise("/backend/checks", "GET")
            .done(response => {
                console.log("🚀 ~ response:", response);

                let patientChecks = response.filter(item => item.pacijent_id == id);
                console.log("patientChecks @@@@@@@", patientChecks);

                const $table = $("#card-table");

                const $tbody = $table.find("tbody.lab");

                // Clear existing rows
                $tbody.empty();

                // Add new rows
                patientChecks.forEach(item => {
                    const row = `
                          <tr>
                            <td>${item.id}</td>
                            <td>${item.nazivPregleda}</td>
                            <td>${item.opis}</td>
<!--                            <td>${item.pacijent_id}</td>-->
                          </tr>
                        `;
                    $tbody.append(row);
                });

                // Show the select (remove d-none)
                $table.removeClass("d-none");

            })
            .fail(xhr => {
                console.log("🚀 ~ xhr:", xhr);
                swal("🚀 Response: " + JSON.stringify(xhr));

            });
    },
}
