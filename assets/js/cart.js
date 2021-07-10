blocks = {
    shoppingCartTable: $('.table-cart'),
 };

$(document).on('ready resize', function(){
    if (blocks.shoppingCartTable.length) {
        cartTableDetach();
    };
});

function cartTableDetach() {
    var desctopQuantity = blocks.shoppingCartTable.find(".detach-quantity-desctope"),
        mobileQuantity = blocks.shoppingCartTable.find(".detach-quantity-mobile");

        if (desctopQuantity.length &&  mobileQuantity.parent().css('display') === 'block'){
            $.each(desctopQuantity, function(index, element){
                var quantityObj = $(element).find('.input').detach().get(0);
                if(quantityObj == undefined || quantityObj == null) return false;
                mobileQuantity[index].prepend(quantityObj);
            });

        } else if(mobileQuantity.length && mobileQuantity.parent().css('display') === 'none'){
            $.each(mobileQuantity, function(index, element){
                var quantityObj = $(element).find('.input').detach().get(0);
                if(quantityObj == undefined || quantityObj == null) return false;
                desctopQuantity[index].prepend(quantityObj);
            });
        };
};