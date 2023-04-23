<section>
    <article>
        <div id="smart-button-container">
            <div style="text-align: center;">
                <div id="paypal-button-container"></div>
            </div>
        </div>
        <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=EUR" data-sdk-integration-source="button-factory"></script>
        <script>
            function initPayPalButton() {
                paypal.Buttons({
                    style: {
                        shape: 'pill',
                        color: 'gold',
                        layout: 'horizontal',
                        label: 'paypal',

                    },

                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                "description": "Description de l'objet unique prix fixe",
                                "amount": {
                                    "currency_code": "EUR",
                                    "value": 3.6,
                                    "breakdown": {
                                        "item_total": {
                                            "currency_code": "EUR",
                                            "value": 3
                                        },
                                        "shipping": {
                                            "currency_code": "EUR",
                                            "value": 0
                                        },
                                        "tax_total": {
                                            "currency_code": "EUR",
                                            "value": 0.6
                                        }
                                    }
                                }
                            }]
                        });
                    },

                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(orderData) {

                            // Full available details
                            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                            // Show a success message within this page, e.g.
                            const element = document.getElementById('paypal-button-container');
                            element.innerHTML = '';
                            element.innerHTML = '<h3>Thank you for your payment!</h3>';

                            // Or go to another URL:  actions.redirect('thank_you.html');

                        });
                    },

                    onError: function(err) {
                        console.log(err);
                    }
                }).render('#paypal-button-container');
            }
            initPayPalButton();
        </script>
    </article>

</section>

<hr>
<h1>2ieme bouton</h1>


<section>
    <div id="smart-button-container">
        <div style="text-align: center"><label for="description">Champ de description </label><input type="text" name="descriptionInput" id="description" maxlength="127" value=""></div>
        <p id="descriptionError" style="visibility: hidden; color:red; text-align: center;">Please enter a description</p>
        <div style="text-align: center"><label for="amount">Champ montant </label><input name="amountInput" type="number" id="amount" value=""><span> EUR</span></div>
        <p id="priceLabelError" style="visibility: hidden; color:red; text-align: center;">Please enter a price</p>
        <div id="invoiceidDiv" style="text-align: center; display: none;"><label for="invoiceid"> </label><input name="invoiceid" maxlength="127" type="text" id="invoiceid" value=""></div>
        <p id="invoiceidError" style="visibility: hidden; color:red; text-align: center;">Please enter an Invoice ID</p>
        <div style="text-align: center; margin-top: 0.625rem;" id="paypal-button-container"></div>
    </div>
    <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=EUR" data-sdk-integration-source="button-factory"></script>
    <script>
        function initPayPalButton() {
            var description = document.querySelector('#smart-button-container #description');
            var amount = document.querySelector('#smart-button-container #amount');
            var descriptionError = document.querySelector('#smart-button-container #descriptionError');
            var priceError = document.querySelector('#smart-button-container #priceLabelError');
            var invoiceid = document.querySelector('#smart-button-container #invoiceid');
            var invoiceidError = document.querySelector('#smart-button-container #invoiceidError');
            var invoiceidDiv = document.querySelector('#smart-button-container #invoiceidDiv');

            var elArr = [description, amount];

            if (invoiceidDiv.firstChild.innerHTML.length > 1) {
                invoiceidDiv.style.display = "block";
            }

            var purchase_units = [];
            purchase_units[0] = {};
            purchase_units[0].amount = {};

            function validate(event) {
                return event.value.length > 0;
            }

            paypal.Buttons({
                style: {
                    color: 'gold',
                    shape: 'pill',
                    label: 'paypal',
                    layout: 'vertical',

                },

                onInit: function(data, actions) {
                    actions.disable();

                    if (invoiceidDiv.style.display === "block") {
                        elArr.push(invoiceid);
                    }

                    elArr.forEach(function(item) {
                        item.addEventListener('keyup', function(event) {
                            var result = elArr.every(validate);
                            if (result) {
                                actions.enable();
                            } else {
                                actions.disable();
                            }
                        });
                    });
                },

                onClick: function() {
                    if (description.value.length < 1) {
                        descriptionError.style.visibility = "visible";
                    } else {
                        descriptionError.style.visibility = "hidden";
                    }

                    if (amount.value.length < 1) {
                        priceError.style.visibility = "visible";
                    } else {
                        priceError.style.visibility = "hidden";
                    }

                    if (invoiceid.value.length < 1 && invoiceidDiv.style.display === "block") {
                        invoiceidError.style.visibility = "visible";
                    } else {
                        invoiceidError.style.visibility = "hidden";
                    }

                    purchase_units[0].description = description.value;
                    purchase_units[0].amount.value = amount.value;

                    if (invoiceid.value !== '') {
                        purchase_units[0].invoice_id = invoiceid.value;
                    }
                },

                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: purchase_units,
                    });
                },

                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {

                        // Full available details
                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                        // Show a success message within this page, e.g.
                        const element = document.getElementById('paypal-button-container');
                        element.innerHTML = '';
                        element.innerHTML = '<h3>Thank you for your payment!</h3>';

                        // Or go to another URL:  actions.redirect('thank_you.html');

                    });
                },

                onError: function(err) {
                    console.log(err);
                }
            }).render('#paypal-button-container');
        }
        initPayPalButton();
    </script>

