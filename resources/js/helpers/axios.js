axios.interceptors.request.use((config) => {

    $('body').block({
        message: 'Cargando...',
        baseZ: 9999999,
        // set these to true to have the message automatically centered
        centerX: true, // <-- only effects element blocking (page block controlled via css above)
        centerY: true,
        css: {
            border: 'none',
            padding: '15px',
            backgroundColor: window.colors.primary,
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        }
    });

    Object.assign(config.headers, {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    })

    return config;

});

axios.interceptors.response.use((response) => {

    $('body').unblock();
    return response;

}, (error) => {

    $('body').unblock();
    return Promise.reject(error);

});
