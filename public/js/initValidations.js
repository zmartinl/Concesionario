
import { ValidateForm, EditForm } from "./validates.js";

document.addEventListener("DOMContentLoaded", function () {
    new ValidateForm("input", "sendButton", "errorInput");
    new EditForm("edit", "sendEdit", "editForm", ".editBtn", "errorEdit");
});

