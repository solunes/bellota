<script type="text/javascript"> 
  $(document).ready(function() {
    $(document).on('change paste keyup', "input[rel='online_sale_items_price_in_bs']", function() { 
      calculateTotal();
    });
  });
  function calculateTotal () {
    console.log('Recalculando');
    total = 0;
    $("input[rel='online_sale_items_price_in_bs']").each(function(){
      total += parseFloat($(this).val());
    });
    $('input#total_price').val(Math.round(total));
  };
</script>