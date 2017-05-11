$(document).ready(function () {
        $('#visiteurSelectionne').on('change', function () {
            $('#btnSubmit').attr('disabled', true);
            $('#hcMontant').val('');
            $.ajax({
                url: './validFrais/moisDispoParVisiteur!Ajax',
                type: 'POST',
                dataType: 'json',
                data: 'id=' + this.value
            }).done(function (data) {
                $('#trF').remove();
                $('.trHF').remove();
                $('#selectMoisDispo').find('option:not(:first)').remove();
                $('#selectMoisDispo').val('0');
                $.each(data.dates, function (e, da) {
                    $('#selectMoisDispo').append($('<option>', {
                            value: da.value,
                            text: da.text
                        }
                    ))
                })
            }).fail(function () {
                alert('Erreur lors de la récupération des dates disponibles.');
            })
        });
        $('#selectMoisDispo').on('change', function () {
            $.ajax({
                url: './validFrais/getFiches!Ajax',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: $('#visiteurSelectionne').find(':selected').val(),
                    mois: this.value
                }
            }).done(function (datas) {
                console.log(datas);
                $('#btnSubmit').attr('disabled', false);
                $('#hcMontant').val(datas.ficheFrais[0]['nbJustificatifs']);
                $('#trF').remove();
                $('#tableF').append('<tr align="center" id="trF">' +
                    '<td id="txtRepasMidi" ><input type="text" id="repas" name="repas" value=""/></td>' +
                    '<td id="txtNuitee"><input type="text" id="nuitee" name="nuitee" value=""/></td>' +
                    '<td id="txtEtape"><input type="text" id="etape" name="etape" value=""/></td>' +
                    '<td id="txtKm"><input type="text" id="km" name="km" value=""/></td>' +
                    '<td>' +
                    '<select size="3" name="situ">' +
                    '<option value="E">Enregistré</option>' +
                    '<option value="V">Validé</option>' +
                    '<option value="R">Remboursé</option>' +
                    '</select></td>' +
                    '</tr>')
                for (aze in datas.ligneFraisForfait) {
                    var val;
                    switch (datas.ligneFraisForfait[aze]['id']) {
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
                $('.trHF').remove();
                for (aze in datas.ligneFraisHorsForfait) {
                    $('#tableHF').append('<tr align="center" class="trHF">' +
                        '<td width="100"><input type="text" size="12" name="hfDate1" value="' + datas.ligneFraisHorsForfait[aze]['date']['date'].substring(0, 10) + '"/></td>' +
                        '<td width="220"><input type="text" size="30" name="hfLib1" value="' + datas.ligneFraisHorsForfait[aze]['libelle'] + '"/></td>' +
                        '<td width="90"><input type="text" size="10" name="hfMont1" value="' + datas.ligneFraisHorsForfait[aze]['montant'] + '"/></td>' +
                        '<td width="80">' +
                        '<select size="3" name="hfSitu1">' +
                        '<option value="E">Enregistré</option>' +
                        '<option value="V">Validé</option>' +
                        '<option value="R">Remboursé</option>' +
                        '</select></td>' +
                        '<td width="90"><label><a href="./lignefraishorsforfait/' + datas.ligneFraisHorsForfait[aze]['id'] + '/edit">Editer le frais</a></label></td>' +
                        '</tr>')
                }

                $('#FicheFraisId').text(datas.ficheFrais[0]['idFicheFrais']);

            }).fail(function () {
                alert('Erreur lors de la récupération des dates disponibles.');
            });
        })
        $('#btnReset').on('click', function () {
                $('#trF').remove();
                $('.trHF').remove();
            }
        );

        $('#btnValider').on('click', function () {
            $.ajax({
                url: './validFrais/validerFiche!Ajax',
                type: 'POST',
                dataType: 'json',
                data: {
                    idFicheFrais: $('#FicheFraisId').text()
                }
            }).done(function (dtx) {
                alert('success');
                console.log(dtx);
            }).fail(function (dtx) {
                console.log(dtx);
            })





            } // END FUNCTION
        ) // end OnClick


    }




);
