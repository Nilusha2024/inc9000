var Script = function () {

    

    $().ready(function() {
        // validate the comment form when it is submitted
        

		//Estimate validation
		$("#customerRegisterForm").validate({
            rules: {    				
                title: "required", 
                name: "required", 
                lastname: "required", 
                contact: "required", 
                conMobile: "required", 
                
                cus_rating: "required", 
                address: "required", 
                address2: "required", 
                address3: "required", 
                cuontry: "required", 
                
                cusSince: "required",
				
         						
                comName: "required",	
                comPhone: "required",	
               	
                	
                	
                comBillAdd: "required",	
                comBillAdd2: "required",	
                comBillAdd3: "required",	
                cusSince: "required",	
                cus_rating: "required",	
                cuontry: "required"					

		
            },
			
            messages: { 
                title: "Please select title",
                name: "Please type first name",
                lastname: "Please type last name",
                contact: "Please type contact number 1",
                conMobile: "Please type contact number 2",
               
                cus_rating: "Please select rating",
                address: "Please type address line 1",
                address2: "Please type address line 2",
                address3: "Please type address line 3",
                cuontry: "Please select district",
                
                cusSince: "Please select customer since",



         		                         
				comName: "Please type company name",	
                comPhone: "Please type contact number", 				
               				
                				
                			
                comBillAdd: "Please type address line 1", 				
                comBillAdd2: "Please type address line 2", 				
                comBillAdd3: "Please type address line 3", 				
                cusSince: "Please select customer since", 				
                cus_rating: "Please select rating", 				
                cuontry: "Please select district"				
                								

            }
        });
        $("#customerRegisterForm").validate();

       
		
		
		$("#greetingForm").validate({
            rules: {    				
                vSubject: "required", 
                dScheduleDate: "required", 
                dScheduleTime: "required", 
                vMessage: "required" 
            },			
            messages: { 
                vSubject: "Please type subject",
                dScheduleDate: "Please select scheduled date",
                dScheduleTime: "Please select scheduled time",
                vMessage: "Please type message" 
            }
        });
        $("#greetingForm").validate();		
		
		
		$("#annualGreetingForm").validate({
            rules: {    				
                vSubject: "required",                  
                dScheduleTime: "required", 
                vMessage: "required" 
            },			
            messages: { 
                vSubject: "Please type subject",
                dScheduleTime: "Please select scheduled time",
                vMessage: "Please type message" 
            }
        });
        $("#annualGreetingForm").validate();				
		

		
		$("#individualSMSFrom").validate({
            rules: {    				
                vTP: "required", 
                iGreetingID: "required", 
                vMessage: "required" 
                
            },			
            messages: { 
                vTP: "Please type phone number",
                iGreetingID: "Please select greeting type",
                vMessage: "Please type message" 
                 
            }
        });
        $("#individualSMSFrom").validate();			
		
		
		
		$("#bulkSMSFrom").validate({
            rules: {    				
                
                iGreetingID: "required", 
                vMessage: "required" 
                
            },			
            messages: { 
                
                iGreetingID: "Please select greeting type",
                vMessage: "Please type message" 
                 
            }
        });
        $("#bulkSMSFrom").validate();			
		
		
		     
		$("#vehicleRegisterForm").validate({
            rules: {    				
                
                vMake: "required", 
                vModel: "required", 
                vType: "required", 
                vFuel: "required", 
                chassisNo: "required", 				
                engineNo: "required",
				shipdate: "required",
				etasl: "required"
 				
            },			
            messages: { 
                
                vMake: "Please select manufacturer",
                vModel: "Please select model",
                vType: "Please select vehicle type" ,
                vFuel: "Please select fuel type" ,
                chassisNo: "Please type chassis number" ,
                engineNo: "Please type engine number",
                shipdate: "Please select ship date",
                etasl: "Please select ETASL" 				
                 
            }
        });
        $("#vehicleRegisterForm").validate();		
		
		
		
		
		$("#walkingCustomerForm").validate({
            rules: {    				
                
                customername: "required", 
                customerphone: "required" 
                
            },			
            messages: { 
                
                customername: "Please type customer name",
                customerphone: "Please type contact number" 
                 
            }
        });
        $("#walkingCustomerForm").validate();		
		
		
		
		
		$("#vehicleRegisterSubmitForm").validate({
            rules: {    				
                
                customer: "required", 
                egteno: "required" 
                
            },			
            messages: { 
                
                customer: "Please select customer",
                egteno: "Please select engine number" 
                 
            }
        });
        $("#vehicleRegisterSubmitForm").validate();		
		
	 
		
		$("#userTypeForm").validate({
            rules: {    				
                
                userType: "required" 
                
            },			
            messages: { 
                
                userType: "Please type user type"  
                 
            }
        });
        $("#userTypeForm").validate();			
		
		
		
		$("#userRegisterForm").validate({
            rules: {    				
   
                title: "required", 
                name: "required", 
                address: "required", 
                nicNo: "required", 
                branch: "required" 				
                
            },			
            messages: { 
                
                title: "Please select title" , 
                name: "Please type name" , 
                address: "Please type address" , 
                nicNo: "Please type NIC number" , 
                branch: "Please select branch"  			
                 
            }
        });
        $("#userRegisterForm").validate();		
		
       
	   
	   
	   
	   
	   
		$("#leasingCompanyRegisterForm").validate({
            rules: {    				
   
        
   
                name: "required", 
                location: "required", 
                tpNo: "required", 
                title: "required", 
				cPerson: "required", 
                cNumber: "required" 				
                
            },			
            messages: { 
                
                name: "Please type company name" , 
                location: "Please type company location" , 
                tpNo: "Please type company contact number" , 
                title: "Please select title" , 
                cPerson: "Please type contact person name",
                cNumber: "Please type contact person number"				
                 
            }
        });
        $("#leasingCompanyRegisterForm").validate();	   
	   
	   
	   
	   
	   
	   
		$("#userEditForm").validate({
            rules: {    				
               
                oldPass: {
                    required: true                    
                },
                newPass: {
                    required: true 
                },
                reNewPass: {
                    required: true,
                    equalTo: "#newPass"
                }				
				
            },			
            messages: { 
                
                oldPass: "Please type old password" , 
                newPass: "Please type new password" , 
                reNewPass: "Please enter the same password as above" 
            }
        });
        $("#userEditForm").validate();	   
	   
	   
	   
	   
	   
		$("#vehicleFeedbackForm").validate({
            rules: {    				
               
                egteno: {
                    required: true                    
                },
                cusid: {
                    required: true 
                } 			
				
            },			
            messages: { 
                
                egteno: "Please select engine number" , 
                cusid: "Customer is empty"  
            }     
        });
        $("#vehicleFeedbackForm").validate();	   
	   
	   
	   
	   
	   
	   
	   

      
    });


}();