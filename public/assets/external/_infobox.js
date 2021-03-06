function drawInfobox(category, infoboxContent, json, i) {
    if (json.data[i].color) { var color = json.data[i].color } else { color = '' }
    if (json.data[i].price) { var price = '<div class="price">' + json.data[i].price + '</div>' } else { price = '' }
    if (json.data[i].id) { var id = json.data[i].id } else { id = '' }
    if (json.data[i].url) { var url = json.data[i].url } else { url = '' }
    if (json.data[i].type) { var type = json.data[i].type } else { type = '' }
    if (json.data[i].title) { var title = json.data[i].title } else { title = '' }
    if (json.data[i].location) { var location = json.data[i].location } else { location = '' }
    if (json.data[i].gallery[0]) { var gallery = json.data[i].gallery[0] } else { gallery[0] = '../img/default-item.jpg' }
    var ibContent = '';
    ibContent =
        '<div class="infobox ' + color + '">' +
        '<div class="inner center">' +
        '<div class="image">' +
        '<a href="' + url + '" class="description">' +
        '<div class="meta">' +
        price +
        '<h2>' + title + '</h2>' +
        '<figure>' + location + '</figure>' +
        '<i class="fa fa-angle-right"></i>' +
        '</div>' +
        '</a>' +
        '<a href="' + url + '" class="detail">' +
        '<img src="' + gallery + '">' +
        '</a>' +
        '</div>' +
        '</div>' +
        '</div>';

    return ibContent;
}

function resultsJSON(data) {
    var link = '/locations/';
    var jqxhr = $.ajax({
        type: 'POST',
        url: link,
        data: data,
        dataType: 'json',
        global: false,
        async: false,
        success: function(data) {
            return data;
        }
    }).responseText;

    return jqxhr;
}