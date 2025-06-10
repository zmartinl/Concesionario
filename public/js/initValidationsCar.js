import { AddCarFormValidator, EditCarFormValidator } from "./validateCars.js";

document.addEventListener("DOMContentLoaded", function () {
    new AddCarFormValidator();
    new EditCarFormValidator();
});
