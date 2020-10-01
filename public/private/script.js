$('select[name="kelurahan"]').change(
    function(){
        var k = $(this).val();
        var l = $('select[name="kecamatan"]')
        if(k<16){
            l.html('<option value="1" selected>Banjarsari</option>')
        }else if(k<27){
            l.html('<option value="2" selected>Jebres</option>')
        }else if(k<38){
            l.html('<option value="3" selected>Laweyan</option>')
        }else if(k<47){
            l.html('<option value="4" selected>Pasar Kliwon</option>')
        }else if(k<54){
            l.html('<option value="5" selected>Serengan</option>')
        }else{
            console.log('error')
        }
    }
);
$('select[name="kecamatan"]').change(
    function(){
        var k = $(this).val()
        $.ajax({
            method: 'get',
            url: '/admin/kecamatan/'+k+'/kelurahan',
            success: function(result){
                html = ''
                for(var i = 0; i < result.length; i++){
                    html += '<option value="'+result[i]['id']+'">'+result[i]['name']+'</option>';
                }
                $('select[name="kelurahan"]').html(html)
            }
        });
    }
);