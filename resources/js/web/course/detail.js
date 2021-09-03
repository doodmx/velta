const header = document.getElementById("coursePrice");
const deviceWidth = window.innerWidth;
let headerPosition = header !== null ? header.offsetTop : null;


window.onload = function () {
    if (deviceWidth <= 768) {
        header.classList.add('sticky-card');
    }
};


if (deviceWidth > 768) {
    window.onscroll = function () {

        const scrollPosition = window.pageYOffset;

        if (scrollPosition > headerPosition) {
            header.classList.add("sticky-card");
        } else {
            header.classList.remove("sticky-card");
        }
    };
}





