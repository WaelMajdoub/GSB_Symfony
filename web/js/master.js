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
                for(aze in datas.ligneFraisForfait) {
                    var val;
                    switch (datas.ligneFraisForfait[aze]['id']){
                        case 'ETP':
                            val = '#etape';
                            break;
                        case 'KM':
                            val = '#km';
                            break;
                        case 'NUI':
                            val = '#nuitee';
                            break;
                        case 'REP':
                            val = '#repas';
                            break;
                    }
                    $(val).val(datas.ligneFraisForfait[aze]['quantite']);
                }
                $('#tableHF').html();
                for(aze in datas.ligneFraisHorsForfait) {
                    $('#tableHF').append('<tr align="center">'+
                        '<td width="100"><input type="text" size="12" name="hfDate1" value="'+datas.ligneFraisHorsForfait[aze]['date']['date'].substring(0,10)+'"/></td>'+
                        '<td width="220"><input type="text" size="30" name="hfLib1" value="'+datas.ligneFraisHorsForfait[aze]['libelle']+'"/></td>'+
                        '<td width="90"><input type="text" size="10" name="hfMont1" value="'+datas.ligneFraisHorsForfait[aze]['montant']+'"/></td>'+
                        '<td width="80">'+
                        '<select size="3" name="hfSitu1">'+
                        '<option value="E">Enregistré</option>'+
                        '<option value="V">Validé</option>'+
                        '<option value="R">Remboursé</option>'+
                        '</select></td>'+
                        '</tr>')
                }

        }).fail(function (datas) {
            console.log(datas);
        })
    })
    }



)
;