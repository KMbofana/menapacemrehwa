$(document).ready(function(){
    token=$('#token').val()
    
    cartItems=$('#cart_items')
        nA=0
        ni1 = 0
        ni2 = 0
        ni3 = 0
        ni4 = 0
        ni5 = 0
    $('#afritech').click(function(){
        nA +=1
        cartItA=parseInt($('#cart_items').text())+1
        cartItems.text(cartItA)
        cartItems.val(afritech)
        console.log(token)
        

        productName=$('#prodName').text()
        quantity=nA
        price=$('#afritech-price').text()

        // console.log(productName,quantity,price)
        
        // cart values should be product names which will be shown when the client wants to view cart
        // for example cartItem.text($('#product_name').text())
        $.ajax({
            type:'POST',
            url:'cartItems/cart.php',
            data:{
                productName:productName,
                Quantity: quantity,
                Price:price,
                token:token
            },
           success: function(data){
               if(!data.success){
                   alert('Added To cart')
               }

           }
        }
        )  
        
    
    })

$('#synerji').click(function(){
    ni1 +=1
    cartIt=parseInt($('#cart_items').text())+1
    $('#cart_items').text(cartIt)

    prodSyn=$('#syn').text()
    synQuant=ni1
    synPrice=$('#mppt').text()

    $.ajax({
        type:'POST',
        url:'cartItems/cart.php',
        data:{
            prodSyn:prodSyn,
            synQuant:synQuant,
            synPrice:synPrice,
            token:token
        },
        success:function(){
            alert(synQuant+ ' added to cart')
        }
    })

})

$('#charge').click(function(){
    ni2 +=1
    cartItC=parseInt($('#cart_items').text())+1
    $('#cart_items').text(cartItC)

    chargeProd=$('#chargeC').text()
    chargeQuant=ni2
    chargePrice=$('#controllers').text()

    $.ajax({
        type:'POST',
        url:'cartItems/cart.php',
        data:{
            chargeProd:chargeProd,
            chargeQuant:chargeQuant,
            chargePrice:chargePrice,
            token:token
        },
        success:function(){
            alert(ni2 + ' added to cart')
        }
    })


})


$('#solar').click(function(){
    ni3 +=1
    cartItS=parseInt($('#cart_items').text())+1
    $('#cart_items').text(cartItS)

    solarProd = $('#panelName').text()
    solarQuant = ni3
    solarPrice = $('#panels').text()

    $.ajax({
        type:'POST',
        url:'cartItems/cart.php',
        data:{
            solarProd:solarProd,
            solarQuant:solarQuant,
            solarPrice:solarPrice,
            token:token
        },
        success: function(){
            alert(ni3 + ' added to cart')
        }
    })

})


})