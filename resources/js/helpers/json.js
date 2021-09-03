export function serializeArrayToJson(data) {
    let jsonData = {};

    $(data).each(function (index, obj) {
        jsonData[obj.name] = obj.value;
    });

    return jsonData;
};

