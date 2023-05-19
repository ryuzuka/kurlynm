var eduAdd = 1;
var refAdd = 1;
var empAdd = 1;
var skillAdd = 1;

var employeeAdd = 1;
var chkFlag = "N"

$(document).ready(function() {
	// Staff Application - Form check
	$('#staff-app .btnNext').click(function(){
		no = $(this).data('no');

if(chkFlag == "Y") {
		var obj1; var obj2; var obj3; var obj4;

			obj1 = $('#name_last'); obj2 = $('#name_first');
			if (obj1.val() == "" || obj2.val() == "") {
				modalAlert("Please Enter First and Last Name.");
				return;
			}

			obj1 = $('#address'); obj2 = $('#city'); obj3 = $('#state'); obj4 = $('#zipcode');
			if (obj1.val() == "" || obj2.val() == "" || obj3.val() == "" || obj4.val() == "") {
				modalAlert("Please Enter Address information.");
				return;
			}
                        
                        obj1 = $('#phone');
			if (obj1.val() == "") {
				modalAlert("Please Enter Phone Number.");
				return;
			}
                        
                        obj1 = $('#email');
			if (obj1.val() == "") {
				modalAlert("Please Enter E-mail.");
				return;
			}
                        
                        obj1 = $('#position');
			if (obj1.val() == "" || obj1.val() == "0") {
				modalAlert("Please Enter Position.");
				return;
			}
                        
                        obj1 = $('#avail_date');
			if (obj1.val() == "") {
				modalAlert("Please Enter Date Available.");
				return;
			}
                        
                        obj1 = $('#ssn');
			if (obj1.val() == "") {
				modalAlert("Please Enter SSN.");
				return;
			}
                        
                        obj1 = $('#desired_salary');
			if (obj1.val() == "") {
				modalAlert("Please Enter Desired Salary.");
				return;
			}
                        
                        obj1 = $('#is_driver'); obj2 = $('#driver_no');
			if (obj1.val() == "Y" && obj2.val() == "") {
				modalAlert("Please Enter Driver's License Number.");
				return;
			}
                        
                        obj1 = $('#is_criminal_record'); obj2 = $('#criminal_explain');
			if (obj1.val() == "Y" && obj2.val() == "") {
				modalAlert("If convicted, please explain.");
				return;
			}
                        
}

		nextNo = no + 1;
/*

*/

		$("#staff-app .app-wrap .question-0" + no).hide();
		$("#staff-app .app-wrap .question-0" + nextNo).show();

		$("#staff-app .app-wrap .app-section").removeClass("sel");
		$("#staff-app .app-wrap .section-0" + nextNo).addClass("sel");

		$("#staff-app .app-wrap .app-section .btnEdit-0" + no).show();

		if(nextNo == 6) {
			$("#staff-app .app-wrap .app-section .btnEdit-06").show();
		}
	});

	// Staff Application Edit click
	$("#staff-app .app-wrap .app-section .btnEdit input").click(function() {
		no = $(this).data('no');

		$("#staff-app .app-wrap .app-section-question").hide();
		$("#staff-app .app-wrap .question-" + no).show();

		$("#staff-app .app-wrap .app-section").removeClass("sel");
		$("#staff-app .app-wrap .section-" + no).addClass("sel");
	});

	// Staff Application Add click
	$("#staff-app .app-wrap .app-section-question .btnAdd").click(function() {
		value = $(this).data('value');

		if(value == "education" && eduAdd < 6) {
			eduAdd++;
			$("#staff-app .app-wrap .app-section-question #education-line-0" + eduAdd).show();
			$("#staff-app .app-wrap .app-section-question #education-sec-0" + eduAdd).show();
		} else if(value == "reference" && refAdd < 6) {
			refAdd++;
			$("#staff-app .app-wrap .app-section-question #reference-line-0" + refAdd).show();
			$("#staff-app .app-wrap .app-section-question #reference-sec-0" + refAdd).show();
		} else if(value == "employment" && empAdd < 6) {
			empAdd++;
			$("#staff-app .app-wrap .app-section-question #employment-line-0" + empAdd).show();
			$("#staff-app .app-wrap .app-section-question #employment-sec-0" + empAdd).show();
		} else if(value == "skill" && skillAdd < 6) {
			skillAdd++;
			$("#staff-app .app-wrap .app-section-question #skill-line-0" + skillAdd).show();
			$("#staff-app .app-wrap .app-section-question #skill-sec-0" + skillAdd).show();
		}
	});


	// SUSHIC bar Application - Form check
	$('#bar-app .btnNext').click(function(){
		no = $(this).data('no');


if(chkFlag == "Y") {
		var obj1; var obj2; var obj3; var obj4;

                obj1 = $('#name_last'); obj2 = $('#name_first');
                if (obj1.val() == "" || obj2.val() == "") {
                        modalAlert("Please Enter First or Last Name.");
                        return;
                }

                obj1 = $('#address'); obj2 = $('#city'); obj3 = $('#state'); obj4 = $('#zipcode');
                if (obj1.val() == "" || obj2.val() == "" || obj3.val() == "" || obj4.val() == "") {
                        modalAlert("Please Enter Address Information.");
                        return;
                }

                obj1 = $('#phone');
                if (obj1.val() == "") {
                        modalAlert("Please Enter Phone Number.");
                        return;
                }

                obj1 = $('#email');
                if (obj1.val() == "") {
                        modalAlert("Please Enter E-mail.");
                        return;
                }
                
                obj1 = $('#birthday');
                if (obj1.val() == "") {
                        modalAlert("Please Enter Birthday.");
                        return;
                }
                
                obj1 = $('#ssn');
                if (obj1.val() == "") {
                        modalAlert("Please Enter SSN.");
                        return;
                }
                
                obj1 = $('#is_driver'); obj2 = $('#driver_no');
                if (obj1.val() == "Y" && obj2.val() == "") {
                        modalAlert("Please Enter Driver's License Number.");
                        return;
                }

                obj1 = $('#is_criminal_record'); obj2 = $('#criminal_explain');
                if (obj1.val() == "Y" && obj2.val() == "") {
                        modalAlert("If convicted, please explain.");
                        return;
                }
}

		nextNo = no + 1;
                

		$("#bar-app .app-wrap .question-0" + no).hide();
		$("#bar-app .app-wrap .question-0" + nextNo).show();

		$("#bar-app .app-wrap .app-section").removeClass("sel");
		$("#bar-app .app-wrap .section-0" + nextNo).addClass("sel");

		$("#bar-app .app-wrap .app-section .btnEdit-0" + no).show();

		if(nextNo == 6) {
			$("#bar-app .app-wrap .app-section .btnEdit-06").show();
		}
	});

	// SUSHIC bar Application Edit click
	$("#bar-app .app-wrap .app-section .btnEdit input").click(function() {
		no = $(this).data('no');

		$("#bar-app .app-wrap .app-section-question").hide();
		$("#bar-app .app-wrap .question-" + no).show();

		$("#bar-app .app-wrap .app-section").removeClass("sel");
		$("#bar-app .app-wrap .section-" + no).addClass("sel");
            
//$("#bar-app .app-wrap .app-section .btnEdit-" + no).hide();             
	});

	// SUSHIC bar Application Add click
	$("#bar-app .app-wrap .app-section-question .btnAdd").click(function() {
		value = $(this).data('value');

		if(value == "employee" && employeeAdd < 6) {
			employeeAdd++;
			$("#bar-app .app-wrap .app-section-question #employee-line-0" + employeeAdd).show();
			$("#bar-app .app-wrap .app-section-question #employee-sec-0" + employeeAdd).show();
		} else if(value == "employment" && empAdd < 6) {
			empAdd++;
			$("#bar-app .app-wrap .app-section-question #employment-line-0" + empAdd).show();
			$("#bar-app .app-wrap .app-section-question #employment-sec-0" + empAdd).show();
		} else if(value == "reference" && refAdd < 6) {
			refAdd++;
			$("#bar-app .app-wrap .app-section-question #reference-line-0" + refAdd).show();
			$("#bar-app .app-wrap .app-section-question #reference-sec-0" + refAdd).show();
		}
	});

	// Application FAQ Category Click
	$("#app-faq .sub-section .contents .btn-wrap ul li").click(function() {
		no = $(this).index();

		if(no == 0) { 
			$("#app-faq .staff-faq").fadeIn();
			$("#app-faq .bar-faq").fadeOut();
		} else {
			$("#app-faq .staff-faq").fadeOut();
			$("#app-faq .bar-faq").fadeIn();
		}

		$("#app-faq .sub-section .contents .btn-wrap ul li").removeClass("active");
		$("#app-faq .sub-section .contents .btn-wrap ul li").eq($(this).index(no)).addClass("active");
	});
});