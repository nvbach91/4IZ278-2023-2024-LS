document.addEventListener("DOMContentLoaded", function () {
	const checkboxes = document.querySelectorAll(".form-check-input");

	checkboxes.forEach(function (checkbox) {
		checkbox.addEventListener("change", function () {
			console.log("Checkbox changed:", checkbox);
			toggleServiceState(checkbox);
		});
	});

	// Call the toggleServiceState function for each checkbox to set the initial state
	checkboxes.forEach(function (checkbox) {
		toggleServiceState(checkbox);
	});
});

function toggleServiceState(checkbox) {
	const select = checkbox.closest(".service-card").querySelector("select");
	console.log("Toggling service state:", checkbox.checked, select);
	select.disabled = !checkbox.checked;
}
