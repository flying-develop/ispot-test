"use strict";

document.addEventListener('DOMContentLoaded', () => {
    new AddProduct();
    new DelProduct();
});

class AddProduct
{
    constructor() {
        this.form = document.querySelector('form.add-product-form');

        if (this.form) {
            this.init();
        }
    }

    init() {

        this.articul = this.form.querySelector('input[name="articul"]');
        this.name = this.form.querySelector('input[name="name"]');

        ['input', 'paste', 'change'].forEach(trigger => {
            [this.articul, this.name].forEach(input => {
                input.addEventListener(trigger, (event) => {
                    event.target.closest('input').classList.remove('is-invalid');
                });
            })
        });

        this.form.querySelector('input[name="check"]').value = 'js';
        this.form.addEventListener('submit', (event) => {
            event.preventDefault();
            this.submit();
        }, {passive: false});

    }

    submit () {
        let _this = this;
        if (!this.form.classList.contains('process') && this.validate()) {
            this.form.classList.add('process');

            const requestData = new FormData(this.form);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", '/ajax/index.php');
            xhr.responseType = 'json';
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhr.onerror = function (e) {
                _this.form.classList.remove('process');
                alert('Ошибка, попробуйте позднее');
            };
            xhr.onload = function () {
                if (this.status == 200) {
                    if (this.response.status == 'success') {
                        _this.reset();
                        _this.fillRow(this.response.row);
                    } else {
                        alert(this.response.error);
                    }
                } else {
                    alert('Ошибка, попробуйте позднее');
                }
                _this.form.classList.remove('process');
            };
            xhr.send(requestData);
        }
    }

    validate() {

        let isValid = true;

        if (!this.articul.value.trim()) {
            isValid = false;
            this.articul.classList.add('is-invalid');
        } else {
            this.articul.classList.remove('is-invalid');
        }

        if (!this.name.value.trim()) {
            isValid = false;
            this.name.classList.add('is-invalid');
        } else {
            this.name.classList.remove('is-invalid');
        }

        return isValid;

    }

    reset() {
        this.articul.value = '';
        this.articul.classList.remove('is-invalid');

        this.name.value = '';
        this.name.classList.remove('is-invalid')
    }

    fillRow(data) {
        const table = document.querySelector('table.products');

        if (table) {
            let row = '<tr data-id="' + data.id + '">';
                row += '<td class="articul">' + data.articul + '</td>';
                row += '<td class="name">' + data.name + '</td>';
                row += `<td class="action">
                    <button type="button" class="btn btn-secondary del-product" title="Удалить товар">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"></path>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"></path>
                        </svg>
                    </button>
                </td>`;
            row += '</tr>';
            table.querySelector('tbody').innerHTML += row;
        }
    }
}

class DelProduct
{
    constructor() {

        document.body.addEventListener('click', (event) => {
            if (event.target.closest('button.del-product')) {
                this.delete(event.target.closest('tr'));
            }
        }, {passive: false});

    }

    delete(product) {

        const id = product.dataset.id;
        if (!product.classList.contains('process')) {
            product.classList.add('process');

            let requestData = new FormData();
            requestData.append('action', 'del');
            requestData.append('id', id);
            requestData.append('check', 'js');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", '/ajax/index.php');
            xhr.responseType = 'json';
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhr.onerror = function (e) {
                product.classList.remove('process');
                alert('Ошибка, попробуйте позднее');
            };
            xhr.onload = function () {
                if (this.status == 200) {
                    if (this.response.status == 'success') {
                        product.remove();
                    } else {
                        alert(this.response.error);
                        product.classList.remove('process');
                    }
                } else {
                    alert('Ошибка, попробуйте позднее');
                    product.classList.remove('process');
                }
            };
            xhr.send(requestData);

        }

    }
}