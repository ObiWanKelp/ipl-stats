document.addEventListener("DOMContentLoaded", () => {
  const loader = document.querySelector(".page-loader");

  // Hide loader instantly when page is restored or opened
  requestAnimationFrame(() => {
    loader.classList.add("hidden");
  });
});

// Show loader when clicking any internal link
document.addEventListener("click", (e) => {
  const a = e.target.closest("a");
  if (!a) return;

  // ignore links that should not trigger loader
  if (a.hasAttribute("download")) return;
  if (a.href.includes("#")) return;
  if (a.target === "_blank") return;

  const loader = document.querySelector(".page-loader");

  // SHOW loader immediately
  loader.classList.remove("hidden");
});

// Fix BACK button instantly (no cooldown)
window.addEventListener("pageshow", (e) => {
  if (e.persisted) {
    const loader = document.querySelector(".page-loader");

    // Instantly hide with *no fade delay*
    loader.style.transition = "none";
    loader.classList.add("hidden");

    // Re-enable transition for normal navigation
    setTimeout(() => {
      loader.style.transition = "";
    }, 50);
  }
});
