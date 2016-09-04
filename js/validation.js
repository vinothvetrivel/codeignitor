/*
	This javascript file will used to validate the form value and element value dynamically.
	This file can be create on based on OOPS concept.
	This validation class can be accessed by creating object of the class only.

	To create object
		var <objectName> = new <className>. The object is created by default.

	To check the form data need to call 
		<objectName>.getFormData(<forname>);
	
	To check the element data need to call
		<objectName>.getElementData(<element id>);

	Rules:-
		If the data type has been different from the default behaviour. It should be mention by "data-type" in that field.
		If the validtion need to be occur for that field means. It should be mention by "data-role='MANDATORY'" in that field.
		The id and name of the field should be in camel case. Example : userName.
		The id or name of the field should be append with default alert message.
		If the specific alert message has to be show means. It should be mention by "data-alert='<message>'" in that field.
		If the length validation has be done means. It should be mention by "data-length=<value>" in that field.
		If the validation is going to be check for group element, for those elements the first element should have "data-role='MANDATORY'".
*/

/* Global Variables*/
var form = '';
var element = '';
var emptyAlert = "Please enter ";
var invalidAlert = "Invalid length in ";
var invalidEmail = "Invalid email id in ";
var invalidUserName = "Invalid ";
var invalidCheckedAlert = "Please select some option in ";
var invalidText = "Please enter only characters in ";
var invalidAlphaNumeric = "Please enter only characters or numerics in ";
var invalidMobile = "Please enter numeric only in ";
var invalidNumeric = "Please enter valid ";
var invalidAddress = "Invalid address in ";

var role = "MANDATORY";
var tempRole = "DATAMANDATORY";
var userEmail = "USEREMAIL";
var email = "EMAIL";
var alphaNumericType = "ALNUM";
var username = "USERNAME";
var characterType = "CHAR";
var mobileType = "MOBILE";
var numeric = "NUMERIC";
var pinCode = "PINCODE";
var alphabetSpace = "ALPHABETSPACE";
var addressType = "ADDRESS";
var decimalType = "DECIMAL";
var label = '';
var passwordMinLength = 5;
var emailRegex = /^([a-zA-Z0-9_\-\.])+\@([a-zA-Z0-9_\-\.]{2,20})+\.([a-zA-Z]{2,4})$/;
var alphaNumeric = /^[a-zA-Z0-9]{1,50}$/;
var userNameRegex = /^[a-z]+([a-z0-9._]*)?[a-z0-9]+$/i;
var characterRegex = /^[a-zA-Z ]*$/;
var mobileRegex = /^[0-9]{10,12}$/;
var numericRegex = /^[0-9]{1,10}$/;
var pinCodeRegex = /^([1-9])([0-9]){5}$/;
var alphabetSpaceRegex = /^[a-zA-Z ]*$/;
var addressRegex	=	/^[A-Za-z0-9\-\,\/ ]{2,40}$/i;
var decimalRegex = /^-?[0-9]\d*(\.\d+)?$/;

var validation = new validation;

/* End of Global Variables*/

