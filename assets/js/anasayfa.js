const popupContents = {
  1: {
    title: "Hedeflerine Odaklan",
    content: ` <h2>Hedeflerine Odaklan</h2>
                 <p>Başarı, her gün attığın küçük adımların toplamıdır. Her sabah uyandığında, hedeflerine bir adım daha yaklaşmak için yeni bir fırsat var. Odaklan, plan yap ve harekete geç. Unutma, yolculuk tek bir adımla başlar.</p>`,
  },
  2: {
    title: "Asla Vazgeçme",
    content: `<h2>Asla Vazgeçme</h2>
                 <p>Zorluklar, başarı yolculuğunun doğal parçalarıdır. Her başarısızlık, seni hedefine biraz daha yaklaştıran bir öğrenme fırsatıdır. Vazgeçmek yerine, her düştüğünde daha güçlü kalkmasını öğren.</p>`,
  },
  3: {
    title: "Hayallerine İnan",
    content: `<h2>Hayallerine İnan</h2>
                 <p>Hayallerin, gerçekleştirmek için bekleyen potansiyellerdir. Kendine inan ve hayallerinin peşinden koşmaktan asla vazgeçme. Unutma, bugünün hayalleri, yarının gerçekleridir.</p>`,
  },
};

function openPopup(id) {
  const modal = document.getElementById("popupModal");
  const content = document.getElementById("popupContent");
  content.innerHTML = popupContents[id].content;
  modal.style.display = "block";
  document.body.style.overflow = "hidden";
}

// Modal kapatma işlemleri
document.querySelector(".close-btn").addEventListener("click", closePopup);
document.getElementById("popupModal").addEventListener("click", function (e) {
  if (e.target === this) {
    closePopup();
  }
});

function closePopup() {
  const modal = document.getElementById("popupModal");
  modal.style.display = "none";
  document.body.style.overflow = "auto";
}

// ESC tuşu ile kapatma
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") {
    closePopup();
  }
});
