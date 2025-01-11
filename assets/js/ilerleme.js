// Rozet kontrol fonksiyonları
const RozetKontrol = {
  bronzKontrol: function (tamamlananSayi) {
    return tamamlananSayi >= 3;
  },

  gumusKontrol: function (tamamlananSayi) {
    return tamamlananSayi >= 5;
  },

  altinKontrol: function (tamamlananSayi) {
    return tamamlananSayi >= 10;
  },

  kararliKontrol: function (hedefler) {
    // Son 7 günü kontrol et
    const sonYediGun = new Array(7).fill(false);
    const bugun = new Date();

    hedefler.forEach((hedef) => {
      if (hedef.tamamlandi) {
        const tamamlanmaTarihi = new Date(hedef.tamamlanmaTarihi);
        const gunFarki = Math.floor(
          (bugun - tamamlanmaTarihi) / (1000 * 60 * 60 * 24)
        );
        if (gunFarki < 7) {
          sonYediGun[gunFarki] = true;
        }
      }
    });

    return sonYediGun.every((gun) => gun === true);
  },
};

function rozetleriGuncelle() {
  const hedefler = HedefYonetimi.hedefleriGetir();
  const tamamlananHedefler = hedefler.filter((h) => h.tamamlandi);

  // Rozet durumlarını kontrol et
  if (RozetKontrol.bronzKontrol(tamamlananHedefler.length)) {
    document.getElementById("bronzRozet").classList.add("earned");
  }

  if (RozetKontrol.gumusKontrol(tamamlananHedefler.length)) {
    document.getElementById("gumusRozet").classList.add("earned");
  }

  if (RozetKontrol.altinKontrol(tamamlananHedefler.length)) {
    document.getElementById("altinRozet").classList.add("earned");
  }

  if (RozetKontrol.kararliKontrol(hedefler)) {
    document.getElementById("kararliRozet").classList.add("earned");
  }
}

function istatistikleriGoster() {
  const hedefler = HedefYonetimi.hedefleriGetir();
  const tamamlananHedefler = hedefler.filter((h) => h.tamamlandi);
  const aktifHedefler = hedefler.filter((h) => !h.tamamlandi);

  const ortalamaIlerleme =
    hedefler.reduce((acc, h) => acc + h.ilerleme, 0) / hedefler.length || 0;

  document.getElementById("istatistikler").innerHTML = `
        <div class="stat-item">
            <h4>Tamamlanan Hedefler</h4>
            <p>${tamamlananHedefler.length}/${hedefler.length}</p>
        </div>
        <div class="stat-item">
            <h4>Ortalama İlerleme</h4>
            <p>%${Math.round(ortalamaIlerleme)}</p>
        </div>
        <div class="stat-item">
            <h4>Aktif Hedefler</h4>
            <p>${aktifHedefler.length}</p>
        </div>
    `;
}

function grafikOlustur() {
  const hedefler = HedefYonetimi.hedefleriGetir();

  // Önce mevcut grafikleri temizle
  const chartBox = document.querySelector(".chart-box");
  chartBox.innerHTML = '<canvas id="genelIlerleme"></canvas>';

  const ctx = document.getElementById("genelIlerleme").getContext("2d");

  // Aylık ilerleme verilerini hazırla
  const aylar = [
    "Ocak",
    "Şubat",
    "Mart",
    "Nisan",
    "Mayıs",
    "Haziran",
    "Temmuz",
    "Ağustos",
    "Eylül",
    "Ekim",
    "Kasım",
    "Aralık",
  ];

  // Şu anki ayı al
  const bugun = new Date();
  const buAy = bugun.getMonth();
  const buYil = bugun.getFullYear();

  // Son 4 ayı hesapla
  const sonDortAy = [];
  const aylikTamamlanan = new Array(4).fill(0);

  for (let i = 3; i >= 0; i--) {
    let targetAy = buAy - i;
    let targetYil = buYil;

    if (targetAy < 0) {
      targetAy += 12;
      targetYil--;
    }

    sonDortAy.push(aylar[targetAy]);
  }

  // Her hedefi kontrol et
  hedefler.forEach((hedef) => {
    if (hedef.tamamlandi && hedef.tamamlanmaTarihi) {
      const tamamlanmaTarihi = new Date(hedef.tamamlanmaTarihi);
      const hedefAy = tamamlanmaTarihi.getMonth();
      const hedefYil = tamamlanmaTarihi.getFullYear();

      // Son 4 ay içinde mi kontrol et
      for (let i = 0; i < 4; i++) {
        let targetAy = buAy - i;
        let targetYil = buYil;

        if (targetAy < 0) {
          targetAy += 12;
          targetYil--;
        }

        if (hedefAy === targetAy && hedefYil === targetYil) {
          aylikTamamlanan[i]++;
          break;
        }
      }
    }
  });

  // İlerleme grafiği
  const ilerlemeChart = new Chart(ctx, {
    type: "line",
    data: {
      labels: sonDortAy,
      datasets: [
        {
          label: "Aylık Tamamlanan Hedefler",
          data: aylikTamamlanan,
          borderColor: "#086dd9",
          backgroundColor: "rgba(8, 109, 217, 0.1)",
          tension: 0.4,
          fill: true,
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        title: {
          display: true,
          text: "Aylık İlerleme Durumu",
        },
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1,
          },
        },
      },
    },
  });

  // Hedef durumu pasta grafiği
  const durumCtx = document.createElement("canvas");
  durumCtx.id = "hedefDurumu";
  document.querySelector(".chart-box").appendChild(durumCtx);

  const tamamlanan = hedefler.filter((h) => h.tamamlandi).length;
  const devamEden = hedefler.filter((h) => !h.tamamlandi).length;

  new Chart(durumCtx, {
    type: "doughnut",
    data: {
      labels: ["Tamamlanan", "Devam Eden"],
      datasets: [
        {
          data: [tamamlanan, devamEden],
          backgroundColor: ["#28a745", "#086dd9"],
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        title: {
          display: true,
          text: "Hedef Durumu",
        },
      },
    },
  });
}

// Sayfa yüklendiğinde
document.addEventListener("DOMContentLoaded", function () {
  rozetleriGuncelle();
  istatistikleriGoster();
  grafikOlustur();
});
