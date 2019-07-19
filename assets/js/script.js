var siteUrl = 'http://bars.mysite';

var post = function (url, data, callback) {
    var request = new XMLHttpRequest();
    request.open('POST', url, true);

    request.addEventListener('readystatechange', function () {
        if ((request.readyState === 4) && (request.status === 200)) {
            response = request.responseText;
            callback(response);
        }
    });
    var params = '';
    for (key in data) {
        params += key + '=' + encodeURIComponent(data[key]) + '&';
    }
    params = params.substring(0, params.length - 1);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(params);
};

function addProductsToProvider(providerId) {
    var select = document.getElementById('provider-' + providerId);

    var selected = [];
    for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].selected) {
            selected.push(select.options[i].value)
        }
    }

    post(siteUrl + '/provider/addProductsToProvider', {
        providerId: providerId,
        selected: JSON.stringify(selected)
    }, function (data) {
                data = JSON.parse(data);
                alert(data.msg);
    });
}

function clearProducts(providerId) {
    var select = document.getElementById('provider-' + providerId);

    for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].selected) {
            select.options[i].selected = false;
        }
    }
}

function addProvidersToProduct(productId) {
    var select = document.getElementById('product-' + productId);

    var selected = [];
    for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].selected) {
            selected.push(select.options[i].value)
        }
    }

    post(siteUrl + '/product/addProvidersToProduct', {
        productId: productId,
        selected: JSON.stringify(selected)
    }, function (data) {
        data = JSON.parse(data);
        alert(data.msg);
    });
}

function clearProviders(productId) {
    var select = document.getElementById('product-' + productId);

    for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].selected) {
            select.options[i].selected = false;
        }
    }
}

function saveSupply(supplyId) {
    var form = document.getElementById('supply-' + supplyId);

    console.log(form['product_id_' + supplyId].value);
    console.log(form['provider_id_' + supplyId].value);
    console.log(form['quantity_' + supplyId].value);
    console.log(form['customer_' + supplyId].value);

    post(siteUrl + '/supply/save', {
        supplyId: supplyId,
        productId: form['product_id_' + supplyId].value,
        providerId: form['provider_id_' + supplyId].value,
        quantity: form['quantity_' + supplyId].value,
        customer: form['customer_' + supplyId].value
    }, function (data) {
        data = JSON.parse(data);
        alert(data.msg);
    });
}

function delSupply(supplyId) {
    var form = document.getElementById('supply-' + supplyId);

    post(siteUrl + '/supply/delete', {
        supplyId: supplyId
    }, function (data) {
        data = JSON.parse(data);
        if (data.status === 'success') {
            form.remove();
        }
        alert(data.msg);
    });
}

function addSupply() {
    var form = document.form_add;

    post(siteUrl + '/supply/add', {
        productId: form.add_product.value,
        providerId: form.add_provider.value,
        quantity: form.add_quantity.value,
        customer: form.add_customer.value
    }, function (data) {
        data = JSON.parse(data);
        if (data.status === 'success') {
            var suppliesWrapper = document.querySelector('#supplies');

            var table = document.createElement('tr');
            table.innerHTML = data.data;
            suppliesWrapper.appendChild(table);
        }
        alert(data.msg);
    });
}

function searchSupplies() {
    var form = document.form_search;
    post(siteUrl + '/supply/search', {
        productId: form.search_product.value,
        providerId: form.search_provider.value,
        date: form.search_date.value,
        customer: form.search_customer.value
    }, function (data) {
        data = JSON.parse(data);
        if (data.status === 'success') {
            var suppliesWrapper = document.querySelector('#supplies');
            suppliesWrapper.innerHTML = data.data;
        }
    });
}

function clearSearch() {
    var form = document.form_search;
    form.search_product.value = '';
    form.search_provider.value = '';
    form.search_date.value = '';
    form.search_customer.value = '';
    searchSupplies();
}