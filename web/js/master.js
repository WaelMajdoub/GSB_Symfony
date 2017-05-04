$(document).ready(function () {
    $('#visiteurSelectionne').on('change', function () {
        $.ajax({
            url: './validFrais/moisDispoParVisiteur!Ajax',
            type: 'POST',
            dataType: 'json',
            data: 'id=' + this.value
        }).done(function (data) {
            console.log(data);
            $.each(data.dates, function (moi) {
                $('#selectMoisDispo').append($('<option>', {

                    }
                ))
            });
        }).fail(function () {
            console.log("j'ai fail")
        })
    });
});