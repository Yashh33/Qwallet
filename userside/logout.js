 document.getElementById("logout-link").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default behavior of the anchor tag

    Swal.fire({
      title: "Logout",
      text: "Are you sure you want to logout?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Logout",
      cancelButtonText: "Cancel"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = event.target.href; // Redirect to logout.php
      }
    });
  });
