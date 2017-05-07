$(document).ready(function () {
    $('#visiteurSelectionne').on('change', function () {
        $.ajax({
            url: './validFrais/moisDispoParVisiteur!Ajax',
            type: 'POST',
            dataType: 'json',
            data: 'id=' + this.value

        }).done(function (data) {
            $.each(data.dates, function (e, da) {
                $('#selectMoisDispo').append($('<option>', {
                        value: da.value,
                        text: da.text
                    }
                ))

            })
            console.log(data)
        }).fail(function (data) {
            console.log(data);
        })
    });
    $('#selectMoisDispo').on('change', function () {
        $.ajax({
            url: './validFrais/getFiches!Ajax',
            type: 'POST',
            dataType: 'json',
            data: {
                id: $('#visiteurSelectionne').find(':selected').val(),
                mois: this.value}
            }).done(function (datas) {
                console.log(datas);

                $('#txtKm').html('123');
        }).fail(function (datas) {
            console.log(datas);
        })
    })
    }



)
;