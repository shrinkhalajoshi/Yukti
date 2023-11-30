
function scrolltop() {
    window.scrollTo(0, 0);
}
let contact = document.getElementById('contactForm');
contact.addEventListener('submit', function (e) {
    e.preventDefault();
    alert(`Sorry Request cannot be accepted due to some technical errors`);
})