</section>

<hr>
<h1>bouton 3</h1>

<section>
<div id="smart-button-container">
      <div style="text-align: center;">
        <div style="margin-bottom: 1.25rem;">
          <p>Description de l'objet</p>
          <select id="item-options"><option value="prix unitaire" price="7.30">prix unitaire - 7.30 EUR</option><option value="prix menu" price="9">prix menu - 9 EUR</option></select>
          <select style="visibility: hidden" id="quantitySelect"></select>
        </div>
      <div id="paypal-button-container"></div>
      </div>
    </div>
    <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=EUR" data-sdk-integration-source="button-factory"></script>
    <script>
      function initPayPalButton() {
        var shipping = 0;
        var itemOptions = document.querySelector("#smart-button-container #item-options");
    var quantity = parseInt();
    var quantitySelect = document.querySelector("#smart-button-container #quantitySelect");
    if (!isNaN(quantity)) {
      quantitySelect.style.visibility = "visible";
    }
    var orderDescription = 'Description de l\'objet';
    if(orderDescription === '') {
      orderDescription = 'Item';
    }
    paypal.Buttons({
      style: {
        shape: 'pill',
        color: 'gold',
        layout: 'horizontal',
        label: 'paypal',
        
      },
      createOrder: function(data, actions) {
        var selectedItemDescription = itemOptions.options[itemOptions.selectedIndex].value;
        var selectedItemPrice = parseFloat(itemOptions.options[itemOptions.selectedIndex].getAttribute("price"));
        var tax = (20 === 0 || false) ? 0 : (selectedItemPrice * (parseFloat(20)/100));
        if(quantitySelect.options.length > 0) {
          quantity = parseInt(quantitySelect.options[quantitySelect.selectedIndex].value);
        } else {
          quantity = 1;
        }

        tax *= quantity;
        tax = Math.round(tax * 100) / 100;
        var priceTotal = quantity * selectedItemPrice + parseFloat(shipping) + tax;
        priceTotal = Math.round(priceTotal * 100) / 100;
        var itemTotalValue = Math.round((selectedItemPrice * quantity) * 100) / 100;

        return actions.order.create({
          purchase_units: [{
            description: orderDescription,
            amount: {
              currency_code: 'EUR',
              value: priceTotal,
              breakdown: {
                item_total: {
                  currency_code: 'EUR',
                  value: itemTotalValue,
                },
                shipping: {
                  currency_code: 'EUR',
                  value: shipping,
                },
                tax_total: {
                  currency_code: 'EUR',
                  value: tax,
                }
              }
            },
            items: [{
              name: selectedItemDescription,
              unit_amount: {
                currency_code: 'EUR',
                value: selectedItemPrice,
              },
              quantity: quantity
            }]
          }]
        });
      },
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(orderData) {
          
          // Full available details
          console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

          // Show a success message within this page, e.g.
          const element = document.getElementById('paypal-button-container');
          element.innerHTML = '';
          element.innerHTML = '<h3>Thank you for your payment!</h3>';

          // Or go to another URL:  actions.redirect('thank_you.html');

        });
      },
      onError: function(err) {
        console.log(err);
      },
    }).render('#paypal-button-container');
  }
  initPayPalButton();
    </script>
</section>