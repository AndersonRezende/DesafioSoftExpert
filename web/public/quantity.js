$(document).ready(function() {
    // Função para atualizar a quantidade
    function updateQuantity(productId, isIncrease) {
        const $input = $(`#inputQuantity${productId}`);
        let currentValue = parseInt($input.val());

        if (isIncrease) {
            $input.val(currentValue + 1);
        } else {
            if (currentValue > 0) {
                $input.val(currentValue - 1);
            }
        }
    }

    // Adicionar event listeners para todos os botões increase e decrease
    $('button[id^="increase"]').each(function() {
        const productId = this.id.replace('increase', '');
        $(this).on('click', function() {
            updateQuantity(productId, true);
        });
    });

    $('button[id^="decrease"]').each(function() {
        const productId = this.id.replace('decrease', '');
        $(this).on('click', function() {
            updateQuantity(productId, false);
        });
    });
});
