document.addEventListener("DOMContentLoaded", function () {

    let cars = document.querySelectorAll(".col-md-3");

    let brandFilter = document.getElementById("brand");
    let modelFilter = document.getElementById("model");
    let colorFilter = document.getElementById("color");
    let priceMinFilter = document.getElementById("price_min");
    let priceMaxFilter = document.getElementById("price_max");
    let hpMinFilter = document.getElementById("power_min");
    let hpMaxFilter = document.getElementById("power_max");
    let resetButton = document.getElementById("reset");

    function filterCars() {

        let brand = brandFilter.value;
        let model = modelFilter.value.toLowerCase();
        let color = colorFilter.value;
        let priceMin = parseInt(priceMinFilter.value);
        let priceMax = parseInt(priceMaxFilter.value);
        let hpMin = parseInt(hpMinFilter.value);
        let hpMax = parseInt(hpMaxFilter.value);

        cars.forEach(car => {

            let card = car.querySelector(".card");
            let carBrand = card.getAttribute("data-card-brand");
            let carModel = card.querySelector(".card-title").innerText.toLowerCase();
            let carColor = card.getAttribute("data-card-color");
            let carPrice = parseInt(card.getAttribute("data-card-price"));
            let carHP = parseInt(card.getAttribute("data-card-horsepower"));

            let matchBrand = brand === "Seleccione" || carBrand === brand;
            let matchModel = model === "" || carModel.includes(model);
            let matchColor = color === "Seleccione" || carColor === color;
            let matchPrice = carPrice >= priceMin && carPrice <= priceMax;
            let matchHP = carHP >= hpMin && carHP <= hpMax;

            if (matchBrand && matchModel && matchColor && matchPrice && matchHP) {
                car.style.display = "block";
            } else {
                car.style.display = "none";
            }
        });
    }

    brandFilter.addEventListener("change", filterCars);
    modelFilter.addEventListener("input", filterCars);
    colorFilter.addEventListener("change", filterCars);
    priceMinFilter.addEventListener("input", filterCars);
    priceMaxFilter.addEventListener("input", filterCars);
    hpMinFilter.addEventListener("input", filterCars);
    hpMaxFilter.addEventListener("input", filterCars);

    resetButton.addEventListener("click", function () {

        brandFilter.value = "Seleccione";
        modelFilter.value = "";
        colorFilter.value = "Seleccione";
        priceMinFilter.value = priceMinFilter.min;
        priceMaxFilter.value = priceMaxFilter.max;
        hpMinFilter.value = hpMinFilter.min;
        hpMaxFilter.value = hpMaxFilter.max;

        cars.forEach(car => car.style.display = "block");
        
    });
});
