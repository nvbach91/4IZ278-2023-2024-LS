window.onload = function () {
	var selects = document.querySelectorAll(".form-select");
	selects.forEach(function (select) {
		select.addEventListener("change", function () {
			var email = this.getAttribute("data-user-email");
			var orgId = this.getAttribute("data-org-id");
			var roleId = this.value;
			window.location.href =
				"edit-user-role.php?uid=" +
				email +
				"&oid=" +
				orgId +
				"&target=" +
				roleId;
		});
	});
};
