'use strict';

$(document).ready(() => {
    let modal;
    if (document.querySelector('.modal')) {
        modal = new bootstrap.Modal(document.querySelector('.modal'));
    }


    $('button.calendar-top-menu-button').click(e => {
        $("body").off("click", ".calendar-table-event");

        const target = e.target,
              [week, year] = e.target.dataset.date.split('-'),
              table = document.querySelector('.calendar-table-list');

        table.innerHTML = renderLoader();

        fetch('/', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({week: +week, year: +year})
        })
            .then(res => res.json())
            .then(res => {
                document.querySelector('.calendar-top-menu-button[data-type=prev]').dataset.date = res.prevDate;
                document.querySelector('.calendar-top-menu-title').textContent = res.title;
                document.querySelector('.calendar-top-menu-button[data-type=next]').dataset.date = res.nextDate;

                document.querySelector('.calendar-table-list').innerHTML = res.html;
                openModal();
            })
            .catch(() => {
                createToastItem('Произошла ошибка, повторите позже', {}, 'danger').show();
                table.innerHTML = renderText('Произошла ошибка, повторите попытку позже');
            })
    });

    const openModal = () => {
        $('.calendar-table-event').click(e => {

            fetch(`/single-event?id=${e.target.dataset.eventId}`, {
                method: 'GET',
            })
                .then(res => res.json())
                .then(({ event }) => {
                    const date = event.date.split('-').reverse().join('.');

                    document.querySelector('.modal-content-title').textContent = event.name;
                    document.querySelector('.modal-content-text').textContent = event.description;
                    document.querySelector('.modal-content-date').innerHTML = `Дата: <span>${date}</span>`;
                    document.querySelector('.modal-form').dataset.eventId = event.event_id;

                    modal.show();
                })
                .catch(() => createToastItem('Произошла ошибка, повторите позже', {}, 'danger').show());
        });
    };

    openModal();

    $('.modal-form').submit(e => {
        e.preventDefault();
        const modalForm = document.querySelector('.modal-form');

        const form = new FormData(modalForm);

        if(!form.get('initials') || !form.get('email')) {
            alert('Введены не все данные');
            return false
        }

        fetch(`/add-client`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({'id': modalForm.dataset.eventId.trim(), initials: form.get('initials').trim(), email: form.get('email').trim()}),
        })
            .then(res => res.json())
            .then(res => {
                createToastItem('Вы успешно добавлены на событие').show();
                modal.hide();
                document.querySelector('#openModal input[id=initials]').value = '';
                document.querySelector('#openModal input[id=email]').value = '';
            })
            .catch(() => createToastItem('Произошла ошибка, повторите позже', {}, 'danger').show())

    })
});