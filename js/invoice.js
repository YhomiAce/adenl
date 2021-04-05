 $(document).ready(function(){
	
	
	$('#package').on('change',e=>{
		if($('#package').val() === "Single Plan"){
			$('#single_plan').show()
			$('#family_plan').hide()
		}
		if($('#package').val() === "Family Plan"){
			$('#family_plan').show()
			$('#single_plan').hide()
			
		}
		console.log($('#package').val());
		
	})
	
	

	$('#invoice_btn').click(e=>{
		
		if($('#invoice-form')[0].checkValidity()){
			e.preventDefault();
			let planPrice 
			if($('#package').val() === "Single Plan"){
				planPrice = 5000;
			}
			if($('#package').val() === "Family Plan"){
				planPrice = 50000;
			}
			$.ajax({
				url:"sendEmail.php",
				method: "post",
				data: $('#invoice-form').serialize()+`&action=send_invoice&price=${planPrice}`,
				success: res =>{
					console.log(res);
				}
			})
		}
		
	})
});	


 