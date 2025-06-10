document.addEventListener("DOMContentLoaded", function () {

    function updateRange(inputMin, inputMax, displayMin, displayMax, track) {

        function updateTrack() {

            let minVal = parseInt(inputMin.value);
            let maxVal = parseInt(inputMax.value);
            let rangeMin = parseInt(inputMin.min);
            let rangeMax = parseInt(inputMax.max);

            let minPercent = ((minVal - rangeMin) / (rangeMax - rangeMin)) * 100;
            let maxPercent = ((maxVal - rangeMin) / (rangeMax - rangeMin)) * 100;

            track.style.background = `linear-gradient(to right, var(--slateGrey) ${minPercent}%, var(--softGold) ${minPercent}%, var(--softGold) ${maxPercent}%, var(--slateGrey) ${maxPercent}%)`;

            displayMin.textContent = minVal;
            displayMax.textContent = maxVal;
        }

        inputMin.addEventListener("input", function () {

            if (parseInt(inputMin.value) > parseInt(inputMax.value)) {
                inputMin.value = inputMax.value;
            }
            updateTrack();

        });

        inputMax.addEventListener("input", function () {

            if (parseInt(inputMax.value) < parseInt(inputMin.value)) {
                inputMax.value = inputMin.value;
            }
            updateTrack();

        });

        updateTrack();
    }

    let priceContainer = document.getElementById("price_min").closest(".range-container");

    updateRange(
        document.getElementById("price_min"),
        document.getElementById("price_max"),
        document.getElementById("price_min_val"),
        document.getElementById("price_max_val"),
        priceContainer.querySelector(".slider-track")
    );

    let powerContainer = document.getElementById("power_min").closest(".range-container");

    updateRange(
        document.getElementById("power_min"),
        document.getElementById("power_max"),
        document.getElementById("power_min_val"),
        document.getElementById("power_max_val"),
        powerContainer.querySelector(".slider-track")
    );

    const resetButton = document.getElementById("reset");

    resetButton.addEventListener("click", function () {
        
        document.getElementById("price_min").value = 20000;
        document.getElementById("price_max").value = 1000000;
        document.getElementById("price_min_val").textContent = "20000";
        document.getElementById("price_max_val").textContent = "1000000";
        updateRange(
            document.getElementById("price_min"),
            document.getElementById("price_max"),
            document.getElementById("price_min_val"),
            document.getElementById("price_max_val"),
            priceContainer.querySelector(".slider-track")
        );

        document.getElementById("power_min").value = 50;
        document.getElementById("power_max").value = 1000;
        document.getElementById("power_min_val").textContent = "50";
        document.getElementById("power_max_val").textContent = "1000";

        updateRange(

            document.getElementById("power_min"),
            document.getElementById("power_max"),
            document.getElementById("power_min_val"),
            document.getElementById("power_max_val"),
            powerContainer.querySelector(".slider-track")
            
        );
    });
});
