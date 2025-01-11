// Hedef objesi için örnek yapı
class Hedef {
  constructor(id, baslik, aciklama, tarih) {
    this.id = id;
    this.baslik = baslik;
    this.aciklama = aciklama;
    this.tarih = tarih;
    this.tamamlandi = false;
    this.ilerleme = 0;
    this.olusturmaTarihi = new Date().toISOString();
  }
}

// LocalStorage işlemleri için yardımcı fonksiyonlar
const HedefYonetimi = {
  hedefleriGetir: function () {
    const hedefler = localStorage.getItem("hedefler");
    return hedefler ? JSON.parse(hedefler) : [];
  },

  hedefEkle: function (hedef) {
    const hedefler = this.hedefleriGetir();
    hedefler.push(hedef);
    localStorage.setItem("hedefler", JSON.stringify(hedefler));
  },

  hedefGuncelle: function (hedefId, yeniHedef) {
    const hedefler = this.hedefleriGetir();
    const index = hedefler.findIndex((h) => h.id === hedefId);
    if (index !== -1) {
      hedefler[index] = { ...hedefler[index], ...yeniHedef };
      localStorage.setItem("hedefler", JSON.stringify(hedefler));
      return true;
    }
    return false;
  },

  hedefSil: function (hedefId) {
    let hedefler = this.hedefleriGetir();
    hedefler = hedefler.filter((h) => h.id !== hedefId);
    localStorage.setItem("hedefler", JSON.stringify(hedefler));
    return true;
  },
};

function hedefEkle() {
  const baslik = document.getElementById("hedefBaslik").value;
  const aciklama = document.getElementById("hedefAciklama").value;
  const tarih = document.getElementById("hedefTarih").value;

  if (!baslik || !tarih) {
    alert("Lütfen başlık ve tarih giriniz!");
    return;
  }

  const yeniHedef = new Hedef(Date.now().toString(), baslik, aciklama, tarih);

  HedefYonetimi.hedefEkle(yeniHedef);
  hedefleriGoster();
  formTemizle();
}

function hedefTamamla(hedefId) {
  const hedef = HedefYonetimi.hedefleriGetir().find((h) => h.id === hedefId);
  if (hedef) {
    hedef.tamamlandi = true;
    hedef.ilerleme = 100;
    hedef.tamamlanmaTarihi = new Date().toISOString();
    HedefYonetimi.hedefGuncelle(hedefId, hedef);
    hedefleriGoster();
  }
}

function hedefSil(hedefId) {
  if (confirm("Bu hedefi silmek istediğinizden emin misiniz?")) {
    const silindi = HedefYonetimi.hedefSil(hedefId);
    if (silindi) {
      // DOM'u güncelle
      hedefleriGoster();
      // İsteğe bağlı: Kullanıcıya bilgi ver
      alert("Hedef başarıyla silindi!");
    } else {
      alert("Hedef silinirken bir hata oluştu!");
    }
  }
}

function ilerlemeDegistir(hedefId, ilerleme) {
  const hedef = HedefYonetimi.hedefleriGetir().find((h) => h.id === hedefId);
  if (hedef) {
    hedef.ilerleme = ilerleme;
    HedefYonetimi.hedefGuncelle(hedefId, hedef);
    hedefleriGoster();
  }
}

function hedefKartiOlustur(hedef) {
  return `
    <div class="hedef-card" id="hedef-${hedef.id}">
      <div class="hedef-card-header">
        <div class="hedef-info">
          <h3>${hedef.baslik}</h3>
          <div class="hedef-date">Bitiş: ${new Date(
            hedef.tarih
          ).toLocaleDateString()}</div>
        </div>
        ${
          hedef.tamamlandi
            ? '<span class="completed-badge">Tamamlandı</span>'
            : ""
        }
      </div>
      <p>${hedef.aciklama}</p>
      <div class="hedef-progress">
        <div class="progress-bar">
          <div class="progress-fill" style="width: ${hedef.ilerleme}%"></div>
        </div>
        <input type="range" value="${hedef.ilerleme}" min="0" max="100" 
          onchange="ilerlemeDegistir('${hedef.id}', this.value)"
          ${hedef.tamamlandi ? "disabled" : ""}>
      </div>
      <div class="hedef-actions">
        ${
          !hedef.tamamlandi
            ? `<button onclick="hedefTamamla('${hedef.id}')" class="btn btn-complete">Tamamlandı</button>`
            : ""
        }
        <button class="btn btn-delete" data-id="${hedef.id}">Sil</button>
      </div>
    </div>
  `;
}

function hedefleriGoster() {
  const hedefler = HedefYonetimi.hedefleriGetir();
  const aktifHedefler = document.getElementById("aktifHedefler");
  const tamamlananHedefler = document.getElementById("tamamlananHedefler");

  if (!aktifHedefler || !tamamlananHedefler) {
    console.error("Hedef listeleri bulunamadı!");
    return;
  }

  const aktifHedeflerHTML = hedefler
    .filter((h) => !h.tamamlandi)
    .map(hedefKartiOlustur)
    .join("");

  const tamamlananHedeflerHTML = hedefler
    .filter((h) => h.tamamlandi)
    .map(hedefKartiOlustur)
    .join("");

  aktifHedefler.innerHTML =
    aktifHedeflerHTML || "<p>Henüz aktif hedef bulunmuyor.</p>";
  tamamlananHedefler.innerHTML =
    tamamlananHedeflerHTML || "<p>Henüz tamamlanan hedef bulunmuyor.</p>";
}

function showActiveGoals() {
  document.getElementById("aktifHedefler").style.display = "grid";
  document.getElementById("tamamlananHedefler").style.display = "none";
}

function showCompletedGoals() {
  document.getElementById("aktifHedefler").style.display = "none";
  document.getElementById("tamamlananHedefler").style.display = "grid";
}

function formTemizle() {
  document.getElementById("hedefBaslik").value = "";
  document.getElementById("hedefAciklama").value = "";
  document.getElementById("hedefTarih").value = "";
}

// Sayfa yüklendiğinde hedefleri göster
document.addEventListener("DOMContentLoaded", function () {
  hedefleriGoster();

  // Event delegation için click listener ekle
  document.addEventListener("click", function (e) {
    const target = e.target;

    // Silme butonu tıklaması
    if (target.classList.contains("btn-delete")) {
      const hedefId = target.getAttribute("data-id");
      if (hedefId) {
        hedefSil(hedefId);
      }
    }
  });
});
