document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('.btn-delete').forEach(button => {
        
        button.addEventListener('click', function (e) {
            const taskId = this.getAttribute('data-car-id');

            swal({
                title: "Are you sure?",
                text: "This action cannot be undone.",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "Cancel",
                        value: null,
                        visible: true,
                        className: "btn-cancel",
                        closeModal: true
                    },
                    confirm: {
                        text: "Yes, delete it!",
                        value: true,
                        visible: true,
                        className: "btn-confirm",
                        closeModal: true
                    }
                },
            }).then(function (result) {

                if (result) {
                    window.location.href = '/deleteCar/' + taskId;
                }

            });
        });
    });

    const buttonAddImage = document.querySelector(".input-group-text:last-child");
    const fileContainer = buttonAddImage.closest(".mb-3").querySelector(".input-group");

    buttonAddImage.addEventListener("click", function () {

        const newInputGroup = document.createElement("div");
        newInputGroup.classList.add("input-group", "mt-2");

        const newFileInput = document.createElement("input");
        newFileInput.type = "file";
        newFileInput.classList.add("form-control");
        newFileInput.name = "secondary_images[]";
        newFileInput.accept = "image/*";

        const deleteButton = document.createElement("button");
        deleteButton.classList.add("input-group-text", "btn", "btn-danger");
        deleteButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 14a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -14" /><path d="M9 7l1 -3h4l1 3" /></svg>`;

        deleteButton.addEventListener("click", function () {
            newInputGroup.remove();
        });

        newInputGroup.appendChild(newFileInput);
        newInputGroup.appendChild(deleteButton);

        fileContainer.appendChild(newInputGroup);
    });

    if (document.getElementById('year')) {

        flatpickr("#year", {
            enableTime: false,
            dateFormat: "Y",    
            minDate: "1800-01-01",
            maxDate: new Date(),
            allowInput: false,  
            disableMobile: true, 
            clickOpens: true,    
            locale: "es",  
            mode: "single",      
            monthSelectorType: "static", 
            yearSelector: true  
        });

    } else {

        console.log("Elemento year no encontrado");

    }
    
    
});

$(document).ready(function() {

    $('.edit-button').click(function() {

        var carId = $(this).data('id');
        $('#car_id').val(carId);

        $.ajax({

            url: '/adminpanel/cars/' + carId,
            type: 'GET',
            success: function(car) {

                $('#modelo').val(car.name);
                $('#description').val(car.description);
                $('#brand').val(car.brand_id);
                $('#color').val(car.color_id);
                $('#type_id').val(car.type_id);

                $('#main_image_preview').attr('src', '/img/' + car.main_image);

                $('#secondary_images_container').empty();
                if (car.images && car.images.length > 0) {
                    car.images.forEach(function(image) {
                        $('#secondary_images_container').append(
                            '<div class="col-6 mb-3 position-relative text-center">' +
                            '   <div class="secondaryImageContainer"">' +
                            '       <img src="/img/' + image.image + '" class="img-fluid" alt="Imagen Secundaria">' +
                            '   </div>' +
                            '   <button type="button" class="btn btn-danger remove-image mt-2" data-image-id="' + image.id + '">Eliminar</button>' +
                            '   <input type="file" class="form-control mt-2 replace-image" data-image-id="' + image.id + '" accept="image/*" name="secondary_images[' + image.id + ']">' +
                            '</div>'
                        );
                    });
                }

                $('#precioRangeEdit').val(car.price);
                $('#precioOutputEdit').text(car.price + '€');
                $('#potenciaRangeEdit').val(car.horse_power);
                $('#potenciaOutputEdit').text(car.horse_power + 'CV');
                $('#enOfertaEdit').prop('checked', car.sale);

                $('.edityear').val(car.year);

                if (!$(".edityear").data("flatpickr")) {
                    flatpickr(".edityear", {
                        enableTime: false,
                        dateFormat: "Y", 
                        minDate: "1901-01-01",
                        maxDate: new Date(),
                        allowInput: false, 
                        disableMobile: true,
                        clickOpens: true,
                        locale: "es",
                        mode: "single",
                        monthSelectorType: "static",
                        yearSelector: true 
                    });
                }

                var flatpickrInstance = $(".edityear").data("flatpickr");
                if (flatpickrInstance) {
                    flatpickrInstance.setDate(car.year);
                }

                $('#car_id').val(carId);
                $('#deleted_images').val('');

            },
            error: function(error) {

                console.error('Error al cargar los datos del coche:', error);

            }
        });
    });

    $(document).on('click', '#addImageButton', function() {
        console.log('Botón "+" clickeado.');

        var newInputGroup = $('<div class="col-6 mb-3">' +
            '<input type="file" class="form-control" accept="image/*" name="secondary_images[]">' +
            '<button type="button" class="btn btn-danger remove-image">Eliminar</button>' +
            '</div>');
        $('#secondary_images_container').append(newInputGroup);
    });

    $(document).on('click', '.remove-image', function() {
        var imageId = $(this).data('image-id');
        if (imageId) {
            var deletedImages = $('#deleted_images').val();
            $('#deleted_images').val(deletedImages + (deletedImages ? ',' : '') + imageId);
        }
        $(this).closest('.col-6').remove();
    });
});