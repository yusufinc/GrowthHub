const contactForm = document.getElementById("contact-form"),
  contactMessage = document.getElementById("contact-message");

const sendEmail = (e) => {
  e.preventDefault();

  // Form alanlarını al
  const userName = contactForm.elements["user_name"].value.trim();
  const userEmail = contactForm.elements["user_email"].value.trim();
  const userMessage = contactForm.elements["user_mesage"].value.trim();

  // Alanların boş olup olmadığını kontrol et
  if (userName === "" || userEmail === "" || userMessage === "") {
    contactMessage.textContent = "Please fill out all fields ❌";
    return;
  }

  emailjs
    .sendForm(
      "service_y7knw8z",
      "template_fm4j3sj",
      "#contact-form",
      "QntIDNEQSAjOTLwhG"
    )
    .then(
      () => {
        contactMessage.textContent = "Message sent successfully ✅";
        // Formu temizle
        contactForm.reset();
        // 3 saniye sonra mesajı gizle
        setTimeout(() => {
          contactMessage.textContent = "";
        }, 3000);
      },
      () => {
        contactMessage.textContent = "Message not sent (service error) ❌ ";
      }
    );
};

contactForm.addEventListener("submit", sendEmail);
