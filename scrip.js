const notificationIcon = document.querySelector(".notification-icon");
const notificationModal = document.querySelector(".notification-modal");

notificationIcon.addEventListener("click", () => {
  notificationModal.style.display = "block";
});

document.addEventListener("click", (event) => {
  if (
    !notificationModal.contains(event.target) &&
    notificationModal.style.display === "block"
  ) {
    notificationModal.style.display = "none";
  }
});
