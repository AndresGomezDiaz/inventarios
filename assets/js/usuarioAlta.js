$(function () {
    var ligaActual = $('#liga').val();
    jQuery('#estado').change(function(){
        var estado =document.getElementById("estado").value;
        var municipio = jQuery(this).attr("estadoAttri");
        var to=document.getElementById("Buscando");
        to.innerHTML="Buscando....";
        jQuery.ajax({
            type: "POST",
            url: ligaActual + 'buscar_municipios',
            data: 'estado='+estado+'&municipio='+municipio,
            success: function(a) {
                jQuery('#municipio').html(a);
                var to=document.getElementById("Buscando");
                to.innerHTML="";
            }
        });
    })
    .change();
});
