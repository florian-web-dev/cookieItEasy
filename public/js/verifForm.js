
let formElm = document.querySelector("form")


if (null == formElm) {
    formElm ="";
} else {
    formElm.addEventListener("submit", function (event) {

        for (const input of event.target.querySelectorAll("input,select,textarea")) {
            if (!input.checkValidity()) {
                event.preventDefault();
                if (!document.querySelector("#msg" + input.id)) {
                    input.classList.remove("is-valid");
                    input.classList.add("is-invalid");
                    let msg = document.createElement("div");
                    msg.id = `msg${input.id}`;
                    msg.classList.add('text-danger');
                    msg.innerText = input.validationMessage;
                    input.parentElement.insertBefore(msg, input);

                }
                else {
                    document.querySelector("#msg" + input.id).innerText = input.validationMessage;
                }
            }


            else {
                if (document.querySelector("#msg" + input.id)) {
                    console.log(input);
                    input.parentElement.removeChild(document.querySelector("#msg" + input.id));
                }
                input.classList.remove("is-invalid");
                input.classList.add("is-valid");
            }

        }
    })

    for (const input of document.querySelectorAll("input,select,textarea")) {
        input.addEventListener('blur', function () {
            if (!input.validity.valid) {
                if (!input.checkValidity()) {
                    input.classList.remove("is-valid");
                    input.classList.add("is-invalid");
                    if (!document.querySelector("#msg" + input.id)) {
                        let msg = document.createElement("div");
                        msg.id = `msg${input.id}`;
                        msg.classList.add('text-danger');
                        msg.innerText = input.validationMessage;
                        input.parentElement.insertBefore(msg, input);
                    } else {
                        document.querySelector("#msg" + input.id).innerText = input.validationMessage;
                    }
                }
            } else {
                if (document.querySelector("#msg" + input.id)) {
                    input.parentElement.removeChild(document.querySelector("#msg" + input.id));
                }
                input.classList.remove("is-invalid");
                input.classList.add("is-valid");
            }
        }
        )
    }
}

