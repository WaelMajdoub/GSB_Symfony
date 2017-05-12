$(document).ready(function () {
        $('#ficheInfos').hide();
        // $('#ficheEtat').hide();// On cache l'Id de l'état de la fiche pour des besoins précis
        $('#visiteurSelectionne').on('change', function () {
            $('#btnSubmit').attr('disabled', true);
            $('#hcMontant').val('');
            $.ajax({
                url: './validFrais/moisDispoParVisiteurFichesValides!Ajax',
                type: 'POST',
                dataType: 'json',
                data: 'id=' + this.value
            }).done(function (data) {
                $('#trF').remove();
                $('.trHF').remove();
                $('#selectMoisDispo').find('option:not(:first)').remove();
                $('#selectMoisDispo').val('0');
                $.each(data.datesValides, function (e, da) {
                    console.log(da);
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
                for (ligne in datas.ligneFraisForfait) {
                    var val;
                    switch (datas.ligneFraisForfait[ligne]['id']) {
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
                    $(val).val(datas.ligneFraisForfait[ligne]['quantite']);
                }
                $('.trHF').remove();
                for (ligne in datas.ligneFraisHorsForfait) {
                    $('#tableHF').append('<tr align="center" class="trHF">' +
                        '<td width="100"><input type="text" size="12" name="hfDate1" value="' + datas.ligneFraisHorsForfait[ligne]['date']['date'].substring(0, 10) + '"/></td>' +
                        '<td width="220"><input type="text" size="30" name="hfLib1" value="' + datas.ligneFraisHorsForfait[ligne]['libelle'] + '"/></td>' +
                        '<td width="90"><input type="text" size="10" name="hfMont1" value="' + datas.ligneFraisHorsForfait[ligne]['montant'] + '"/></td>' +
                        '<td width="80">' +
                        '<select size="3" name="hfSitu1">' +
                        '<option value="E">Enregistré</option>' +
                        '<option value="V">Validé</option>' +
                        '<option value="R">Remboursé</option>' +
                        '</select></td>' +
                        '<td width="90"><label><a href="./lignefraishorsforfait/' + datas.ligneFraisHorsForfait[ligne]['id'] + '/edit">Editer le frais</a></label></td>' +
                        '</tr>')
                }
                $('#ficheInfos').show();
                $('#ficheEtat').hide();

                $('#FicheFraisId').text(datas.ficheFrais[0]['idFicheFrais']);
                $('#ficheEtat').text(datas.ficheFrais[0]['idEtat']);

                setLibelleEtat();

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
                    url: './validFrais/mettreFicheEnPaiement!Ajax',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        idFicheFrais: $('#FicheFraisId').text()
                    }
                }).done(function (dtx) {
                    alert('La fiche a bien été mise en Paiement');
                    console.log(dtx);
                }).fail(function (dtx) {
                    console.log(dtx);
                })
            } // END FUNCTION
        ) // end OnClick
    }

);

/**
 * Fonction qui va set les Libelle en fonction de l'état de la fiche pour une meilleure ergonomie
 */
function setLibelleEtat() {
    if ($('#ficheEtat').text() === 'VA') {
        $('#libelleEtat').text('Validée et mise en paiement');
    } else if ($('#ficheEtat').text() === 'CL') {
        $('#libelleEtat').text('Saisie clôturée');
    } else if ($('#ficheEtat').text() === 'RB') {
        $('#libelleEtat').text('Remboursée');
    } else if ($('#ficheEtat').text() === 'CR') {
        $('#libelleEtat').text('Fiche créée, saisie en cours');
    }else if ($('#ficheEtat').text() === 'MP') {
        $('#libelleEtat').text('Fiche mise en paiement');
    }else
        $('#libelleEtat').text('Etat pour cette fiche non disponible');
}
