document.querySelectorAll(".pinjam-btn").forEach((button) => {
    button.addEventListener("click", function () {
        this.classList.add("hidden");
        this.closest(".book-card")
            .querySelector(".plus-minus")
            .classList.remove("hidden");
        this.closest(".book-card")
            .querySelector(".plus-minus")
            .classList.add("flex");
    });
});

document.querySelectorAll(".min-buku").forEach((button) => {
    button.addEventListener("click", function () {
        let jumlah = parseInt(this.nextElementSibling.innerHTML);
        if (jumlah > 1) {
            this.nextElementSibling.innerHTML = jumlah - 1;
        } else {
            this.closest(".book-card")
                .querySelector(".plus-minus")
                .classList.remove("flex");
            this.closest(".book-card")
                .querySelector(".plus-minus")
                .classList.add("hidden");
            this.closest(".book-card")
                .querySelector(".pinjam-btn")
                .classList.remove("hidden");
        }
    });
});

document.querySelectorAll(".add-buku").forEach((button) => {
    button.addEventListener("click", function () {
        let jumlah = parseInt(this.previousElementSibling.innerHTML);
        this.previousElementSibling.innerHTML = jumlah + 1;
    });
});
