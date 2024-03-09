function displaySearchResults(data) {
    var results = data || [];

    console.log('Received data:', results); // Tambahkan ini untuk memeriksa data yang diterima di konsol

    if (results.length > 0) {
        var dropdown = '<ul>';
        results.forEach(function(result) {
            dropdown += '<li><a href="#" onclick="selectResult(\'' + result.name + '\')">' + result.name + '</a></li>';
        });
        dropdown += '</ul>';

        $('#search-dropdown').html(dropdown);
    } else {
        $('#search-dropdown').html('');
    }
}

function selectResult(name) {
    $('#search-query').val(name);
    $('#search-dropdown').html('');
}

function search() {
    var query = $('#search-query').val();

    if (query.length >= 3) {
        $.ajax({
            type: 'GET',
            url: '/search',
            data: { query: query },
            success: function (data) {
                console.log('Search results:', data); // Tambahkan ini untuk memeriksa hasil pencarian di konsol
                displaySearchResults(data);
            }
        });
    }
}
