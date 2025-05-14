document.addEventListener("DOMContentLoaded", function () {
    const serviceSelect = document.getElementById("service-select");
    const formContainers = document.querySelectorAll(".form-container");
    const forms = document.querySelectorAll("form");
    const pageTitle = document.getElementById("page-title");
    const serviceContainer = document.getElementById("services-container");
    const newOrderMessage = document.getElementById("newOrderMessage");
    const newOrderBtn = document.getElementById("newOrderBtn");

    // Mapear parámetros de servicio a valores del select
    const serviceMap = {
        "process": "service1",
        "efiling": "service2",
        "courtservices": "service3",
        "investigations": "service4",
        "courtreporting": "service5",
        "subpoenaservices": "service6"
    };

    // Obtener el parámetro 'service' de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const serviceParam = urlParams.get("service");

    // Seleccionar automáticamente la opción del select según el parámetro
    const selectedService = serviceMap[serviceParam];
    if (selectedService) {
        serviceSelect.value = selectedService;

        // Mostrar el formulario correspondiente
        formContainers.forEach(form => form.style.display = "none");
        const formToShow = document.getElementById("form" + selectedService.slice(-1));
        if (formToShow) {
            formToShow.style.display = "block";
        }
    }

    // Cambiar formulario según el select manualmente
    serviceSelect.addEventListener("change", function () {
        formContainers.forEach(form => form.style.display = "none");
        const selectedService = this.value;
        if (selectedService) {
            document.getElementById("form" + selectedService.slice(-1)).style.display = "block";
        }
    });

    // Acción al enviar el formulario
    const API_URL = "https://api.nationwidelegal.com/api/sendEmail";
    forms.forEach(form => {
        form.addEventListener("submit", function (e) {
            submitForm(form);
        });
    });

    // Acción del botón de nueva orden
    newOrderBtn.addEventListener("click", function () {
        pageTitle.style.display = "block";
        newOrderMessage.style.display = "none"; // Ocultar el mensaje de nueva orden
        serviceContainer.style.display = "flex"; // Mostrar el contenedor de servicios
        serviceSelect.selectedIndex = 0; // Resetear el selector de servicios
    });

    function buildFormHTML(formData) {
        let html = '<div style="font-family: Arial, sans-serif; line-height: 1.5;">';
    
        // Add a title
        html += `<h2>Order now</h2>`;
    
        // Start the table
        html += '<table style="border-collapse: collapse; width: 100%;">';
        html += '<thead><tr>' +
            '<th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Field</th>' +
            '<th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Value</th>' +
            '</tr></thead>';
        html += '<tbody>';
    
        // Iterate through the formData entries
        for (const [key, value] of formData.entries()) {
            // Skip empty values to clean up the output
            if (value) {
                // Adjust the key format
                let formattedKey = key
                    .replace(/(\d+)$/, '') // Remove a single trailing number
                    .replace(/ (\d+)$/, ''); // Remove a second trailing number after a space
    
                // Format the key for display
                formattedKey = formattedKey.replace(/_/g, ' ').replace(/\b\w/g, char => char.toUpperCase());
    
                // Determine the value to display for checkboxes
                let displayValue = value.startsWith('checkbox-') ? 'Yes' : 
                    (value.startsWith('deposition-officer-yes') ? 'Yes': 
                        (value.startsWith('deposition-officer-no') ? 'No': value));


                // Add a table row
                html += `<tr>` +
                    `<td style="border: 1px solid #ddd; padding: 8px;">${formattedKey}</td>` +
                    `<td style="border: 1px solid #ddd; padding: 8px;">${displayValue}</td>` +
                    `</tr>`;
            }
        }
    
        // Close the table
        html += '</tbody></table>';
    
        // Close the container
        html += '</div>';
    
        return html;
    }
    
    
    

    // Función para enviar el formulario basado en service_type
    function submitForm(form) {
        const formData = new FormData(form);
        let payload;

        // Obtener el tipo de formulario
        const serviceType = formData.get('service_type');

        // Condicional para construir el payload según el formulario
        if (serviceType === 'Service of Process') {
            payload = {
                subject: "New Contact Form Submission - Service of Process",
                body: `
                Service Type: ${formData.get('service_type')}
                Full Name (Contact Name): ${formData.get('name1')}
                Email: ${formData.get('email1')}
                Phone Number: ${formData.get('phonenumber1')}
                Company: ${formData.get('company1')}
                Address: ${formData.get('address1')}
                City: ${formData.get('city1')}
                State: ${formData.get('state1')}
                Zip: ${formData.get('zip1')}
                Party Being Served: ${formData.get('party_served1')}
                Address of Party: ${formData.get('address2_1')}
                City of Party: ${formData.get('city2_1')}
                State of Party: ${formData.get('state2_1')}
                Zip of Party: ${formData.get('zip2_1')}
                Additional Address: ${formData.get('address3_1')}
                Additional City: ${formData.get('city3_1')}
                Additional State: ${formData.get('state3_1')}
                Additional Zip: ${formData.get('zip3_1')}
                List of Documents: ${formData.get('documents1')}
                Special Instructions: ${formData.get('message1')}
            `,
            };
        } else if (serviceType === 'E-Filing') {
            payload = {
                subject: "New Contact Form Submission - E-Filing",
                body: `
                Service Type: ${formData.get('service_type')}
                Full Name (Contact Name): ${formData.get('name2')}
                Email: ${formData.get('email2')}
                Phone Number: ${formData.get('phonenumber2')}
                Company: ${formData.get('company2')}
                Address: ${formData.get('address2')}
                City: ${formData.get('city2')}
                State: ${formData.get('state2')}
                Zip: ${formData.get('zip2')}
                Court Name: ${formData.get('court-name2')}
                Case Number: ${formData.get('case-number2')}
                Case Title: ${formData.get('case-title2')}
                List of Documents: ${formData.get('documents2')}
                Special Instructions: ${formData.get('message2')}
                e-Serve: ${formData.get('eServe') ? 'Yes' : 'No'}
                Courtesy Copy Delivery: ${formData.get('courtesyCopyDelivery') ? 'Yes' : 'No'}
                Courtesy Fee Advancing: ${formData.get('courtesyFeeAdvancing') ? 'Yes' : 'No'}
            `,
            };
        } else if (serviceType === 'Court Services') {
            payload = {
                subject: "New Contact Form Submission - Court Services",
                body: `
                Service Type: ${formData.get('service_type')}
                Full Name (Contact Name): ${formData.get('name3')}
                Email: ${formData.get('email3')}
                Phone Number: ${formData.get('phonenumber3')}
                Company: ${formData.get('company3')}
                Address: ${formData.get('address3')}
                City: ${formData.get('city3')}
                State: ${formData.get('state3')}
                Zip: ${formData.get('zip3')}
                Court Name: ${formData.get('court-name3')}
                Case Number: ${formData.get('case-number3')}
                Case Title: ${formData.get('case-title3')}
                List of Documents: ${formData.get('documents3')}
                Special Instructions: ${formData.get('message3')}
                Additional Service: Counter Filing: ${formData.get('counterFiling3') ? 'Yes' : 'No'}
                Additional Service: Court Research: ${formData.get('courtResearch3') ? 'Yes' : 'No'}
                Additional Service: Courtesy Fee Advancing: ${formData.get('courtesyFeeAdvancing3') ? 'Yes' : 'No'}
            `,
            };
        } else if (serviceType === 'Investigations') {
            payload = {
                subject: "New Contact Form Submission - Investigations",
                body: `
                Service Type: ${formData.get('service_type')}
                Full Name (Contact Name): ${formData.get('name4')}
                Email: ${formData.get('email4')}
                Phone Number: ${formData.get('phonenumber4')}
                Company: ${formData.get('company4')}
                Address: ${formData.get('address4')}
                City: ${formData.get('city4')}
                State: ${formData.get('state4')}
                Zip: ${formData.get('zip4')}
                Party Being Served: ${formData.get('party_served4')}
                Address of Party: ${formData.get('address2_4')}
                City of Party: ${formData.get('city2_4')}
                State of Party: ${formData.get('state2_4')}
                Zip of Party: ${formData.get('zip2_4')}
                Additional Address: ${formData.get('address3_4')}
                Additional City: ${formData.get('city3_4')}
                Additional State: ${formData.get('state3_4')}
                Additional Zip: ${formData.get('zip3_4')}
                List of Documents: ${formData.get('documents4')}
                Special Instructions: ${formData.get('message4')}
            `,
            };
        } else if (serviceType === 'Court Reporting') {
            payload = {
                subject: "New Contact Form Submission - Court Reporting",
                body: `
                Service Type: ${formData.get('service_type')}
                Full Name (Contact Name): ${formData.get('name5')}
                Email: ${formData.get('email5')}
                Phone Number: ${formData.get('phonenumber5')}
                Company: ${formData.get('company5')}
                Address: ${formData.get('address5')}
                City: ${formData.get('city5')}
                State: ${formData.get('state5')}
                Zip: ${formData.get('zip5')}
                Party Being Served: ${formData.get('party_served5')}
                Address of Party: ${formData.get('address2_5')}
                City of Party: ${formData.get('city2_5')}
                State of Party: ${formData.get('state2_5')}
                Zip of Party: ${formData.get('zip2_5')}
                Additional Address: ${formData.get('address3_5')}
                Additional City: ${formData.get('city3_5')}
                Additional State: ${formData.get('state3_5')}
                Additional Zip: ${formData.get('zip3_5')}
                List of Documents: ${formData.get('documents5')}
                Special Instructions: ${formData.get('message5')}
            `,
            };
        } else if (serviceType === 'Subpoena Services') {
            payload = {
                subject: "New Contact Form Submission - Subpoena Services",
                body: `
                Service Type: ${formData.get('service_type')}
                Full Name (Contact Name): ${formData.get('name6')}
                Email: ${formData.get('email6')}
                Phone Number: ${formData.get('phonenumber6')}
                Company: ${formData.get('company6')}
                Address: ${formData.get('address6')}
                City: ${formData.get('city6')}
                State: ${formData.get('state6')}
                Zip: ${formData.get('zip6')}
                Party Being Served: ${formData.get('party_served6')}
                Address of Party: ${formData.get('address2_6')}
                City of Party: ${formData.get('city2_6')}
                State of Party: ${formData.get('state2_6')}
                Zip of Party: ${formData.get('zip2_6')}
                Additional Address: ${formData.get('address3_6')}
                Additional City: ${formData.get('city3_6')}
                Additional State: ${formData.get('state3_6')}
                Additional Zip: ${formData.get('zip3_6')}
                List of Documents: ${formData.get('documents6')}
                Special Instructions: ${formData.get('message6')}
                Are we acting as your Deposition Officer?: ${formData.get('depositionOfficer') === 'deposition-officer-yes' ? 'Yes' : 'No'}
            `,
            };
        }
        payload.isOrder = true;
        payload.service = 'office365'
        payload.formType = formData.get('service_type')
        payload.formData = Array.from(formData.entries()).map(([key, value]) => ({ key, value }));

        payload = {
            subject: `New Contact Form Submission - ${formData.get('service_type')}`,
            body: buildFormHTML(formData),
            isOrder: true,
            service: 'office365',
            formType: formData.get('service_type'),
            formData: Array.from(formData.entries()).map(([key, value]) => ({ key, value })),
        };

        // Enviar el payload usando fetch
        fetch(API_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        })
            .then(response => response.json())
            .then(data => {
                // console.log('Success:', data);
                serviceContainer.style.display = "none";
                pageTitle.style.display = "none";
                formContainers.forEach(form => form.style.display = "none");
                newOrderMessage.style.display = "flex";
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }

});