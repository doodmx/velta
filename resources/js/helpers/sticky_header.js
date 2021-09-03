const header = document.getElementById("page-breadcrumb");

if (header !== null) {

    window.onscroll = function () {
        toggleStickyClasses();
    };


    function toggleStickyClasses() {

        const pageYOffset = window.pageYOffset;
        const addStickyFrom = 110;

        if (pageYOffset > addStickyFrom) {
            header.classList.add("sticky-header-top");

        } else {
            header.classList.remove("sticky-header-top");
        }
    }

}
