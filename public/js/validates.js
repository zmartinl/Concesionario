
export class ValidateForm {

    constructor(inputId, buttonId, errorMessageId) {

        this.input = document.getElementById(inputId);
        this.button = document.getElementById(buttonId);
        this.errorMessage = document.getElementById(errorMessageId);
        this.VALID_NAME_REGEX = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;

        this.button.disabled = true;
        this.input.addEventListener("input", () => this.validate());

    }

    validate() {

        const value = this.input.value.trim();

        if (!this.VALID_NAME_REGEX.test(value)) {

            this.input.classList.add("is-invalid");
            this.input.classList.remove("is-valid");
            this.errorMessage.textContent = "¡Solo letras y espacios! ✋";
            this.errorMessage.style.display = "block";
            this.errorMessage.style.marginTop = "0.5rem";
            this.errorMessage.style.fontSize = "1rem";
            this.errorMessage.style.fontWeight = "bold";
            this.button.disabled = true;

        } else {

            this.input.classList.remove("is-invalid");
            this.input.classList.add("is-valid");
            this.errorMessage.style.display = "none";
            this.button.disabled = false;

        }
    }
}

export class EditForm extends ValidateForm {

    constructor(inputId, buttonId, formId, editButtonsSelector, errorMessageId) {

        super(inputId, buttonId, errorMessageId);
        this.form = document.getElementById(formId);
        this.editButtons = document.querySelectorAll(editButtonsSelector);

        this.editButtons.forEach(button => {
            button.addEventListener("click", () => this.populateForm(button));
        });

        this.form.addEventListener("submit", (event) => this.handleSubmit(event));
    }

    populateForm(button) {

        const idField = document.getElementById("id");
        const editField = document.getElementById("edit");
        const colorField = document.getElementById("editColorHex");
    
        if (idField) idField.value = button.getAttribute("data-id");
        if (editField) editField.value = button.getAttribute("data-name");
        if (colorField) colorField.value = button.getAttribute("data-hex");
    
        this.button.disabled = false;
        this.validate();
    }
    

    handleSubmit(event) {

        event.preventDefault();
        
        if (this.input.classList.contains("is-invalid")) {
            return;
        }

        swal({
            title: "¿Confirmar edición?",
            text: "¿Estás seguro de que deseas modificar este dato?",
            icon: "warning",
            buttons: ["Cancelar", "Sí, actualizar"],
            dangerMode: false,
        }).then((willEdit) => {
            if (willEdit) {
                this.form.submit();
            }
        });
        
    }
}


