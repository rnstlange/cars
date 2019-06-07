const addCarEl = $('.add-car');
const carListEl = $('.car-list');

function addDataToTable (data) {
    for (let i in data) {
        if (data.hasOwnProperty(i)) {
            const car = data[i];
            if (!$(`#car-${car.id}`).length) {
                $('tbody').append(`
                    <tr id="car-${car.id}">
                        <td class="id">${car.id}</td>
                        <td class="full_name">${car.full_name || '-'}</td>
                        <td class="brand">${car.brand}</td>
                        <td class="model">${car.model}</td>
                        <td class="year">${car.year}</td>
                    </tr>
                `);
            }
        }
    }
}

$(document).ready(() => {

    addCarEl.css('display', 'none');

    $('.show-car-list').on('click', () => {
        addCarEl.css('display', 'none');
        carListEl.css('display', 'block');
    });
    $('.show-add-car').on('click', () => {
        carListEl.css('display', 'none');
        addCarEl.css('display', 'block');
    });

    $.ajax('/api/cars', {
        method: "GET",
        success: addDataToTable
    });

    setInterval(() => {
        $.ajax('/api/cars', {
            method: "GET",
            success: addDataToTable
        });
    }, 20000);
});