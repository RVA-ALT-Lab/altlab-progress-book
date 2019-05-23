
if (document.querySelectorAll('.progress-assignment')){
	document.querySelectorAll('.progress-student').forEach(function(el){
	  el.addEventListener('click', function() {
	    hideStudents(this.dataset.student);
	  });
	});


	function hideStudents(theStudent){
		let names = document.querySelectorAll('.progress-student');
		names.forEach(function(student){
			console.log(student.dataset.student)
			console.log(theStudent)
			if (student.dataset.student != theStudent){
				student.parentNode.classList.toggle('hide-stu');
				
			}
		})
	}


	document.querySelectorAll('.progress-assignment').forEach(function(el){
	  el.addEventListener('click', function() {
	    hideAssign(this.dataset.assign);
	  });
	});


	function hideAssign(theAssign){
		let names = document.querySelectorAll('.progress-assignment');
		names.forEach(function(assign){		
			if (assign.dataset.assign != theAssign){
				assign.parentNode.classList.toggle('hide-assign');
				
			}
		})
	}
}