<template>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Example Componenttest123456</div>

				<div class="panel-body">
					I'm an example component!123
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
$("#test").on("click",function(){
			
				$.ajax({
				   type: 'POST',                     
				   url: "/status", 
				   cache: false,  
				   dataType : 'text',
				   success: function(data){  
	
				  $('#test1').val(data);			  	
				   },
				    error: function(xhr, status, error){
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
				   },
			   });
			});	
</script>
