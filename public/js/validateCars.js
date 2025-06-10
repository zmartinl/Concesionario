export class VehicleFormValidator {
    
    constructor(formId) {
        this.form = document.getElementById(formId);
        if (!this.form) {
            console.error(`No se encontró el formulario con ID: ${formId}`);
            return;
        }

        this.brandSelect = this.form.querySelector("select[name='brand']");
        this.colorSelect = this.form.querySelector("select[name='color']");
        this.typeSelect = this.form.querySelector("select[name='type_id']");
        this.modelInput = this.form.querySelector("input[name='model']");
        this.yearInput = this.form.querySelector("input[name='year']");
        this.imageInput = this.form.querySelector("input[type='file']");
        this.cvInput = this.form.querySelector("input[name='cv']");
        this.priceInput = this.form.querySelector("input[name='price']");
        this.submitButtonAdd = this.form.querySelector(".add");
        this.submitButtonEdit = this.form.querySelector(".edit");
        
        this.VALID_NAME_REGEX = /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]+$/;
        this.VALID_YEAR_REGEX = /^(19|20)\d{2}$/;
        this.VALID_NUMBER_REGEX = /^[1-9]\d*$/;

        if (this.submitButtonAdd) {
            this.submitButtonAdd.disabled = true;
        }

        if (this.submitButtonEdit) {
            this.submitButtonEdit.disabled = false;
        }

        this.addErrorMessages();
        this.addEventListeners();
    }

    addErrorMessages() {
        this.brandError = this.createErrorElement(this.brandSelect);
        this.colorError = this.createErrorElement(this.colorSelect);
        this.typeError = this.createErrorElement(this.typeSelect);
        this.modelError = this.createErrorElement(this.modelInput);
        this.yearError = this.createErrorElement(this.yearInput);
        this.cvError = this.createErrorElement(this.cvInput);
        this.priceError = this.createErrorElement(this.priceInput);
    }

    createErrorElement(input) {

        if (!input) return null; 

        const errorElement = document.createElement("div");
        errorElement.className = "invalid-feedback";
        input.parentNode.appendChild(errorElement);
        return errorElement;
    }

    addEventListeners() {
        if (this.brandSelect) this.brandSelect.addEventListener("change", this.validateBrand.bind(this));
        if (this.colorSelect) this.colorSelect.addEventListener("change", this.validateColor.bind(this));
        if (this.typeSelect) this.typeSelect.addEventListener("change", this.validateType.bind(this));
        if (this.modelInput) this.modelInput.addEventListener("input", this.validateModel.bind(this));
        if (this.yearInput) this.yearInput.addEventListener("input", this.validateYear.bind(this));
        if (this.cvInput) this.cvInput.addEventListener("input", this.validateCV.bind(this));
        if (this.priceInput) this.priceInput.addEventListener("input", this.validatePrice.bind(this));
        if (this.imageInput) this.imageInput.addEventListener("change", this.validateForm.bind(this));
        if (this.form) this.form.addEventListener("submit", this.handleSubmit.bind(this));
    }

    validateField(input, isValid, errorMessageElement, errorMessage) {
        if (!input || !errorMessageElement) return; 

        if (!isValid) {
            input.classList.add("is-invalid");
            input.classList.remove("is-valid");
            errorMessageElement.textContent = errorMessage;
        } else {
            input.classList.remove("is-invalid");
            input.classList.add("is-valid");
            errorMessageElement.style.display = "none";
        }
    }

    validateBrand() {
        if (!this.brandSelect) return;
        const isValid = this.brandSelect.value !== "";
        this.validateField(this.brandSelect, isValid, this.brandError, "Debe seleccionar una marca. 🚗");
        this.validateForm();
    }

    validateColor() {
        if (!this.colorSelect) return;
        const isValid = this.colorSelect.value !== "";
        this.validateField(this.colorSelect, isValid, this.colorError, "Debe seleccionar un color. 🎨");
        this.validateForm();
    }

    validateType() {
        if (!this.typeSelect) return;
        const isValid = this.typeSelect.value !== "";
        this.validateField(this.typeSelect, isValid, this.typeError, "Debe seleccionar un tipo. 🚙");
        this.validateForm();
    }

    validateModel() {
        if (!this.modelInput) return;
        const isValid = this.VALID_NAME_REGEX.test(this.modelInput.value.trim());
        this.validateField(this.modelInput, isValid, this.modelError, "¡Solo letras y espacios! ✋");
        this.validateForm();
    }

    validateYear() {
        if (!this.yearInput) return;
        const isValid = this.VALID_YEAR_REGEX.test(this.yearInput.value.trim());
        this.validateField(this.yearInput, isValid, this.yearError, "Año inválido. 📅");
        this.validateForm();
    }

    validateCV() {
        if (!this.cvInput) return;
        const isValid = this.VALID_NUMBER_REGEX.test(this.cvInput.value.trim());
        this.validateField(this.cvInput, isValid, this.cvError, "CV debe ser un número positivo. 💨");
        this.validateForm();
    }

    validatePrice() {
        if (!this.priceInput) return;
        const isValid = this.VALID_NUMBER_REGEX.test(this.priceInput.value.trim());
        this.validateField(this.priceInput, isValid, this.priceError, "El precio debe ser un número positivo. 💰");
        this.validateForm();
    }

    validateImage() {
        if (!this.imageInput) return false;
        return this.imageInput.files.length > 0;
    }

    validateForm() {
        const isBrandValid = this.brandSelect ? this.brandSelect.value !== "" : true;
        const isColorValid = this.colorSelect ? this.colorSelect.value !== "" : true;
        const isTypeValid = this.typeSelect ? this.typeSelect.value !== "" : true;
        const isModelValid = this.modelInput ? this.VALID_NAME_REGEX.test(this.modelInput.value.trim()) : true;
        const isYearValid = this.yearInput ? this.VALID_YEAR_REGEX.test(this.yearInput.value.trim()) : true;
        const isCVValid = this.cvInput ? this.VALID_NUMBER_REGEX.test(this.cvInput.value.trim()) : true;
        const isPriceValid = this.priceInput ? this.VALID_NUMBER_REGEX.test(this.priceInput.value.trim()) : true;
        const isImageValid = this.validateImage();

        if (this.submitButtonAdd) {
            this.submitButtonAdd.disabled = !(isBrandValid && isColorValid && isTypeValid && isModelValid && isYearValid && isCVValid && isPriceValid && isImageValid);
        }

        if (this.submitButtonEdit) {
            this.submitButtonEdit.disabled = !(isBrandValid && isColorValid && isTypeValid && isModelValid && isYearValid && isCVValid && isPriceValid);
        }

    }

    handleSubmit(event) {
        if (this.submitButtonAdd && this.submitButtonAdd.disabled) {
            event.preventDefault();
        }
        if (this.submitButtonEdit && this.submitButtonEdit.disabled) {
            event.preventDefault();
        }
    }
}

export class AddCarFormValidator extends VehicleFormValidator {
    constructor() {
        super("vehiculoForm");
    }
}

export class EditCarFormValidator extends VehicleFormValidator {
    constructor() {
        super("editVehiculoForm");
    }

    validateImage() {
        if (!this.imageInput) return false;
        return this.imageInput.files.length > 0 || document.getElementById("main_image_preview")?.src !== '';
    }
}
