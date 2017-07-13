<script type="text/javascript"> 
  $(document).ready(function() {
    $(document).on('change paste keyup', "input#exchange", function() { 
      calculateSubtotal();
      calculateTotal();
    });
    $(document).on('change paste keyup', "input[rel='international_sale_items_quantity']", function() { 
      calculateSubtotal();
      calculateTotal();
    });
    $(document).on('change paste keyup', "input[rel='international_sale_items_price']", function() { 
      calculateSubtotal();
      calculateTotal();
    });
    $(document).on('change paste keyup', "input[rel='international_sale_items_price_in_bs']", function() { 
      calculateTotal();
    });
  });
  function calculateSubtotal () {
    console.log('Recalculando');
    $("input[rel='international_sale_items_price']").each(function(){
      exchange = parseFloat($('input#exchange').val());
      price = parseFloat($(this).val());
      $quantity_item = $(this).parent().parent().find("input[rel='international_sale_items_quantity']").first();
      quantity = parseFloat($quantity_item.val());
      total = price * quantity * exchange; 
      $(this).parent().parent().find("input[rel='international_sale_items_price_in_bs']").first().val(Math.round(total));
    });
  };
  function calculateTotal () {
    console.log('Recalculando');
    total = 0;
    $("input[rel='international_sale_items_price_in_bs']").each(function(){
      total += parseFloat($(this).val());
    });
    $('input#total_price').val(Math.round(total));
  };
</script>