function validation()
{
	this.getTitle = function(id)
	{	
		return (JSON.stringify((id.match(/[A-Z]?[a-z]+|[0-9]+/g))).replace(/","/g," ").replace("[\"","").replace("\"]","")).toLowerCase();
	}

	this.compare = function(id,defaultValue,type,count)
	{
		if(type=="data")
		{
			if(form.elements[count].getAttribute(id))
			{	 
				if((form.elements[count].getAttribute(id).toUpperCase())==defaultValue)
				{
					return true;
				}
				else
				{
					return false;
				}
			}	
			else
			{
				return false;
			}
		}
		else if(type=="element")
		{
			if(document.getElementById(id))
			{
				if((document.getElementById(id).value)==defaultValue)
				{
					return true
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
	}

	this.getFormData = function(formName)
	{
		form = document.getElementById(formName);
		
		for(var i=0; i<form.elements.length; i++)
		{	
			if(this.compare('data-role',role,'data',i) || this.compare('data-role',tempRole,'data',i))
			{ 	
				if(form.elements[i].type=='text' || form.elements[i].type=='hidden')
				{	
					if(this.emptyValidate(form.elements[i].value,form.elements[i].id))
					{	
						if(form.elements[i].getAttribute('data-length'))
						{
							var lengthValue = form.elements[i].getAttribute('data-length');

							if(form.elements[i].getAttribute('data-alert'))
							{	
								var msg = form.elements[i].getAttribute('data-alert');
								
								if(this.lengthValidation(form.elements[i].value,form.elements[i].id,lengthValue,msg))
								{

								}
								else
								{
									return false;
								}
							}
							else
							{	
								if(this.lengthValidation(form.elements[i].value,form.elements[i].id,lengthValue,''))
								{

								}
								else
								{
									return false;
								}
							}
						}
						
						if(this.compare('data-type',characterType,'data',i))
						{
							if(!characterRegex.test(form.elements[i].value))
							{
								if(this.textValidation(form.elements[i].value,form.elements[i].id,invalidText))
								{

								}
								else
								{
									return false;
								}
							}
						}
						if(this.compare('data-type',mobileType,'data',i))
						{
							
							if(form.elements[i].getAttribute('data-label'))
							{	
								 label = form.elements[i].getAttribute('data-label');
							}
							if(!mobileRegex.test(form.elements[i].value))
							{
								if(this.mobileValidation(form.elements[i].value,form.elements[i].id,invalidMobile,label))
								{

								}
								else
								{
									return false;
								}
							}
						}
						if(this.compare('data-type',numeric,'data',i))
						{
							if(!numericRegex.test(form.elements[i].value))
							{
								if(this.numericValidation(form.elements[i].value,form.elements[i].id,invalidMobile))
								{

								}
								else
								{
									return false;
								}
							}
						}
						if(this.compare('data-type',decimalType,'data',i))
						{
							if(!decimalRegex.test(form.elements[i].value))
							{
								if(this.decimalValidation(form.elements[i].value,form.elements[i].id,invalidMobile))
								{

								}
								else
								{
									return false;
								}
							}
						}
						if(this.compare('data-type',alphaNumericType,'data',i))
						{
							if(!alphaNumeric.test(form.elements[i].value))
							{
								if(this.alphaNumericValidation(form.elements[i].value,form.elements[i].id,invalidAlphaNumeric))
								{

								}
								else
								{
									return false;
								}
							}
						}
						if(this.compare('data-type',username,'data',i))
						{
							if(!alphaNumeric.test(form.elements[i].value) || !emailRegex.test(form.elements[i].value))
							{
								if(this.usernameValidation(form.elements[i].value,form.elements[i].id,invalidAlphaNumeric))
								{

								}
								else
								{
									return false;
								}
							}
						}
						if((this.compare('data-type',userEmail,'data',i)) || (this.compare('data-type',email,'data',i)))
						{
							if(form.elements[i].getAttribute('data-label'))
							{	
								 label = form.elements[i].getAttribute('data-label');
							}
							if(this.compare('data-type',userEmail,'data',i))
							{
								if(!userNameRegex.test(form.elements[i].value))
								{
									if(this.emailValidation(form.elements[i].value,form.elements[i].id,invalidUserName,label))
									{

									}
									else
									{
										return false;
									}
								}
							}
							else if(this.compare('data-type',email,'data',i))
							{
								if(this.emailValidation(form.elements[i].value,form.elements[i].id,'',label))
								{

								}
								else
								{
									return false;
								}
							}
						}
						if(this.compare('data-type',addressType,'data',i))
						{
							if(!addressRegex.test(form.elements[i].value))
							{
								if(this.addressValidation(form.elements[i].value,form.elements[i].id,invalidAddress))
								{

								}
								else
								{
									return false;
								}
							}
						}
					}
					else
					{
						if(!this.compare('data-role',tempRole,'data',i))
						{
							return false;
						}
					}
				}
				else if(form.elements[i].type=='password')
				{
					if(this.emptyValidate(form.elements[i].value,form.elements[i].id))
					{	
						if(form.elements[i].getAttribute('data-alert'))
						{	
							var msg = form.elements[i].getAttribute('data-alert');
							
							if(this.lengthValidation(form.elements[i].value,form.elements[i].id,passwordMinLength,msg))
							{

							}
							else
							{
								return false;
							}
						}
						else
						{	
							if(this.lengthValidation(form.elements[i].value,form.elements[i].id,passwordMinLength,''))
							{

							}
							else
							{
								return false;
							}
						}
					}
					else
					{
						return false;
					}
				}
				else if(form.elements[i].type=='file')
				{
					if(this.emptyValidate(form.elements[i].value,form.elements[i].id))
					{

					}
					else
					{
						return false;
					}
				}
				else if(form.elements[i].type=='radio' || form.elements[i].type=='checkbox')
				{	
					if(this.checkedValidation(form.elements[i].name))
					{

					}
					else
					{
						return false;
					}
				}
				else if(form.elements[i].type=='select-one')
				{	
					if(this.selectedValidation(form.elements[i].name,form.elements[i].id))
					{

					}
					else
					{
						return false;
					}
				}
				else if(form.elements[i].type=='textarea')
				{	
					if(this.emptyValidate(form.elements[i].value,form.elements[i].id))
					{

					}
					else
					{
						return false
					}
				}
			}
		}
		return true;		
	}

	this.getElementData = function(id)
	{	
		if(document.getElementById(id))
		{
			element = document.getElementById(id);
		}
		else
		{
			element = document.getElementsByName(id)[0];
		}
		
		if(element.getAttribute('data-role'))
		{
			if(element.getAttribute('data-role').toUpperCase()=="MANDATORY")
			{ 	
				if(element.type=='text')
				{	
					if(this.emptyValidate(element.value,element.id))
					{
						if(element.getAttribute('data-length'))
						{
							if(element.getAttribute('data-alert'))
							{	
								var msg = element.getAttribute('data-alert');
								var lengthValue = element.getAttribute('data-length');
								
								if(this.lengthValidation(element.value,element.id,lengthValue,msg))
								{

								}
								else
								{
									return false;
								}
							}
							else
							{	
								if(this.lengthValidation(element.value,element.id,lengthValue,''))
								{

								}
								else
								{
									return false;
								}
							}
						}
						if((this.compare('data-type',userEmail,'data',i)) || (this.compare('data-type',email,'data',i)))
						{
							if(form.elements[i].getAttribute('data-label'))
							{	
								 label = form.elements[i].getAttribute('data-label');
							}
							if(this.compare('data-type',userEmail,'data',i))
							{
								if(!userNameRegex.test(form.elements[i].value))
								{
									if(this.emailValidation(form.elements[i].value,form.elements[i].id,invalidUserName,label))
									{

									}
									else
									{
										return false;
									}
								}
							}
							else if(this.compare('data-type',email,'data',i))
							{
								if(this.emailValidation(form.elements[i].value,form.elements[i].id,'',label))
								{

								}
								else
								{
									return false;
								}
							}
						}
					}
					else
					{
						return false;
					}
				}
				else if(element.type=='password')
				{
					if(this.emptyValidate(element.value,element.id))
					{	
						if(element.getAttribute('data-alert'))
						{	
							var msg = element.getAttribute('data-alert');
							
							if(this.lengthValidation(element.value,element.id,passwordMinLength,msg))
							{

							}
							else
							{
								return false;
							}
						}
						else
						{	
							if(this.lengthValidation(element.value,element.id,passwordMinLength,''))
							{

							}
							else
							{
								return false;
							}
						}
					}
					else
					{
						return false;
					}
				}
				else if(element.type=='file')
				{
					if(this.emptyValidate(element.value,element.id))
					{

					}
					else
					{
						return false;
					}
				}
				else if(element.type=='radio' || element.type=='checkbox')
				{	
					if(this.checkedValidation(element.name))
					{

					}
					else
					{
						return false;
					}
				}
				else if(element.type=='select-one')
				{	
					if(this.selectedValidation(element.name,element.id))
					{

					}
					else
					{
						return false;
					}
				}
				else if(element.type=='textarea')
				{	
					if(this.emptyValidate(element.value,element.id))
					{

					}
					else
					{
						return false
					}
				}
			}
		}
		return true;		
	}

	this.emptyValidate = function(value,id)
	{	 
		if(value.trim()=='')
		{
			if(document.getElementById(id))
			{
				element = document.getElementById(id);
			}
			else
			{
				element = document.getElementsByName(id)[0];
			}
			
			if(element.getAttribute('data-role'))
			{	
				if(element.getAttribute('data-role').toUpperCase()=="MANDATORY")
				{	
					if(element.getAttribute('data-alert'))
					{	
						this.fieldFocus(id);
						alert(element.getAttribute('data-alert'));
					}
					else if(element.getAttribute('data-label'))
					{	
						this.fieldFocus(id);
						alert(emptyAlert+element.getAttribute('data-label'));
					}
					else
					{
						this.fieldFocus(id);
						alert(emptyAlert+this.getTitle(id));
					}
				}
			}
			return false;
		}
		else
		{
			return true;
		}
	}
	
	this.lengthValidation = function(value,id,size,msg)
	{	
		if(value.trim().length <= size)
		{
			if(msg!='')
			{
				this.fieldFocus(id);
				alert(msg);
			}
			else
			{
				this.fieldFocus(id);
				alert(invalidAlert+this.getTitle(id));
			}
			return false;
		}
		else
		{
			return true;
		}
	}
	this.textValidation = function(value,id,msg)
	{	
		if(value.trim()!='')
		{
			if(characterRegex.test(value))
			{
				return true;
			}
			else
			{
				if(msg=='')
				{
					this.fieldFocus(id);
					alert(invalidText+this.getTitle(id));
					return false;
				}
				else
				{
					this.fieldFocus(id);
					alert(msg+this.getTitle(id));
					return false;
				}
			}
		}
		else
		{
			return false;
		}
	}
	this.mobileValidation = function(value,id,msg,label)
	{	
		if(value.trim()!='')
		{
			if(mobileRegex.test(value))
			{
				return true;
			}
			else
			{
				if(label!='')
				{
					this.fieldFocus(id);
					alert(invalidMobile+label);
					return false;
				}
				else if(msg=='')
				{
					this.fieldFocus(id);
					alert(invalidMobile+this.getTitle(id));
					return false;
				}
				else
				{
					this.fieldFocus(id);
					alert(msg+this.getTitle(id));
					return false;
				}
			}
		}
		else
		{
			return false;
		}
	}
	this.numericValidation = function(value,id,msg)
	{	
		if(value.trim()!='')
		{
			if(numericRegex.test(value))
			{
				return true;
			}
			else
			{
				if(msg=='')
				{
					this.fieldFocus(id);
					alert(invalidNumeric+this.getTitle(id));
					return false;
				}
				else
				{
					this.fieldFocus(id);
					alert(msg+this.getTitle(id));
					return false;
				}
			}
		}
		else
		{
			return false;
		}
	}
	this.decimalValidation = function(value,id,msg)
	{	
		if(value.trim()!='')
		{
			if(decimalRegex.test(value))
			{
				return true;
			}
			else
			{
				if(msg=='')
				{
					this.fieldFocus(id);
					alert(invalidNumeric+this.getTitle(id));
					return false;
				}
				else
				{
					this.fieldFocus(id);
					alert(msg+this.getTitle(id));
					return false;
				}
			}
		}
		else
		{
			return false;
		}
	}
	this.alphaNumericValidation = function(value,id,msg)
	{	
		if(value.trim()!='')
		{
			if(alphaNumeric.test(value))
			{
				return true;
			}
			else
			{
				if(msg=='')
				{
					this.fieldFocus(id);
					alert(invalidAlphaNumeric+this.getTitle(id));
					return false;
				}
				else
				{
					this.fieldFocus(id);
					alert(msg+this.getTitle(id));
					return false;
				}
			}
		}
		else
		{
			return false;
		}
	}
	this.usernameValidation = function(value,id,msg)
	{	
		if(value.trim()!='')
		{
			if(alphaNumeric.test(value) || emailRegex.test(value))
			{
				return true;
			}
			else
			{
				if(msg=='')
				{
					this.fieldFocus(id);
					alert(invalidAlphaNumeric+this.getTitle(id));
					return false;
				}
				else
				{
					this.fieldFocus(id);
					alert(msg+this.getTitle(id));
					return false;
				}
			}
		}
		else
		{
			return false;
		}
	}
	this.emailValidation = function (value,id,msg,label)
	{
		if(value.trim()!='')
		{
			if(emailRegex.test(value))
			{
				return true;
			}
			else
			{
				if(label!='')
				{
					this.fieldFocus(id);
					alert(invalidUserName+label);
					return false;
				}
				else if(msg=='')
				{
					this.fieldFocus(id);
					alert(invalidEmail+this.getTitle(id));
					return false;
				}
				else
				{
					this.fieldFocus(id);
					alert(msg+this.getTitle(id));
					return false;
				}
			}
		}
		else
		{
			return false;
		}
	}
	this.addressValidation = function(value,id,msg)
	{	
		if(value.trim()!='')
		{
			if(addressRegex.test(value))
			{
				return true;
			}
			else
			{
				if(msg=='')
				{
					this.fieldFocus(id);
					alert(invalidText+this.getTitle(id));
					return false;
				}
				else
				{
					this.fieldFocus(id);
					alert(msg+this.getTitle(id));
					return false;
				}
			}
		}
		else
		{
			return false;
		}
	}

	this.checkedValidation = function(name)
	{
		if(document.getElementsByName(name))
		{	
			var radios = document.getElementsByName(name);
			var i = 0;
			var formValid = false;
			
    		while (!formValid && i < radios.length) {
        		if (radios[i].checked) formValid = true;
        		i++;     
    		}
    		if (!formValid)
    		{
    			if(document.getElementsByName(name)[0].getAttribute('data-alert'))
				{	
					alert(document.getElementsByName(name)[0].getAttribute('data-alert'));
				}
				else
				{
    				alert(invalidCheckedAlert+this.getTitle(name));
    			}
    		}
    		return formValid;
		}
	}

	this.selectedValidation = function(name,id)
	{	
		var selectedValue = document.getElementById(name).value;

		if(selectedValue.toUpperCase()=="SELECT" || selectedValue==0)
		{
			if(document.getElementsByName(name)[0].getAttribute('data-alert'))
			{	
				this.fieldFocus(id);
				alert(document.getElementsByName(name)[0].getAttribute('data-alert'));				
			}
			else
			{
				this.fieldFocus(id);
				alert(invalidCheckedAlert+this.getTitle(name));
			}
			
			return false;
		}
		else
		{
			return true;
		}
	}

	this.keyRestrict = function(id,e)
	{
		var obj = document.getElementById(id);

		if(obj.getAttribute('data-type').toUpperCase()=='MOBILE' || obj.getAttribute('data-type').toUpperCase()=='NUMERIC')
		{	
			var unicode=e.charCode? e.charCode : e.keyCode;
			if (unicode!=8)
			{ 									 //if the key isn't the backspace key (which we should allow)
				if (unicode<48||unicode>57) 	//if not a number
				return false 					//disable key press
			}
		}
		else if(obj.getAttribute('data-type').toUpperCase()=='CHAR')
		{	
			e = e || window.event;
			var charCode = e.which || e.keyCode;
		    var charStr = String.fromCharCode(charCode);
		    if (/\d/.test(charStr)) {
		        return false;
		    }
		}
	}

	this.fieldFocus = function(id)
	{	
		if(document.getElementById(id))
		{	
			if(form.getAttribute('data-tab'))
			{
				$('#'+form.getAttribute('data-tab')+id.replace( /^\D+/g, '')).click();
			}
			document.getElementById(id).focus();
		}
	}
}
