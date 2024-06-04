document.addEventListener("DOMContentLoaded", function () {
	const checkboxes = document.querySelectorAll(".form-check-input");

	checkboxes.forEach(function (checkbox) {
		checkbox.addEventListener("change", function () {
			toggleServiceState(checkbox);
		});
	});
});

function toggleServiceState(checkbox) {
	const select = checkbox.parentNode.parentNode.querySelector("select");
	select.disabled = !checkbox.checked;
}
