// Run when DOM is fully loaded
document.addEventListener("DOMContentLoaded", () => {
  /* Confirm user deletion */
  const deleteLinks = document.querySelectorAll(".delete-user");
  deleteLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      if (!confirm("Are you sure you want to delete this user?")) {
        e.preventDefault();
      }
    });
  });

  /* Basic form validation */
  const forms = document.querySelectorAll("form");
  forms.forEach((form) => {
    form.addEventListener("submit", (e) => {
      const requiredFields = form.querySelectorAll("[required]");
      let valid = true;

      requiredFields.forEach((field) => {
        if (!field.value.trim()) {
          field.style.border = "2px solid red";
          valid = false;
        } else {
          field.style.border = "";
        }
      });

      if (!valid) {
        e.preventDefault();
        alert("Please fill in all required fields.");
      }
    });
  });
});
