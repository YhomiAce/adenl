 $(document).ready(function(){
	
	
	$('#package').on('change',e=>{
		if($('#package').val() === "Single Application"){
			$('#single_plan').show()
			$('#family_plan').hide()
		}
		if($('#package').val() === "Family Application"){
			$('#family_plan').show()
			$('#single_plan').hide()
			
		}
		console.log($('#package').val());
		
	})
	
	

	$('#invoice_btn').click(e=>{
		
		if($('#invoice-form')[0].checkValidity()){
			e.preventDefault();
			let planPrice 
			if($('#package').val() === "Single Application"){
				planPrice = 'N57,500.00';
			}
			if($('#package').val() === "Family Application"){
				planPrice = 'N96,000.00';
			}
			$.ajax({
				url:"sendEmail.php",
				method: "post",
				data: $('#invoice-form').serialize()+`&action=send_invoice&price=${planPrice}`,
				success: res =>{
					console.log(res);
					if(res === "success"){
						swal.fire({
						title:'Invoice Sent Successfully',
						icon:"success"	
						}).then(function(){
							window.location.reload(false)
						})
					}else{
						$('#errorMsg').text(res)
					}
					
				}
			})
		}
		
	})

	
});	


 