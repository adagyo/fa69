
function initModal() { $('#modal-content-init').show(); $('#modal-content-ok').hide(); $('#modal-content-ko').hide(); $('#btn-close').addClass('disabled'); }
function successModal(highlight,keepOpenTime) {
    keepOpenTime = typeof keepOpenTime !== 'undefined' ? keepOpenTime : 3000;
    highlight = typeof highlight !== 'undefined' ? highlight : true;
    $('#modal-content-init').hide();
    $('#modal-content-ok').show();
    $('#modal-content-ko').hide();
    $('#btn-close').removeClass('disabled');
    if(highlight === true) {
        $('#modalMsg').effect('highlight', {}, 500, function() { setTimeout(function() { $('#modalMsg').modal('hide'); }, keepOpenTime); });
    } else {
        setTimeout(function() { $('#modalMsg').modal('hide'); }, keepOpenTime);
    }
}
function errorModal(message) {
    $('#modal-content-ko > .alert').html(message);
    $('#modal-content-init').hide();
    $('#modal-content-ok').hide();
    $('#modal-content-ko').show();
    $('#btn-close').removeClass('disabled');
    $('#modalMsg').effect('shake', { distance: 10 }, 500, function() { setTimeout(function() { $('#modalMsg').modal('hide'); }, 5000); });
}
function goToStep(from, to) {
    /* buttons handling */
    $('#h'+to).addClass('btn-info').children("i").addClass('icon-white');
    if(from != '_') { $('#h'+from).removeClass('btn-info').children("i").removeClass('icon-white'); }

    switch(to) {
        case 'Customer':
            $('#prev').addClass('disabled');
            $('#save').removeClass('disabled').attr('title', 'Enregistre un nouveau client').children("span").html('Nouveau client');
            $('#edit').removeClass('disabled').attr('title', 'Mets à jour les informations du client selectionné').children("span").html('Mise à jour du client');
            $('#reset').removeClass('disabled');
            $('#next').attr('title',"Passe à l'étape suivante").children("span").html('Suivant');
            $('#next').children('i').removeClass('icon-print').addClass('icon-forward');
            break;
        case 'Car':
            $('#prev').removeClass('disabled');
            $('#save').removeClass('disabled').attr('title', 'Enregistre un nouveau véhicule').children("span").html('Nouveau véhicule');
            $('#edit').removeClass('disabled').attr('title', 'Mets à jour les informations du véhicule selectionné').children("span").html('Mise à jour du véhicule');
            $('#reset').removeClass('disabled');
            $('#next').attr('title',"Passe à l'étape suivante").children("span").html('Suivant');
            $('#next').children('i').removeClass('icon-print').addClass('icon-forward');
            break;
        case 'Bill':
            $('#prev').removeClass('disabled');
            $('#save').addClass('disabled').attr('title', '').children("span").html('');
            $('#edit').addClass('disabled').attr('title', '').children("span").html('');
            $('#reset').removeClass('disabled');
            $('#next').attr('title',"Passe à l'étape suivante").children("span").html('Suivant');
            $('#next').children('i').removeClass('icon-print').addClass('icon-forward');
            break;
        case 'Preview':
            $('#prev').removeClass('disabled');
            $('#save').addClass('disabled').attr('title', '').children("span").html('');
            $('#edit').addClass('disabled').attr('title', '').children("span").html('');
            $('#reset').addClass('disabled');
            $('#next').attr('title','Sauvegarder et imprimer la facture').children("span").html('Imprimer');
            $('#next').children('i').addClass('icon-print').removeClass('icon-forward');
            break;
    }


    /* fieldset's handling */
    $('#'+from).hide();
    $('#'+to).show();
    return to;
}

function _getDate(){
    var today = new Date();
    var strToday = '';
    if(today.getDate() < 10) { strToday = '0'; }
    strToday += today.getDate() + '/';
    if(today.getMonth() < 11) { strToday += '0'; }
    strToday += String(parseInt(today.getMonth(), 10) + 1) + '/' + today.getFullYear();
    return strToday;
}

function resetBill() { for(i = 0; i <= 17; i++) { resetLine(i); } }

function resetLine(i) {
    $('#adagyo_fa69bundle_billtype_lines_' + i + '_lineLabel').val('');
    $('#adagyo_fa69bundle_billtype_lines_' + i + '_quality').val('');
    $('#adagyo_fa69bundle_billtype_lines_' + i + '_quantity').val('0');
    $('#adagyo_fa69bundle_billtype_lines_' + i + '_discount').val('0');
    $('#adagyo_fa69bundle_billtype_lines_' + i + '_unitPriceVAT').val('0');
}

function getBillLines() {
    var billLines = [];
    for(i = 0; i < 18; i++) {
        billLines[i] = {
            quantity    : $('#adagyo_fa69bundle_billtype_lines_' + i + '_quantity').val(),
            lineLabel       : $('#adagyo_fa69bundle_billtype_lines_' + i + '_lineLabel').val(),
            quality     : $('#adagyo_fa69bundle_billtype_lines_' + i + '_quality').val(),
            discount    : $('#adagyo_fa69bundle_billtype_lines_' + i + '_discount').val(),
            unitPriceVAT   : $('#adagyo_fa69bundle_billtype_lines_' + i + '_unitPriceVAT').val()
        };
    }
    return billLines;
}

function sortHashTable(hashTable, sortBy, sortOrder) {
    //console.log("Trier par " + sortBy + ' ' + sortOrder);
    if(sortOrder == 'ASC') {
        var newHashTable = hashTable.sort(function (a, b) {
            if(typeof(a[sortBy]) === 'number') { return a[sortBy] - b[sortBy]; }
            else { if (a[sortBy] < b[sortBy]) { return -1; } if (a[sortBy] > b[sortBy]) { return 1; } return 0; }
        });
    } else {
        var newHashTable = hashTable.reverse(function (a, b) {
            if(typeof(a[sortBy]) === 'number') { return a[sortBy] - b[sortBy]; }
            else { if (a[sortBy] < b[sortBy]) { return -1; } if (a[sortBy] > b[sortBy]) { return 1; } return 0; }
        });
    }
    return newHashTable;
}