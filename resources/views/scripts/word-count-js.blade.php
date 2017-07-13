<script type="text/javascript">
	function wordCount( val ){
	    var wom = val.match(/\S+/g);
	    return {
	        words : wom ? wom.length : 0,
	    };
	}
    jQuery(document).ready(function($) {
    	jQuery('.word-count label').append(" <span># Palabras Escritas: 0</span>");
    	jQuery('.word-count textarea').trigger('input');
    });

 	jQuery('.word-count textarea').on('input',function(e){
     	var v = wordCount( this.value );
	  	jQuery(this).parent().find('label span').html("# Palabras Escritas: "+ v.words);
    });
</script>