export default function renderDeviceByBreakpoint(selector) {

    const deviceWith = window.innerWidth;



    if (deviceWith <= 600) {
        $(selector).removeClass('device-surface-book device-imac-pro').addClass('device-iphone-8');

    }

    if (deviceWith > 600 && deviceWith <= 1200) {
        $(selector).removeClass('device-iphone-8 device-imac-pro').addClass('device-surface-book');

    }

    if (deviceWith > 1200) {
        $(selector).removeClass('device-iphone-8 device-surface-book').addClass('device-imac-pro');

    }
}
