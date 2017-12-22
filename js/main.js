(() => {
	myApp.mainGreeting();
	myApp.module1.saySomething('sup');

	function myFunc() {
		var theHeading = document.querySelector('h1');

		theHeading.textContent = myApp.mainMessage;
	}

	myFunc();

});