$(document).ready(function(){
    $('#drop').click(function(){
        quant=($('#drop').val())

        $.ajax({
            type:'POST',
            url:'cartItems/drop.php',
            data:{
                quant:quant
            },
            success:function(){
                alert('You dropped 1 Item')
            }
        })

        window.location='checkout.php'
    })

    
    $('#total').text($('#to_be_paid').val());
})