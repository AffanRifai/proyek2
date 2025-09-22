// Smooth scroll
document.querySelectorAll("nav a").forEach(link => {
  link.addEventListener("click", e => {
    e.preventDefault();
    const target = document.querySelector(link.getAttribute("href"));
    target.scrollIntoView({ behavior: "smooth" });
  });
});

// Modal
const modal = document.getElementById("modal");
const modalText = document.getElementById("modal-text");
const closeBtn = document.querySelector(".close");
const okBtn = document.querySelector(".btn-ok");

// tombol sewa mobil -> buka modal
document.querySelectorAll(".btn-sewa").forEach(btn => {
  btn.addEventListener("click", (e) => {
    const carName = e.target.closest(".car-card").querySelector("h3").innerText;
    modalText.innerText = `Anda memilih ${carName} untuk disewa.`;
    modal.style.display = "flex";
  });
});

// tombol close & ok
closeBtn.addEventListener("click", () => modal.style.display = "none");
okBtn.addEventListener("click", () => modal.style.display = "none");

// klik luar modal -> tutup
window.addEventListener("click", (e) => {
  if (e.target === modal) {
    modal.style.display = "none";
  }
});

// Tombol selengkapnya
document.getElementById("btn-selengkapnya").addEventListener("click", () => {
  alert("Menuju halaman daftar mobil selengkapnya...");
});

// Animasi scroll
const fadeElems = document.querySelectorAll(".fade-in");
window.addEventListener("scroll", () => {
  fadeElems.forEach(el => {
    const pos = el.getBoundingClientRect().top;
    if (pos < window.innerHeight - 100) {
      el.classList.add("show");
    }
  });
});
